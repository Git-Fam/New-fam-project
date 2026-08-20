-- User-level storage for LINE-linked diagnosis records.
-- Run this in Supabase Dashboard SQL Editor before redeploying line-callback / send-line-result.

create extension if not exists pgcrypto;

create table if not exists public.app_users (
  id uuid primary key default gen_random_uuid(),
  internal_user_id text not null default ('usr_' || substr(replace(gen_random_uuid()::text, '-', ''), 1, 8)),
  line_user_id text unique,
  display_name text,
  initial_utm_source text,
  initial_utm_medium text,
  initial_utm_campaign text,
  initial_device_type text,
  initial_page_path text,
  first_diagnosis_id uuid references public.diagnoses(id) on delete set null,
  first_seen_at timestamptz not null default now(),
  last_seen_at timestamptz not null default now(),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  constraint app_users_internal_user_id_unique unique (internal_user_id)
);

create table if not exists public.line_connections (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete set null,
  line_user_id text not null,
  created_at timestamptz not null default now(),
  last_used_at timestamptz not null default now()
);

alter table public.line_connections add column if not exists user_id uuid references public.app_users(id) on delete set null;
alter table public.line_connections add column if not exists created_at timestamptz not null default now();
alter table public.line_connections add column if not exists last_used_at timestamptz not null default now();

alter table public.diagnoses add column if not exists user_id uuid references public.app_users(id) on delete set null;

create index if not exists app_users_line_user_id_idx on public.app_users(line_user_id);
create index if not exists app_users_created_at_idx on public.app_users(created_at);
create index if not exists line_connections_user_id_idx on public.line_connections(user_id);
create index if not exists line_connections_line_user_id_idx on public.line_connections(line_user_id);
create index if not exists line_connections_last_used_at_idx on public.line_connections(last_used_at);
create index if not exists diagnoses_user_id_idx on public.diagnoses(user_id);

alter table public.app_users enable row level security;
alter table public.line_connections enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.app_users to service_role;
grant select, insert, update, delete on public.line_connections to service_role;
grant select, insert, update, delete on public.diagnoses to service_role;
grant usage, select on all sequences in schema public to service_role;

insert into public.app_users (
  line_user_id,
  first_diagnosis_id,
  first_seen_at,
  last_seen_at,
  created_at,
  updated_at
)
select
  source.line_user_id,
  (array_agg(source.diagnosis_id order by source.created_at) filter (where source.diagnosis_id is not null))[1] as first_diagnosis_id,
  min(source.created_at) as first_seen_at,
  max(source.last_seen_at) as last_seen_at,
  min(source.created_at) as created_at,
  now() as updated_at
from (
  select
    d.line_user_id,
    d.id as diagnosis_id,
    d.created_at,
    coalesce(d.line_sent_at, d.created_at) as last_seen_at
  from public.diagnoses d
  where d.line_user_id is not null

  union all

  select
    lc.line_user_id,
    null::uuid as diagnosis_id,
    lc.created_at,
    coalesce(lc.last_used_at, lc.created_at) as last_seen_at
  from public.line_connections lc
  where lc.line_user_id is not null
) source
group by source.line_user_id
on conflict (line_user_id) do update set
  first_diagnosis_id = coalesce(public.app_users.first_diagnosis_id, excluded.first_diagnosis_id),
  first_seen_at = least(public.app_users.first_seen_at, excluded.first_seen_at),
  last_seen_at = greatest(public.app_users.last_seen_at, excluded.last_seen_at),
  updated_at = now();

update public.diagnoses d
set user_id = u.id
from public.app_users u
where d.user_id is null
  and d.line_user_id = u.line_user_id;

update public.line_connections lc
set user_id = u.id
from public.app_users u
where lc.user_id is null
  and lc.line_user_id = u.line_user_id;
