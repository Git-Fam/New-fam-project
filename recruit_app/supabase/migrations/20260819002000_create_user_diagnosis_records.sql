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
  dropoff_result jsonb := '{}'::jsonb;
  has_line_connections_last_used_at boolean := false;
  has_line_connections_created_at boolean := false;
begin
  dropoff_result := public.finalize_diagnosis_dropoffs(interval '1 hour');

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

  delete from public.diagnosis_progress_sessions
  where updated_at < now() - interval '2 days';
  get diagnostics deleted_progress_sessions = row_count;

  delete from public.user_diagnosis_records
  where retention_expires_at < now();
  get diagnostics deleted_user_diagnosis_records = row_count;

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
    'cleanedAt', now()
  );
end;
$function$;

revoke all on function public.cleanup_ai_career_expired_data() from public, anon, authenticated;
grant execute on function public.cleanup_ai_career_expired_data() to service_role;
