-- Production initial apply SQL for AI career diagnosis MVP.
-- Generated: 2026-08-24
--
-- Use this file in Supabase Dashboard SQL Editor for the first production reflection.
-- It intentionally avoids destructive operations.
-- LINE survey default questions are inserted only when missing; existing edited text/options are not overwritten.
-- Admin/master data contents such as the 40+ swipe cards and result copy are still saved from the admin screen after Functions are deployed.

begin;

create extension if not exists pgcrypto;


-- -----------------------------------------------------------------------------
-- 20260728000000_create_ai_career_diagnosis.sql
-- -----------------------------------------------------------------------------
create extension if not exists pgcrypto;

create table if not exists public.diagnoses (
  id uuid primary key default gen_random_uuid(),
  answers jsonb not null default '[]'::jsonb,
  scores jsonb not null default '{}'::jsonb,
  score_rates jsonb not null default '{}'::jsonb,
  primary_axis text,
  secondary_axis text,
  result_type text not null,
  result_payload jsonb not null default '{}'::jsonb,
  line_user_id text,
  status text not null default 'waiting_for_line',
  line_sent_at timestamptz,
  expires_at timestamptz not null default (now() + interval '24 hours'),
  created_at timestamptz not null default now()
);

create index if not exists diagnoses_result_type_idx on public.diagnoses(result_type);
create index if not exists diagnoses_status_idx on public.diagnoses(status);
create index if not exists diagnoses_expires_at_idx on public.diagnoses(expires_at);
create index if not exists diagnoses_line_user_id_idx on public.diagnoses(line_user_id);

create table if not exists public.diagnosis_events (
  id bigserial primary key,
  diagnosis_id uuid references public.diagnoses(id) on delete set null,
  event_name text not null,
  line_user_id text,
  payload jsonb not null default '{}'::jsonb,
  user_agent text,
  created_at timestamptz not null default now()
);

create index if not exists diagnosis_events_name_idx on public.diagnosis_events(event_name);
create index if not exists diagnosis_events_diagnosis_id_idx on public.diagnosis_events(diagnosis_id);
create index if not exists diagnosis_events_created_at_idx on public.diagnosis_events(created_at);

create table if not exists public.line_states (
  state text primary key,
  diagnosis_id uuid not null references public.diagnoses(id) on delete cascade,
  completion_url text,
  expires_at timestamptz not null,
  consumed_at timestamptz,
  created_at timestamptz not null default now()
);

create index if not exists line_states_diagnosis_id_idx on public.line_states(diagnosis_id);
create index if not exists line_states_expires_at_idx on public.line_states(expires_at);

alter table public.diagnoses enable row level security;
alter table public.diagnosis_events enable row level security;
alter table public.line_states enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.diagnoses to service_role;
grant select, insert, update, delete on public.diagnosis_events to service_role;
grant select, insert, update, delete on public.line_states to service_role;
grant usage, select on all sequences in schema public to service_role;

-- Edge Functions use the service role key and bypass RLS.
-- Public browser writes must go through Edge Functions, not direct table policies.



-- -----------------------------------------------------------------------------
-- 20260728001000_create_admin_master_tables.sql
-- -----------------------------------------------------------------------------
create table if not exists public.app_settings (
  id boolean primary key default true,
  comparison_count integer not null default 18542 check (comparison_count >= 0),
  comparison_increment_interval_hours numeric not null default 2 check (comparison_increment_interval_hours >= 0),
  comparison_increment_count integer not null default 13 check (comparison_increment_count >= 0),
  comparison_count_updated_at timestamptz not null default now(),
  diagnosis_question_count integer not null default 40 check (diagnosis_question_count >= 1),
  job_count integer not null default 12 check (job_count >= 0),
  high_match_count integer not null default 4 check (high_match_count >= 0),
  require_line_before_result boolean not null default false,
  updated_at timestamptz not null default now(),
  constraint app_settings_singleton check (id)
);

insert into public.app_settings (id)
values (true)
on conflict (id) do nothing;

create table if not exists public.diagnosis_results (
  result_type text primary key,
  name text not null,
  catch_copy text not null,
  description text not null,
  strengths jsonb not null default '[]'::jsonb check (jsonb_typeof(strengths) = 'array'),
  jobs jsonb not null default '[]'::jsonb check (jsonb_typeof(jobs) = 'array'),
  industries jsonb not null default '[]'::jsonb check (jsonb_typeof(industries) = 'array'),
  line_message text not null,
  percent integer not null default 8 check (percent between 1 and 99),
  sort_order integer not null default 0,
  updated_at timestamptz not null default now()
);

create index if not exists diagnosis_results_sort_order_idx
  on public.diagnosis_results(sort_order);

create table if not exists public.swipe_cards (
  card_id text primary key,
  question text not null,
  visual text not null,
  image text not null,
  image_storage_path text,
  yes_scores jsonb not null default '{}'::jsonb check (jsonb_typeof(yes_scores) = 'object'),
  no_scores jsonb not null default '{}'::jsonb check (jsonb_typeof(no_scores) = 'object'),
  enabled boolean not null default true,
  sort_order integer not null default 0,
  updated_at timestamptz not null default now()
);

create index if not exists swipe_cards_sort_order_idx
  on public.swipe_cards(sort_order);

alter table public.app_settings enable row level security;
alter table public.diagnosis_results enable row level security;
alter table public.swipe_cards enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.app_settings to service_role;
grant select, insert, update, delete on public.diagnosis_results to service_role;
grant select, insert, update, delete on public.swipe_cards to service_role;

insert into storage.buckets (id, name, public, file_size_limit, allowed_mime_types)
values (
  'swipe-images',
  'swipe-images',
  true,
  8388608,
  array['image/jpeg', 'image/png', 'image/webp']
)
on conflict (id) do update set
  public = excluded.public,
  file_size_limit = excluded.file_size_limit,
  allowed_mime_types = excluded.allowed_mime_types;

-- Admin reads/writes go through Edge Functions with the service role key.
-- The public app reads the same master through Edge Functions, not direct table policies.



-- -----------------------------------------------------------------------------
-- 20260806000000_add_comparison_growth_settings.sql
-- -----------------------------------------------------------------------------
alter table public.app_settings
  add column if not exists comparison_increment_interval_hours numeric not null default 2,
  add column if not exists comparison_increment_count integer not null default 13,
  add column if not exists comparison_count_updated_at timestamptz not null default now();

do $$
begin
  if not exists (
    select 1
    from pg_constraint
    where conname = 'app_settings_comparison_increment_interval_hours_check'
  ) then
    alter table public.app_settings
      add constraint app_settings_comparison_increment_interval_hours_check
      check (comparison_increment_interval_hours >= 0);
  end if;

  if not exists (
    select 1
    from pg_constraint
    where conname = 'app_settings_comparison_increment_count_check'
  ) then
    alter table public.app_settings
      add constraint app_settings_comparison_increment_count_check
      check (comparison_increment_count >= 0);
  end if;
end $$;



-- -----------------------------------------------------------------------------
-- 20260806001000_add_diagnosis_question_count.sql
-- -----------------------------------------------------------------------------
alter table public.app_settings
  add column if not exists diagnosis_question_count integer not null default 40;

do $$
begin
  if not exists (
    select 1
    from pg_constraint
    where conname = 'app_settings_diagnosis_question_count_check'
  ) then
    alter table public.app_settings
      add constraint app_settings_diagnosis_question_count_check
      check (diagnosis_question_count >= 1);
  end if;
end $$;



-- -----------------------------------------------------------------------------
-- 20260806002000_add_swipe_card_enabled.sql
-- -----------------------------------------------------------------------------
alter table public.swipe_cards
  add column if not exists enabled boolean not null default true;



-- -----------------------------------------------------------------------------
-- 20260731002000_create_analytics_events.sql
-- -----------------------------------------------------------------------------
-- Accurate KPI tracking for the AI career diagnosis MVP.
-- Run this in Supabase Dashboard SQL Editor.
--
-- analytics_events stores anonymous KPI data only.
-- Do not store answers or detailed diagnosis payloads here.

