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
  has_line_connections_last_used_at boolean := false;
  has_line_connections_created_at boolean := false;
begin
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
    'deletedDiagnoses', deleted_diagnoses,
    'deletedDiagnosisEvents', deleted_diagnosis_events,
    'deletedAnalyticsEvents', deleted_analytics_events,
    'deletedLineStates', deleted_line_states,
    'deletedLineConnections', deleted_line_connections,
    'cleanedAt', now()
  );
end;
$function$;

revoke all on function public.cleanup_ai_career_expired_data() from public, anon, authenticated;
grant execute on function public.cleanup_ai_career_expired_data() to service_role;
