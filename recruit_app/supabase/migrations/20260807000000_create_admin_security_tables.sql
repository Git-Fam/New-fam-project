create table if not exists public.admin_login_attempts (
  id bigserial primary key,
  attempt_key text not null,
  success boolean not null default false,
  created_at timestamp with time zone not null default now()
);

create index if not exists admin_login_attempts_key_created_idx
  on public.admin_login_attempts using btree (attempt_key, created_at desc);

create index if not exists admin_login_attempts_created_idx
  on public.admin_login_attempts using btree (created_at);

alter table public.admin_login_attempts enable row level security;

create table if not exists public.admin_audit_logs (
  id bigserial primary key,
  event_name text not null,
  success boolean not null default true,
  metadata jsonb not null default '{}'::jsonb,
  ip_address text null,
  user_agent text null,
  created_at timestamp with time zone not null default now()
);

create index if not exists admin_audit_logs_event_idx
  on public.admin_audit_logs using btree (event_name);

create index if not exists admin_audit_logs_created_idx
  on public.admin_audit_logs using btree (created_at desc);

alter table public.admin_audit_logs enable row level security;

create or replace function public.cleanup_admin_security_logs()
returns void
language plpgsql
security definer
set search_path = public
as $$
begin
  delete from public.admin_login_attempts
  where created_at < now() - interval '7 days';

  delete from public.admin_audit_logs
  where created_at < now() - interval '180 days';
end;
$$;

revoke all on function public.cleanup_admin_security_logs() from public, anon, authenticated;
grant execute on function public.cleanup_admin_security_logs() to service_role;

create extension if not exists pg_cron;

do $$
declare
  existing_jobid bigint;
begin
  select jobid
  into existing_jobid
  from cron.job
  where jobname = 'cleanup-ai-career-admin-security'
  limit 1;

  if existing_jobid is not null then
    perform cron.unschedule(existing_jobid);
  end if;
end;
$$;

select cron.schedule(
  'cleanup-ai-career-admin-security',
  '47 19 * * *',
  $$select public.cleanup_admin_security_logs();$$
);