create table if not exists public.analytics_events (
  id bigserial primary key,
  event_name text not null,
  visitor_id text,
  session_id text,
  funnel_id text,
  diagnosis_id uuid references public.diagnoses(id) on delete set null,
  line_user_id text,
  result_type text,
  utm_source text,
  utm_medium text,
  utm_campaign text,
  device_type text,
  page_path text,
  payload jsonb not null default '{}'::jsonb,
  user_agent text,
  created_at timestamptz not null default now()
);

create index if not exists analytics_events_created_at_idx on public.analytics_events(created_at);
create index if not exists analytics_events_name_idx on public.analytics_events(event_name);
create index if not exists analytics_events_visitor_idx on public.analytics_events(visitor_id);
create index if not exists analytics_events_session_idx on public.analytics_events(session_id);
create index if not exists analytics_events_funnel_idx on public.analytics_events(funnel_id);
create index if not exists analytics_events_diagnosis_idx on public.analytics_events(diagnosis_id);
create index if not exists analytics_events_result_type_idx on public.analytics_events(result_type);

alter table public.analytics_events enable row level security;
grant select, insert, update, delete on public.analytics_events to service_role;
grant usage, select on all sequences in schema public to service_role;

alter table public.line_states add column if not exists visitor_id text;
alter table public.line_states add column if not exists session_id text;
alter table public.line_states add column if not exists funnel_id text;
alter table public.line_states add column if not exists result_type text;
alter table public.line_states add column if not exists utm_source text;
alter table public.line_states add column if not exists utm_medium text;
alter table public.line_states add column if not exists utm_campaign text;
alter table public.line_states add column if not exists device_type text;
alter table public.line_states add column if not exists page_path text;

drop view if exists public.result_type_summary;
drop view if exists public.monthly_kpi_summary;
drop view if exists public.weekly_kpi_summary;
drop view if exists public.daily_kpi_summary;
drop view if exists public.daily_event_counts;

create or replace view public.daily_event_counts as
select
  (created_at at time zone 'Asia/Tokyo')::date as event_date,
  event_name,
  count(*)::integer as event_count,
  count(distinct coalesce(funnel_id, session_id, visitor_id, id::text))::integer as unique_count
from public.analytics_events
group by 1, 2
order by 1 desc, 2;

create or replace view public.daily_kpi_summary as
with daily as (
  select
    (created_at at time zone 'Asia/Tokyo')::date as period_start,
    count(distinct coalesce(session_id, visitor_id, id::text)) filter (where event_name = 'lp_view')::integer as lp_view,
    count(distinct funnel_id) filter (where event_name = 'diagnosis_start')::integer as diagnosis_start,
    count(distinct funnel_id) filter (where event_name = 'diagnosis_complete')::integer as diagnosis_complete,
    count(distinct funnel_id) filter (where event_name = 'result_view')::integer as result_view,
    count(distinct funnel_id) filter (where event_name = 'jobs_view')::integer as jobs_view,
    count(distinct funnel_id) filter (where event_name = 'line_button_click')::integer as line_button_click,
    count(distinct funnel_id) filter (where event_name = 'line_login_success')::integer as line_login_success,
    count(distinct funnel_id) filter (where event_name = 'result_sent')::integer as result_sent,
    count(distinct funnel_id) filter (where event_name = 'share_click')::integer as share_click
  from public.analytics_events
  group by 1
)
select
  period_start as event_date,
  lp_view,
  diagnosis_start,
  diagnosis_complete,
  result_view,
  jobs_view,
  line_button_click,
  line_login_success,
  result_sent,
  share_click,
  round(diagnosis_start::numeric / nullif(lp_view, 0) * 100, 1) as start_rate,
  round(diagnosis_complete::numeric / nullif(diagnosis_start, 0) * 100, 1) as complete_rate,
  round(result_view::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_view_rate,
  round(line_button_click::numeric / nullif(diagnosis_complete, 0) * 100, 1) as line_click_rate,
  round(result_sent::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_sent_rate,
  round(share_click::numeric / nullif(result_view, 0) * 100, 1) as share_rate
from daily
order by event_date desc;

create or replace view public.weekly_kpi_summary as
with weekly as (
  select
    date_trunc('week', created_at at time zone 'Asia/Tokyo')::date as period_start,
    count(distinct coalesce(session_id, visitor_id, id::text)) filter (where event_name = 'lp_view')::integer as lp_view,
    count(distinct funnel_id) filter (where event_name = 'diagnosis_start')::integer as diagnosis_start,
    count(distinct funnel_id) filter (where event_name = 'diagnosis_complete')::integer as diagnosis_complete,
    count(distinct funnel_id) filter (where event_name = 'result_view')::integer as result_view,
    count(distinct funnel_id) filter (where event_name = 'jobs_view')::integer as jobs_view,
    count(distinct funnel_id) filter (where event_name = 'line_button_click')::integer as line_button_click,
    count(distinct funnel_id) filter (where event_name = 'line_login_success')::integer as line_login_success,
    count(distinct funnel_id) filter (where event_name = 'result_sent')::integer as result_sent,
    count(distinct funnel_id) filter (where event_name = 'share_click')::integer as share_click
  from public.analytics_events
  group by 1
)
select
  period_start,
  lp_view,
  diagnosis_start,
  diagnosis_complete,
  result_view,
  jobs_view,
  line_button_click,
  line_login_success,
  result_sent,
  share_click,
  round(diagnosis_start::numeric / nullif(lp_view, 0) * 100, 1) as start_rate,
  round(diagnosis_complete::numeric / nullif(diagnosis_start, 0) * 100, 1) as complete_rate,
  round(result_view::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_view_rate,
  round(line_button_click::numeric / nullif(diagnosis_complete, 0) * 100, 1) as line_click_rate,
  round(result_sent::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_sent_rate,
  round(share_click::numeric / nullif(result_view, 0) * 100, 1) as share_rate
from weekly
order by period_start desc;

create or replace view public.monthly_kpi_summary as
with monthly as (
  select
    date_trunc('month', created_at at time zone 'Asia/Tokyo')::date as period_start,
    count(distinct coalesce(session_id, visitor_id, id::text)) filter (where event_name = 'lp_view')::integer as lp_view,
    count(distinct funnel_id) filter (where event_name = 'diagnosis_start')::integer as diagnosis_start,
    count(distinct funnel_id) filter (where event_name = 'diagnosis_complete')::integer as diagnosis_complete,
    count(distinct funnel_id) filter (where event_name = 'result_view')::integer as result_view,
    count(distinct funnel_id) filter (where event_name = 'jobs_view')::integer as jobs_view,
    count(distinct funnel_id) filter (where event_name = 'line_button_click')::integer as line_button_click,
    count(distinct funnel_id) filter (where event_name = 'line_login_success')::integer as line_login_success,
    count(distinct funnel_id) filter (where event_name = 'result_sent')::integer as result_sent,
    count(distinct funnel_id) filter (where event_name = 'share_click')::integer as share_click
  from public.analytics_events
  group by 1
)
select
  period_start,
  lp_view,
  diagnosis_start,
  diagnosis_complete,
  result_view,
  jobs_view,
  line_button_click,
  line_login_success,
  result_sent,
  share_click,
  round(diagnosis_start::numeric / nullif(lp_view, 0) * 100, 1) as start_rate,
  round(diagnosis_complete::numeric / nullif(diagnosis_start, 0) * 100, 1) as complete_rate,
  round(result_view::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_view_rate,
  round(line_button_click::numeric / nullif(diagnosis_complete, 0) * 100, 1) as line_click_rate,
  round(result_sent::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_sent_rate,
  round(share_click::numeric / nullif(result_view, 0) * 100, 1) as share_rate
from monthly
order by period_start desc;

create or replace view public.result_type_summary as
select
  result_type,
  count(distinct funnel_id)::integer as diagnosis_count,
  round(count(distinct funnel_id)::numeric / nullif(sum(count(distinct funnel_id)) over (), 0) * 100, 1) as diagnosis_rate
from public.analytics_events
where event_name = 'diagnosis_complete'
  and result_type is not null
group by result_type
order by diagnosis_count desc, result_type;

grant select on public.daily_event_counts to service_role;
grant select on public.daily_kpi_summary to service_role;
grant select on public.weekly_kpi_summary to service_role;
grant select on public.monthly_kpi_summary to service_role;
grant select on public.result_type_summary to service_role;



-- cleanup_ai_career_expired_data() is defined once at the end of this production file.



-- -----------------------------------------------------------------------------
-- 20260806003000_create_dropoff_tracking.sql
-- -----------------------------------------------------------------------------
-- Dropoff tracking for swipe diagnosis.
-- Stores only the latest in-progress position per funnel, then rolls abandoned sessions
-- into aggregated counts and deletes the per-user progress row.

create table if not exists public.diagnosis_progress_sessions (
  funnel_id text primary key,
  visitor_id text null,
  session_id text null,
  diagnosis_id uuid null references public.diagnoses(id) on delete set null,
  status text not null default 'in_progress'
    check (status in ('in_progress', 'completed', 'abandoned')),
  current_order integer not null default 1 check (current_order >= 1),
  last_answered_order integer not null default 0 check (last_answered_order >= 0),
  total_questions integer not null default 40 check (total_questions >= 1),
  current_image_id text null,
  last_answered_image_id text null,
  result_type text null,
  device_type text null,
  started_at timestamp with time zone not null default now(),
  updated_at timestamp with time zone not null default now(),
  completed_at timestamp with time zone null,
  abandoned_at timestamp with time zone null
);

create index if not exists diagnosis_progress_sessions_status_idx
  on public.diagnosis_progress_sessions(status);

create index if not exists diagnosis_progress_sessions_updated_at_idx
  on public.diagnosis_progress_sessions(updated_at);

create table if not exists public.diagnosis_dropoff_counts (
  event_date date not null,
  question_order integer not null check (question_order >= 1),
  image_id text not null default '',
  total_questions integer not null default 40 check (total_questions >= 1),
  dropoff_count integer not null default 0 check (dropoff_count >= 0),
  updated_at timestamp with time zone not null default now(),
  constraint diagnosis_dropoff_counts_pkey
    primary key (event_date, question_order, image_id)
);

create index if not exists diagnosis_dropoff_counts_order_idx
  on public.diagnosis_dropoff_counts(question_order);

create index if not exists diagnosis_dropoff_counts_date_idx
  on public.diagnosis_dropoff_counts(event_date);

alter table public.diagnosis_progress_sessions enable row level security;
alter table public.diagnosis_dropoff_counts enable row level security;

grant select, insert, update, delete on public.diagnosis_progress_sessions to service_role;
grant select, insert, update, delete on public.diagnosis_dropoff_counts to service_role;

create or replace view public.dropoff_question_summary as
select
  question_order,
  image_id,
  max(total_questions)::integer as total_questions,
  sum(dropoff_count)::integer as dropoff_count,
  max(updated_at) as last_counted_at
from public.diagnosis_dropoff_counts
group by question_order, image_id
order by dropoff_count desc, question_order asc, image_id asc;

grant select on public.dropoff_question_summary to service_role;

create or replace function public.finalize_diagnosis_dropoffs(
  abandoned_after interval default interval '1 hour'
)
returns jsonb
language plpgsql
security definer
set search_path = public, pg_temp
as $function$
declare
  session_record public.diagnosis_progress_sessions%rowtype;
  dropoff_order integer;
  dropped_image_id text;
  recorded_dropoffs integer := 0;
  deleted_completed_sessions integer := 0;
begin
  -- If a diagnosis_complete event exists for a funnel, the user finished the flow.
  -- Remove the transient progress row so it can never be counted as abandoned.
  delete from public.diagnosis_progress_sessions s
  where exists (
    select 1
    from public.analytics_events e
    where e.funnel_id = s.funnel_id
      and e.event_name = 'diagnosis_complete'
  );
  get diagnostics deleted_completed_sessions = row_count;

  for session_record in
    update public.diagnosis_progress_sessions
    set
      status = 'abandoned',
      abandoned_at = now(),
      updated_at = now()
    where status = 'in_progress'
      and updated_at < now() - abandoned_after
    returning *
  loop
    dropoff_order := greatest(
      1,
      least(
        coalesce(
          session_record.current_order,
          session_record.last_answered_order + 1,
          1
        ),
        session_record.total_questions
      )
    );

    dropped_image_id := coalesce(
      session_record.current_image_id,
      session_record.last_answered_image_id,
      ''
    );

    insert into public.diagnosis_dropoff_counts (
      event_date,
      question_order,
      image_id,
      total_questions,
      dropoff_count,
      updated_at
    )
    values (
      (session_record.abandoned_at at time zone 'Asia/Tokyo')::date,
      dropoff_order,
      dropped_image_id,
      session_record.total_questions,
      1,
      now()
    )
    on conflict (event_date, question_order, image_id)
    do update set
      dropoff_count = public.diagnosis_dropoff_counts.dropoff_count + 1,
      total_questions = excluded.total_questions,
      updated_at = now();

    delete from public.diagnosis_progress_sessions
    where funnel_id = session_record.funnel_id;

    recorded_dropoffs := recorded_dropoffs + 1;
  end loop;

  return jsonb_build_object(
    'recordedDropoffs', recorded_dropoffs,
    'deletedCompletedSessions', deleted_completed_sessions,
    'finalizedAt', now()
  );
end;
$function$;

revoke all on function public.finalize_diagnosis_dropoffs(interval) from public, anon, authenticated;
grant execute on function public.finalize_diagnosis_dropoffs(interval) to service_role;



-- cleanup_ai_career_expired_data() is defined once at the end of this production file.



-- -----------------------------------------------------------------------------
-- 20260807000000_create_admin_security_tables.sql
-- -----------------------------------------------------------------------------
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



-- -----------------------------------------------------------------------------
-- 20260819000000_create_app_users.sql
-- -----------------------------------------------------------------------------
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



-- -----------------------------------------------------------------------------
-- 20260819001000_extend_linked_diagnosis_retention.sql
-- -----------------------------------------------------------------------------
-- Keep LINE-linked diagnoses for 180 days while leaving unlinked diagnoses short-lived.

create or replace function public.set_linked_diagnosis_retention()
returns trigger
language plpgsql
security definer
set search_path = public, pg_temp
as $function$
declare
  retention_target timestamptz := now() + interval '180 days';
  should_extend boolean := false;
  linked_record_changed boolean := false;
begin
  should_extend := (
    new.line_user_id is not null
    or new.user_id is not null
    or new.status in ('linked', 'sent')
  );

  if tg_op = 'INSERT' then
    linked_record_changed := true;
  else
    linked_record_changed := (
      old.line_user_id is distinct from new.line_user_id
      or old.user_id is distinct from new.user_id
      or old.status is distinct from new.status
    );
  end if;

  if should_extend and linked_record_changed then
    if new.expires_at is null or new.expires_at < retention_target then
      new.expires_at := retention_target;
    end if;
  end if;

  return new;
end;
$function$;

drop trigger if exists set_linked_diagnosis_retention_trigger on public.diagnoses;

create trigger set_linked_diagnosis_retention_trigger
before insert or update on public.diagnoses
for each row
execute function public.set_linked_diagnosis_retention();

update public.diagnoses
set expires_at = now() + interval '180 days'
where (
    line_user_id is not null
    or user_id is not null
    or status in ('linked', 'sent')
  )
  and expires_at < now() + interval '180 days';

revoke all on function public.set_linked_diagnosis_retention() from public, anon, authenticated;



-- -----------------------------------------------------------------------------
-- 20260819002000_create_user_diagnosis_records.sql
-- -----------------------------------------------------------------------------
-- User-level diagnosis history.
-- diagnoses remains the short-lived raw diagnosis table.
-- user_diagnosis_records keeps LINE-linked diagnosis history by app user.

create extension if not exists pgcrypto;

alter table public.diagnoses add column if not exists visitor_id text;
alter table public.diagnoses add column if not exists session_id text;
alter table public.diagnoses add column if not exists funnel_id text;
alter table public.diagnoses add column if not exists utm_source text;
alter table public.diagnoses add column if not exists utm_medium text;
alter table public.diagnoses add column if not exists utm_campaign text;
alter table public.diagnoses add column if not exists device_type text;
alter table public.diagnoses add column if not exists page_path text;

create index if not exists diagnoses_funnel_id_idx on public.diagnoses(funnel_id);
create index if not exists diagnoses_utm_source_idx on public.diagnoses(utm_source);

create table if not exists public.user_diagnosis_records (
  id uuid primary key default gen_random_uuid(),
  user_id uuid not null references public.app_users(id) on delete cascade,
  diagnosis_id uuid references public.diagnoses(id) on delete set null,
  line_user_id text,
  answers jsonb not null default '[]'::jsonb,
  scores jsonb not null default '{}'::jsonb,
  score_rates jsonb not null default '{}'::jsonb,
  primary_axis text,
  secondary_axis text,
  result_type text not null,
  result_payload jsonb not null default '{}'::jsonb,
  answered_count integer not null default 0,
  total_response_time_ms numeric not null default 0,
  visitor_id text,
  session_id text,
  funnel_id text,
  utm_source text,
  utm_medium text,
  utm_campaign text,
  device_type text,
  page_path text,
  diagnosed_at timestamptz not null default now(),
  retention_expires_at timestamptz not null default (now() + interval '180 days'),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

alter table public.user_diagnosis_records add column if not exists line_user_id text;
alter table public.user_diagnosis_records add column if not exists retention_expires_at timestamptz not null default (now() + interval '180 days');

create unique index if not exists user_diagnosis_records_diagnosis_id_unique
  on public.user_diagnosis_records(diagnosis_id);
create index if not exists user_diagnosis_records_user_id_idx
  on public.user_diagnosis_records(user_id);
create index if not exists user_diagnosis_records_line_user_id_idx
  on public.user_diagnosis_records(line_user_id);
create index if not exists user_diagnosis_records_result_type_idx
  on public.user_diagnosis_records(result_type);
create index if not exists user_diagnosis_records_diagnosed_at_idx
  on public.user_diagnosis_records(diagnosed_at);
create index if not exists user_diagnosis_records_utm_source_idx
  on public.user_diagnosis_records(utm_source);
create index if not exists user_diagnosis_records_retention_expires_at_idx
  on public.user_diagnosis_records(retention_expires_at);

alter table public.user_diagnosis_records enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.diagnoses to service_role;
grant select, insert, update, delete on public.user_diagnosis_records to service_role;
grant usage, select on all sequences in schema public to service_role;

create or replace function public.upsert_user_diagnosis_record(
  p_diagnosis_id uuid,
  p_user_id uuid,
  p_line_user_id text default null,
  p_visitor_id text default null,
  p_session_id text default null,
  p_funnel_id text default null,
  p_utm_source text default null,
  p_utm_medium text default null,
  p_utm_campaign text default null,
  p_device_type text default null,
  p_page_path text default null
)
returns uuid
language plpgsql
security definer
set search_path = public, pg_temp
as $function$
declare
  record_id uuid;
begin
  if p_diagnosis_id is null or p_user_id is null then
    return null;
  end if;

  insert into public.user_diagnosis_records (
    user_id,
    diagnosis_id,
    line_user_id,
    answers,
    scores,
    score_rates,
    primary_axis,
    secondary_axis,
    result_type,
    result_payload,
    answered_count,
    total_response_time_ms,
    visitor_id,
    session_id,
    funnel_id,
    utm_source,
    utm_medium,
    utm_campaign,
    device_type,
    page_path,
    diagnosed_at,
    retention_expires_at,
    created_at,
    updated_at
  )
  select
    p_user_id,
    d.id,
    coalesce(p_line_user_id, d.line_user_id, u.line_user_id),
    d.answers,
    d.scores,
    d.score_rates,
    d.primary_axis,
    d.secondary_axis,
    d.result_type,
    d.result_payload,
    coalesce(answer_stats.answered_count, 0),
    coalesce(answer_stats.total_response_time_ms, 0),
    coalesce(p_visitor_id, d.visitor_id, ae.visitor_id),
    coalesce(p_session_id, d.session_id, ae.session_id),
    coalesce(p_funnel_id, d.funnel_id, ae.funnel_id),
    coalesce(p_utm_source, d.utm_source, ae.utm_source, u.initial_utm_source),
    coalesce(p_utm_medium, d.utm_medium, ae.utm_medium, u.initial_utm_medium),
    coalesce(p_utm_campaign, d.utm_campaign, ae.utm_campaign, u.initial_utm_campaign),
    coalesce(p_device_type, d.device_type, ae.device_type, u.initial_device_type),
    coalesce(p_page_path, d.page_path, ae.page_path, u.initial_page_path),
    d.created_at,
    now() + interval '180 days',
    now(),
    now()
  from public.diagnoses d
  join public.app_users u on u.id = p_user_id
  left join lateral (
    select
      case
        when jsonb_typeof(d.answers) = 'array' then jsonb_array_length(d.answers)
        else 0
      end as answered_count,
      case
        when jsonb_typeof(d.answers) = 'array' then (
          select coalesce(sum((answer_item.value->>'responseTime')::numeric), 0)
          from jsonb_array_elements(d.answers) as answer_item(value)
          where (answer_item.value->>'responseTime') ~ '^[0-9]+(\.[0-9]+)?$'
        )
        else 0
      end as total_response_time_ms
  ) answer_stats on true
  left join lateral (
    select
      e.visitor_id,
      e.session_id,
      e.funnel_id,
      e.utm_source,
      e.utm_medium,
      e.utm_campaign,
      e.device_type,
      e.page_path
    from public.analytics_events e
    where e.diagnosis_id = d.id
      and e.event_name = 'diagnosis_complete'
    order by e.created_at asc
    limit 1
  ) ae on true
  where d.id = p_diagnosis_id
  on conflict (diagnosis_id) do update set
    user_id = excluded.user_id,
    line_user_id = coalesce(excluded.line_user_id, public.user_diagnosis_records.line_user_id),
    answers = excluded.answers,
    scores = excluded.scores,
    score_rates = excluded.score_rates,
    primary_axis = excluded.primary_axis,
    secondary_axis = excluded.secondary_axis,
    result_type = excluded.result_type,
    result_payload = excluded.result_payload,
    answered_count = excluded.answered_count,
    total_response_time_ms = excluded.total_response_time_ms,
    visitor_id = coalesce(excluded.visitor_id, public.user_diagnosis_records.visitor_id),
    session_id = coalesce(excluded.session_id, public.user_diagnosis_records.session_id),
    funnel_id = coalesce(excluded.funnel_id, public.user_diagnosis_records.funnel_id),
    utm_source = coalesce(excluded.utm_source, public.user_diagnosis_records.utm_source),
    utm_medium = coalesce(excluded.utm_medium, public.user_diagnosis_records.utm_medium),
    utm_campaign = coalesce(excluded.utm_campaign, public.user_diagnosis_records.utm_campaign),
    device_type = coalesce(excluded.device_type, public.user_diagnosis_records.device_type),
    page_path = coalesce(excluded.page_path, public.user_diagnosis_records.page_path),
    diagnosed_at = excluded.diagnosed_at,
    retention_expires_at = greatest(public.user_diagnosis_records.retention_expires_at, excluded.retention_expires_at),
    updated_at = now()
  returning id into record_id;

  return record_id;
end;
$function$;

revoke all on function public.upsert_user_diagnosis_record(
  uuid,
  uuid,
  text,
  text,
  text,
  text,
  text,
  text,
  text,
  text,
  text
) from public, anon, authenticated;
grant execute on function public.upsert_user_diagnosis_record(
  uuid,
  uuid,
  text,
  text,
  text,
  text,
  text,
  text,
  text,
  text,
  text
) to service_role;

insert into public.user_diagnosis_records (
  user_id,
  diagnosis_id,
  line_user_id,
  answers,
  scores,
  score_rates,
  primary_axis,
  secondary_axis,
  result_type,
  result_payload,
  answered_count,
  total_response_time_ms,
  visitor_id,
  session_id,
  funnel_id,
  utm_source,
  utm_medium,
  utm_campaign,
  device_type,
  page_path,
  diagnosed_at,
  retention_expires_at,
  created_at,
  updated_at
)
select
  u.id,
  d.id,
  coalesce(d.line_user_id, u.line_user_id),
  d.answers,
  d.scores,
  d.score_rates,
  d.primary_axis,
  d.secondary_axis,
  d.result_type,
  d.result_payload,
  coalesce(answer_stats.answered_count, 0),
  coalesce(answer_stats.total_response_time_ms, 0),
  coalesce(d.visitor_id, ae.visitor_id),
  coalesce(d.session_id, ae.session_id),
  coalesce(d.funnel_id, ae.funnel_id),
  coalesce(d.utm_source, ae.utm_source, u.initial_utm_source),
  coalesce(d.utm_medium, ae.utm_medium, u.initial_utm_medium),
  coalesce(d.utm_campaign, ae.utm_campaign, u.initial_utm_campaign),
  coalesce(d.device_type, ae.device_type, u.initial_device_type),
  coalesce(d.page_path, ae.page_path, u.initial_page_path),
  d.created_at,
  now() + interval '180 days',
  now(),
  now()
from public.diagnoses d
join public.app_users u on (
  d.user_id = u.id
  or (d.user_id is null and d.line_user_id is not null and d.line_user_id = u.line_user_id)
)
left join lateral (
  select
    case
      when jsonb_typeof(d.answers) = 'array' then jsonb_array_length(d.answers)
      else 0
    end as answered_count,
    case
      when jsonb_typeof(d.answers) = 'array' then (
        select coalesce(sum((answer_item.value->>'responseTime')::numeric), 0)
        from jsonb_array_elements(d.answers) as answer_item(value)
        where (answer_item.value->>'responseTime') ~ '^[0-9]+(\.[0-9]+)?$'
      )
      else 0
    end as total_response_time_ms
) answer_stats on true
left join lateral (
  select
    e.visitor_id,
    e.session_id,
    e.funnel_id,
    e.utm_source,
    e.utm_medium,
    e.utm_campaign,
    e.device_type,
    e.page_path
  from public.analytics_events e
  where e.diagnosis_id = d.id
    and e.event_name = 'diagnosis_complete'
  order by e.created_at asc
  limit 1
) ae on true
where d.status in ('linked', 'sent')
  or d.line_user_id is not null
  or d.user_id is not null
on conflict (diagnosis_id) do update set
  user_id = excluded.user_id,
  line_user_id = coalesce(excluded.line_user_id, public.user_diagnosis_records.line_user_id),
  answers = excluded.answers,
  scores = excluded.scores,
  score_rates = excluded.score_rates,
  primary_axis = excluded.primary_axis,
  secondary_axis = excluded.secondary_axis,
  result_type = excluded.result_type,
  result_payload = excluded.result_payload,
  answered_count = excluded.answered_count,
  total_response_time_ms = excluded.total_response_time_ms,
  visitor_id = coalesce(excluded.visitor_id, public.user_diagnosis_records.visitor_id),
  session_id = coalesce(excluded.session_id, public.user_diagnosis_records.session_id),
  funnel_id = coalesce(excluded.funnel_id, public.user_diagnosis_records.funnel_id),
  utm_source = coalesce(excluded.utm_source, public.user_diagnosis_records.utm_source),
  utm_medium = coalesce(excluded.utm_medium, public.user_diagnosis_records.utm_medium),
  utm_campaign = coalesce(excluded.utm_campaign, public.user_diagnosis_records.utm_campaign),
  device_type = coalesce(excluded.device_type, public.user_diagnosis_records.device_type),
  page_path = coalesce(excluded.page_path, public.user_diagnosis_records.page_path),
  diagnosed_at = excluded.diagnosed_at,
  retention_expires_at = greatest(public.user_diagnosis_records.retention_expires_at, excluded.retention_expires_at),
  updated_at = now();

create or replace view public.user_diagnosis_records_for_admin as
select
  r.id,
  r.user_id,
  u.internal_user_id,
  coalesce(r.line_user_id, u.line_user_id) as line_user_id,
  u.display_name,
  r.diagnosis_id,
  r.result_type,
  r.primary_axis,
  r.secondary_axis,
  r.scores,
  r.score_rates,
  r.answers,
  r.answered_count,
  r.total_response_time_ms,
  r.utm_source,
  r.utm_medium,
  r.utm_campaign,
  r.device_type,
  r.page_path,
  r.diagnosed_at,
  r.retention_expires_at,
  r.created_at,
  r.updated_at
from public.user_diagnosis_records r
join public.app_users u on u.id = r.user_id;

grant select on public.user_diagnosis_records_for_admin to service_role;



-- cleanup_ai_career_expired_data() is defined once at the end of this production file.



-- -----------------------------------------------------------------------------
-- 20260820000000_create_line_survey.sql
-- -----------------------------------------------------------------------------
-- LINE 4-question career preference survey.

create extension if not exists pgcrypto;

create table if not exists public.line_survey_sessions (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete set null,
  line_user_id text not null,
  survey_key text not null default 'career_preferences',
  status text not null default 'in_progress'
    check (status in ('in_progress', 'completed', 'cancelled')),
  current_step integer not null default 0,
  started_at timestamptz not null default now(),
  completed_at timestamptz,
  retention_expires_at timestamptz not null default (now() + interval '180 days'),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

create table if not exists public.line_survey_answers (
  id uuid primary key default gen_random_uuid(),
  session_id uuid not null references public.line_survey_sessions(id) on delete cascade,
  user_id uuid references public.app_users(id) on delete set null,
  line_user_id text not null,
  survey_key text not null default 'career_preferences',
  question_key text not null,
  question_label text not null,
  answer_value text not null,
  answer_label text not null,
  answered_order integer not null,
  answered_at timestamptz not null default now(),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  constraint line_survey_answers_session_question_unique unique (session_id, question_key)
);

create table if not exists public.line_user_preferences (
  user_id uuid primary key references public.app_users(id) on delete cascade,
  line_user_id text not null,
  survey_session_id uuid references public.line_survey_sessions(id) on delete set null,
  desired_location text,
  desired_location_label text,
  job_change_timing text,
  job_change_timing_label text,
  current_job text,
  current_job_label text,
  priority text,
  priority_label text,
  completed_at timestamptz,
  retention_expires_at timestamptz not null default (now() + interval '180 days'),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

create unique index if not exists line_survey_sessions_active_unique
  on public.line_survey_sessions(line_user_id, survey_key)
  where status = 'in_progress';
create index if not exists line_survey_sessions_user_id_idx
  on public.line_survey_sessions(user_id);
create index if not exists line_survey_sessions_line_user_id_idx
  on public.line_survey_sessions(line_user_id);
create index if not exists line_survey_sessions_status_idx
  on public.line_survey_sessions(status);
create index if not exists line_survey_sessions_retention_expires_at_idx
  on public.line_survey_sessions(retention_expires_at);

create index if not exists line_survey_answers_session_id_idx
  on public.line_survey_answers(session_id);
create index if not exists line_survey_answers_user_id_idx
  on public.line_survey_answers(user_id);
create index if not exists line_survey_answers_line_user_id_idx
  on public.line_survey_answers(line_user_id);
create index if not exists line_survey_answers_question_key_idx
  on public.line_survey_answers(question_key);

create index if not exists line_user_preferences_line_user_id_idx
  on public.line_user_preferences(line_user_id);
create index if not exists line_user_preferences_updated_at_idx
  on public.line_user_preferences(updated_at);
create index if not exists line_user_preferences_retention_expires_at_idx
  on public.line_user_preferences(retention_expires_at);

alter table public.line_survey_sessions enable row level security;
alter table public.line_survey_answers enable row level security;
alter table public.line_user_preferences enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.line_survey_sessions to service_role;
grant select, insert, update, delete on public.line_survey_answers to service_role;
grant select, insert, update, delete on public.line_user_preferences to service_role;
grant usage, select on all sequences in schema public to service_role;

create or replace view public.line_user_preferences_for_admin as
select
  p.user_id,
  u.internal_user_id,
  p.line_user_id,
  u.display_name,
  p.survey_session_id,
  p.desired_location,
  p.desired_location_label,
  p.job_change_timing,
  p.job_change_timing_label,
  p.current_job,
  p.current_job_label,
  p.priority,
  p.priority_label,
  p.completed_at,
  p.retention_expires_at,
  p.created_at,
  p.updated_at
from public.line_user_preferences p
left join public.app_users u on u.id = p.user_id;

grant select on public.line_user_preferences_for_admin to service_role;



-- cleanup_ai_career_expired_data() is defined once at the end of this production file.



-- -----------------------------------------------------------------------------
-- 20260820001000_create_line_conversation_history.sql
-- -----------------------------------------------------------------------------
-- LINE conversation history.
-- Full message text is kept for 180 days. Long-term summaries are stored separately.

create extension if not exists pgcrypto;

create table if not exists public.line_conversation_messages (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete set null,
  line_user_id text not null,
  direction text not null check (direction in ('incoming', 'outgoing')),
  sender_type text not null check (sender_type in ('user', 'bot', 'ai', 'staff', 'system')),
  conversation_type text not null default 'general',
  message_type text not null default 'text',
  message_text text,
  payload jsonb not null default '{}'::jsonb,
  line_message_id text,
  related_diagnosis_id uuid references public.diagnoses(id) on delete set null,
  related_survey_session_id uuid references public.line_survey_sessions(id) on delete set null,
  occurred_at timestamptz not null default now(),
  body_retention_expires_at timestamptz not null default (now() + interval '180 days'),
  created_at timestamptz not null default now()
);

create table if not exists public.line_conversation_summaries (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete cascade,
  line_user_id text not null,
  summary_type text not null default 'career_consultation',
  summary_key text not null default 'general',
  summary_text text not null,
  source_message_count integer not null default 0,
  source_survey_session_id uuid references public.line_survey_sessions(id) on delete set null,
  source_period_start timestamptz,
  source_period_end timestamptz,
  payload jsonb not null default '{}'::jsonb,
  created_by text not null default 'system',
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

create index if not exists line_conversation_messages_user_id_idx
  on public.line_conversation_messages(user_id);
create index if not exists line_conversation_messages_line_user_id_idx
  on public.line_conversation_messages(line_user_id);
create index if not exists line_conversation_messages_occurred_at_idx
  on public.line_conversation_messages(occurred_at);
create index if not exists line_conversation_messages_conversation_type_idx
  on public.line_conversation_messages(conversation_type);
create index if not exists line_conversation_messages_retention_idx
  on public.line_conversation_messages(body_retention_expires_at);
create index if not exists line_conversation_messages_survey_session_idx
  on public.line_conversation_messages(related_survey_session_id);

create index if not exists line_conversation_summaries_user_id_idx
  on public.line_conversation_summaries(user_id);
create index if not exists line_conversation_summaries_line_user_id_idx
  on public.line_conversation_summaries(line_user_id);
create index if not exists line_conversation_summaries_created_at_idx
  on public.line_conversation_summaries(created_at);
create index if not exists line_conversation_summaries_survey_session_idx
  on public.line_conversation_summaries(source_survey_session_id);
create unique index if not exists line_conversation_summaries_line_summary_key_unique
  on public.line_conversation_summaries(line_user_id, summary_key);

alter table public.line_conversation_messages enable row level security;
alter table public.line_conversation_summaries enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.line_conversation_messages to service_role;
grant select, insert, update, delete on public.line_conversation_summaries to service_role;
grant usage, select on all sequences in schema public to service_role;

create or replace view public.line_conversation_messages_for_admin as
select
  m.id,
  m.user_id,
  u.internal_user_id,
  m.line_user_id,
  u.display_name,
  m.direction,
  m.sender_type,
  m.conversation_type,
  m.message_type,
  m.message_text,
  m.line_message_id,
  m.related_diagnosis_id,
  m.related_survey_session_id,
  m.occurred_at,
  m.body_retention_expires_at,
  m.created_at
from public.line_conversation_messages m
left join public.app_users u on u.id = m.user_id;

create or replace view public.line_conversation_summaries_for_admin as
select
  s.id,
  s.user_id,
  u.internal_user_id,
  s.line_user_id,
  u.display_name,
  s.summary_type,
  s.summary_key,
  s.summary_text,
  s.source_message_count,
  s.source_survey_session_id,
  s.source_period_start,
  s.source_period_end,
  s.payload,
  s.created_by,
  s.created_at,
  s.updated_at
from public.line_conversation_summaries s
left join public.app_users u on u.id = s.user_id;

grant select on public.line_conversation_messages_for_admin to service_role;
grant select on public.line_conversation_summaries_for_admin to service_role;



-- cleanup_ai_career_expired_data() is defined once at the end of this production file.



-- -----------------------------------------------------------------------------
-- 20260820002000_create_line_ai_conversation_states.sql
-- -----------------------------------------------------------------------------
-- User-level state for LINE AI career consultation.

create extension if not exists pgcrypto;

alter table public.app_settings
  add column if not exists line_ai_max_replies integer not null default 4
  check (line_ai_max_replies between 1 and 10);

create table if not exists public.line_ai_conversation_states (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete cascade,
  line_user_id text not null unique,
  status text not null default 'idle'
    check (status in ('idle', 'ai_replying', 'cta_shown', 'handed_off', 'stopped')),
  current_session_id uuid,
  current_session_started_at timestamptz,
  ai_reply_count integer not null default 0 check (ai_reply_count >= 0),
  max_replies integer not null default 4 check (max_replies between 1 and 10),
  cta_shown_at timestamptz,
  handed_off_at timestamptz,
  stopped_at timestamptz,
  last_user_message_at timestamptz,
  last_ai_reply_at timestamptz,
  payload jsonb not null default '{}'::jsonb,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

create index if not exists line_ai_conversation_states_user_id_idx
  on public.line_ai_conversation_states(user_id);
create index if not exists line_ai_conversation_states_line_user_id_idx
  on public.line_ai_conversation_states(line_user_id);
create index if not exists line_ai_conversation_states_status_idx
  on public.line_ai_conversation_states(status);
create index if not exists line_ai_conversation_states_updated_at_idx
  on public.line_ai_conversation_states(updated_at);

alter table public.line_ai_conversation_states enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.app_settings to service_role;
grant select, insert, update, delete on public.line_ai_conversation_states to service_role;
grant usage, select on all sequences in schema public to service_role;

create or replace view public.line_ai_conversation_states_for_admin as
select
  s.id,
  s.user_id,
  u.internal_user_id,
  s.line_user_id,
  u.display_name,
  s.status,
  s.current_session_id,
  s.current_session_started_at,
  s.ai_reply_count,
  s.max_replies,
  s.cta_shown_at,
  s.handed_off_at,
  s.stopped_at,
  s.last_user_message_at,
  s.last_ai_reply_at,
  s.payload,
  s.created_at,
  s.updated_at
from public.line_ai_conversation_states s
left join public.app_users u on u.id = s.user_id;

grant select on public.line_ai_conversation_states_for_admin to service_role;



-- -----------------------------------------------------------------------------
-- 20260820003000_add_line_ai_cta_settings.sql
-- -----------------------------------------------------------------------------
-- Configurable LINE AI consultation CTA copy.

alter table public.app_settings
  add column if not exists line_ai_cta_message text not null default
    'お話を聞く限り、
年収面と今後のキャリアについて
一度担当者と整理してみても良さそうです。

担当者と一度相談してみますか？',
  add column if not exists line_ai_cta_primary_label text not null default '相談してみる',
  add column if not exists line_ai_cta_primary_text text not null default '相談してみる',
  add column if not exists line_ai_cta_secondary_label text not null default 'もう少しAIに聞く',
  add column if not exists line_ai_cta_secondary_text text not null default 'もう少しAIに聞く';

grant select, insert, update, delete on public.app_settings to service_role;



-- -----------------------------------------------------------------------------
-- 20260820004000_create_line_handoff_requests.sql
-- -----------------------------------------------------------------------------
-- Staff handoff requests from LINE AI career consultation.
-- Set STAFF_LINE_NOTIFY_TO in Supabase Secrets to push notifications to a staff LINE user/group/room.

create extension if not exists pgcrypto;

create table if not exists public.line_handoff_requests (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete set null,
  line_user_id text not null,
  internal_user_id text,
  display_name text,
  status text not null default 'new'
    check (status in ('new', 'notified', 'notification_failed', 'in_progress', 'completed', 'canceled')),
  source text not null default 'ai_cta',
  ai_session_id uuid,
  ai_reply_count integer not null default 0 check (ai_reply_count >= 0),
  max_replies integer not null default 4 check (max_replies >= 1),
  requested_at timestamptz not null default now(),
  notified_at timestamptz,
  notification_target text,
  notification_error text,
  payload jsonb not null default '{}'::jsonb,
  retention_expires_at timestamptz not null default (now() + interval '180 days'),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now()
);

create index if not exists line_handoff_requests_user_id_idx
  on public.line_handoff_requests(user_id);
create index if not exists line_handoff_requests_line_user_id_idx
  on public.line_handoff_requests(line_user_id);
create index if not exists line_handoff_requests_status_idx
  on public.line_handoff_requests(status);
create index if not exists line_handoff_requests_requested_at_idx
  on public.line_handoff_requests(requested_at);
create index if not exists line_handoff_requests_retention_idx
  on public.line_handoff_requests(retention_expires_at);

alter table public.line_handoff_requests enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.line_handoff_requests to service_role;
grant usage, select on all sequences in schema public to service_role;

create or replace view public.line_handoff_requests_for_admin as
select
  h.id,
  h.user_id,
  coalesce(h.internal_user_id, u.internal_user_id) as internal_user_id,
  h.line_user_id,
  coalesce(h.display_name, u.display_name) as display_name,
  h.status,
  h.source,
  h.ai_session_id,
  h.ai_reply_count,
  h.max_replies,
  h.requested_at,
  h.notified_at,
  h.notification_target,
  h.notification_error,
  h.payload,
  h.retention_expires_at,
  h.created_at,
  h.updated_at
from public.line_handoff_requests h
left join public.app_users u on u.id = h.user_id;

grant select on public.line_handoff_requests_for_admin to service_role;


-- Ensure service_role can use admin security tables in production.
grant select, insert, update, delete on public.admin_login_attempts to service_role;
grant select, insert, update, delete on public.admin_audit_logs to service_role;
grant usage, select on all sequences in schema public to service_role;



-- -----------------------------------------------------------------------------
-- 20260821000000_create_line_survey_question_master.sql
-- -----------------------------------------------------------------------------
-- Master data for LINE career preference survey.
-- Question keys are fixed because line_user_preferences stores answers by these columns.

create table if not exists public.line_survey_questions (
  id uuid primary key default gen_random_uuid(),
  survey_key text not null default 'career_preferences',
  question_key text not null,
  question_label text not null,
  options jsonb not null default '[]'::jsonb,
  sort_order integer not null default 1,
  enabled boolean not null default true,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  constraint line_survey_questions_key_unique unique (survey_key, question_key),
  constraint line_survey_questions_options_array check (jsonb_typeof(options) = 'array')
);

create index if not exists line_survey_questions_survey_sort_idx
  on public.line_survey_questions(survey_key, enabled, sort_order);

alter table public.line_survey_questions enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.line_survey_questions to service_role;
grant usage, select on all sequences in schema public to service_role;

insert into public.line_survey_questions (
  survey_key,
  question_key,
  question_label,
  options,
  sort_order,
  enabled
)
values
  (
    'career_preferences',
    'desired_location',
    '希望勤務地は？',
    '[{"value":"tokyo","label":"東京"},{"value":"osaka","label":"大阪"},{"value":"hokkaido","label":"北海道"},{"value":"other","label":"その他"}]'::jsonb,
    1,
    true
  ),
  (
    'career_preferences',
    'job_change_timing',
    '転職時期は？',
    '[{"value":"soon","label":"すぐ"},{"value":"within_3_months","label":"3ヶ月以内"},{"value":"within_6_months","label":"半年以内"},{"value":"undecided","label":"まだ未定"}]'::jsonb,
    2,
    true
  ),
  (
    'career_preferences',
    'current_job',
    '現在の職種は？',
    '[{"value":"sales","label":"営業"},{"value":"retail","label":"販売・接客"},{"value":"office","label":"事務"},{"value":"it","label":"IT"},{"value":"other","label":"その他"}]'::jsonb,
    3,
    true
  ),
  (
    'career_preferences',
    'priority',
    '転職で一番重視するものは？',
    '[{"value":"income","label":"年収"},{"value":"work_style","label":"働き方"},{"value":"growth","label":"成長"},{"value":"stability","label":"安定"},{"value":"job_content","label":"仕事内容"}]'::jsonb,
    4,
    true
  )
on conflict (survey_key, question_key) do nothing;



-- -----------------------------------------------------------------------------
-- 20260821001000_create_special_questions.sql
-- -----------------------------------------------------------------------------
-- Special A/B questions for the diagnosis flow.
-- These are separate from normal YES/NO swipe cards.
-- Answer rows are intentionally not included in cleanup_ai_career_expired_data().

create extension if not exists pgcrypto;

create table if not exists public.special_questions (
  id uuid primary key default gen_random_uuid(),
  question_key text not null default ('special_' || substr(replace(gen_random_uuid()::text, '-', ''), 1, 8)),
  question_text text not null,
  option_a_label text not null,
  option_b_label text not null,
  category text not null default 'preference',
  enabled boolean not null default true,
  insert_after_order integer not null default 10 check (insert_after_order >= 0),
  display_order integer not null default 1,
  visual_variant text not null default 'default',
  background_image_url text,
  background_storage_path text,
  payload jsonb not null default '{}'::jsonb,
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  constraint special_questions_question_key_unique unique (question_key),
  constraint special_questions_question_text_not_blank check (btrim(question_text) <> ''),
  constraint special_questions_option_a_not_blank check (btrim(option_a_label) <> ''),
  constraint special_questions_option_b_not_blank check (btrim(option_b_label) <> ''),
  constraint special_questions_payload_object check (jsonb_typeof(payload) = 'object')
);

create table if not exists public.special_question_answers (
  id uuid primary key default gen_random_uuid(),
  user_id uuid references public.app_users(id) on delete set null,
  internal_user_id text,
  line_user_id text,
  diagnosis_id uuid references public.diagnoses(id) on delete set null,
  user_diagnosis_record_id uuid references public.user_diagnosis_records(id) on delete set null,
  visitor_id text,
  session_id text,
  funnel_id text,
  question_id uuid references public.special_questions(id) on delete set null,
  question_key text,
  question_text text not null,
  category text,
  option_a_label text not null,
  option_b_label text not null,
  selected_option text not null check (selected_option in ('A', 'B')),
  selected_label text not null,
  answer_order integer not null check (answer_order > 0),
  response_time_ms numeric not null default 0 check (response_time_ms >= 0),
  payload jsonb not null default '{}'::jsonb,
  answered_at timestamptz not null default now(),
  created_at timestamptz not null default now(),
  updated_at timestamptz not null default now(),
  constraint special_question_answers_question_text_not_blank check (btrim(question_text) <> ''),
  constraint special_question_answers_selected_label_not_blank check (btrim(selected_label) <> ''),
  constraint special_question_answers_payload_object check (jsonb_typeof(payload) = 'object')
);

create index if not exists special_questions_enabled_order_idx
  on public.special_questions(enabled, insert_after_order, display_order);
create index if not exists special_questions_category_idx
  on public.special_questions(category);
create index if not exists special_questions_updated_at_idx
  on public.special_questions(updated_at);

create index if not exists special_question_answers_user_id_idx
  on public.special_question_answers(user_id);
create index if not exists special_question_answers_internal_user_id_idx
  on public.special_question_answers(internal_user_id);
create index if not exists special_question_answers_line_user_id_idx
  on public.special_question_answers(line_user_id);
create index if not exists special_question_answers_diagnosis_id_idx
  on public.special_question_answers(diagnosis_id);
create index if not exists special_question_answers_record_id_idx
  on public.special_question_answers(user_diagnosis_record_id);
create index if not exists special_question_answers_visitor_id_idx
  on public.special_question_answers(visitor_id);
create index if not exists special_question_answers_session_id_idx
  on public.special_question_answers(session_id);
create index if not exists special_question_answers_funnel_id_idx
  on public.special_question_answers(funnel_id);
create index if not exists special_question_answers_question_id_idx
  on public.special_question_answers(question_id);
create index if not exists special_question_answers_question_key_idx
  on public.special_question_answers(question_key);
create index if not exists special_question_answers_answered_at_idx
  on public.special_question_answers(answered_at);

create unique index if not exists special_question_answers_diagnosis_question_unique
  on public.special_question_answers(diagnosis_id, question_id)
  where diagnosis_id is not null and question_id is not null;

create unique index if not exists special_question_answers_diagnosis_question_key_unique
  on public.special_question_answers(diagnosis_id, question_key)
  where diagnosis_id is not null and question_key is not null;

alter table public.special_questions enable row level security;
alter table public.special_question_answers enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.special_questions to service_role;
grant select, insert, update, delete on public.special_question_answers to service_role;
grant usage, select on all sequences in schema public to service_role;

create or replace view public.special_question_answers_for_admin as
select
  a.id,
  a.user_id,
  coalesce(a.internal_user_id, u.internal_user_id) as internal_user_id,
  coalesce(a.line_user_id, u.line_user_id) as line_user_id,
  u.display_name,
  a.diagnosis_id,
  a.user_diagnosis_record_id,
  a.visitor_id,
  a.session_id,
  a.funnel_id,
  a.question_id,
  a.question_key,
  a.question_text,
  a.category,
  a.option_a_label,
  a.option_b_label,
  a.selected_option,
  a.selected_label,
  a.answer_order,
  a.response_time_ms,
  a.payload,
  a.answered_at,
  a.created_at,
  a.updated_at
from public.special_question_answers a
left join public.app_users u on u.id = a.user_id;

grant select on public.special_question_answers_for_admin to service_role;

-- -----------------------------------------------------------------------------
-- Compatibility hardening for partially-created production databases.
-- -----------------------------------------------------------------------------

alter table public.swipe_cards
  add column if not exists image_storage_path text,
  add column if not exists enabled boolean not null default true,
  add column if not exists sort_order integer not null default 0;

alter table public.app_settings
  add column if not exists comparison_increment_interval_hours numeric not null default 2,
  add column if not exists comparison_increment_count integer not null default 13,
  add column if not exists comparison_count_updated_at timestamptz not null default now(),
  add column if not exists diagnosis_question_count integer not null default 40,
  add column if not exists line_ai_max_replies integer not null default 4,
  add column if not exists line_ai_cta_message text not null default
    'お話を聞く限り、
年収面と今後のキャリアについて
一度担当者と整理してみても良さそうです。

担当者と一度相談してみますか？',
  add column if not exists line_ai_cta_primary_label text not null default '相談してみる',
  add column if not exists line_ai_cta_primary_text text not null default '相談してみる',
  add column if not exists line_ai_cta_secondary_label text not null default 'もう少しAIに聞く',
  add column if not exists line_ai_cta_secondary_text text not null default 'もう少しAIに聞く';

alter table public.line_states
  add column if not exists visitor_id text,
  add column if not exists session_id text,
  add column if not exists funnel_id text,
  add column if not exists result_type text,
  add column if not exists utm_source text,
  add column if not exists utm_medium text,
  add column if not exists utm_campaign text,
  add column if not exists device_type text,
  add column if not exists page_path text;
-- -----------------------------------------------------------------------------
-- Latest cleanup function and Cron schedules.
-- -----------------------------------------------------------------------------

create extension if not exists pg_cron;

create or replace function public.cleanup_ai_career_expired_data()
returns jsonb
language plpgsql
security definer
set search_path = public, pg_temp
as $function$
declare
  deleted_diagnoses integer := 0;
  deleted_diagnosis_events integer := 0;
  deleted_analytics_events integer := 0;
  deleted_line_states integer := 0;
  deleted_line_connections integer := 0;
  deleted_progress_sessions integer := 0;
  deleted_user_diagnosis_records integer := 0;
  deleted_line_survey_sessions integer := 0;
  deleted_line_user_preferences integer := 0;
  deleted_line_conversation_messages integer := 0;
  deleted_line_handoff_requests integer := 0;
  dropoff_result jsonb := '{}'::jsonb;
  has_line_connections_last_used_at boolean := false;
  has_line_connections_created_at boolean := false;
begin
  if to_regclass('public.diagnosis_progress_sessions') is not null then
    dropoff_result := public.finalize_diagnosis_dropoffs(interval '1 hour');
  end if;

  delete from public.line_states
  where expires_at < now();
  get diagnostics deleted_line_states = row_count;

  delete from public.diagnoses
  where expires_at < now();
  get diagnostics deleted_diagnoses = row_count;

  delete from public.diagnosis_events
  where created_at < now() - interval '90 days';
  get diagnostics deleted_diagnosis_events = row_count;

  delete from public.analytics_events
  where created_at < now() - interval '13 months';
  get diagnostics deleted_analytics_events = row_count;

  if to_regclass('public.diagnosis_progress_sessions') is not null then
    delete from public.diagnosis_progress_sessions
    where updated_at < now() - interval '2 days';
    get diagnostics deleted_progress_sessions = row_count;
  end if;

  if to_regclass('public.user_diagnosis_records') is not null then
    delete from public.user_diagnosis_records
    where retention_expires_at < now();
    get diagnostics deleted_user_diagnosis_records = row_count;
  end if;

  if to_regclass('public.line_survey_sessions') is not null then
    delete from public.line_survey_sessions
    where retention_expires_at < now();
    get diagnostics deleted_line_survey_sessions = row_count;
  end if;

  if to_regclass('public.line_user_preferences') is not null then
    delete from public.line_user_preferences
    where retention_expires_at < now();
    get diagnostics deleted_line_user_preferences = row_count;
  end if;

  if to_regclass('public.line_conversation_messages') is not null then
    delete from public.line_conversation_messages
    where body_retention_expires_at < now();
    get diagnostics deleted_line_conversation_messages = row_count;
  end if;

  if to_regclass('public.line_handoff_requests') is not null then
    delete from public.line_handoff_requests
    where retention_expires_at < now();
    get diagnostics deleted_line_handoff_requests = row_count;
  end if;

  if to_regclass('public.line_connections') is not null then
    select exists (
      select 1
      from information_schema.columns
      where table_schema = 'public'
        and table_name = 'line_connections'
        and column_name = 'last_used_at'
    )
    into has_line_connections_last_used_at;

    select exists (
      select 1
      from information_schema.columns
      where table_schema = 'public'
        and table_name = 'line_connections'
        and column_name = 'created_at'
    )
    into has_line_connections_created_at;

    if has_line_connections_last_used_at and has_line_connections_created_at then
      execute
        'delete from public.line_connections
         where coalesce(last_used_at, created_at) < now() - interval ''180 days''';
      get diagnostics deleted_line_connections = row_count;
    elsif has_line_connections_last_used_at then
      execute
        'delete from public.line_connections
         where last_used_at < now() - interval ''180 days''';
      get diagnostics deleted_line_connections = row_count;
    elsif has_line_connections_created_at then
      execute
        'delete from public.line_connections
         where created_at < now() - interval ''180 days''';
      get diagnostics deleted_line_connections = row_count;
    end if;
  end if;

  return jsonb_build_object(
    'dropoffResult', dropoff_result,
    'deletedDiagnoses', deleted_diagnoses,
    'deletedDiagnosisEvents', deleted_diagnosis_events,
    'deletedAnalyticsEvents', deleted_analytics_events,
    'deletedLineStates', deleted_line_states,
    'deletedLineConnections', deleted_line_connections,
    'deletedProgressSessions', deleted_progress_sessions,
    'deletedUserDiagnosisRecords', deleted_user_diagnosis_records,
    'deletedLineSurveySessions', deleted_line_survey_sessions,
    'deletedLineUserPreferences', deleted_line_user_preferences,
    'deletedLineConversationMessages', deleted_line_conversation_messages,
    'deletedLineHandoffRequests', deleted_line_handoff_requests,
    'cleanedAt', now()
  );
end;
$function$;

revoke all on function public.cleanup_ai_career_expired_data() from public, anon, authenticated;
grant execute on function public.cleanup_ai_career_expired_data() to service_role;

-- Supabase Cron is UTC. 17 19 * * * = 04:17 JST every day.
do $$
declare
  existing_jobid bigint;
begin
  select jobid
  into existing_jobid
  from cron.job
  where jobname = 'cleanup-ai-career-expired-data'
  limit 1;

  if existing_jobid is not null then
    perform cron.unschedule(existing_jobid);
  end if;
end;
$$;

select cron.schedule(
  'cleanup-ai-career-expired-data',
  '17 19 * * *',
  $$select public.cleanup_ai_career_expired_data();$$
);

commit;
