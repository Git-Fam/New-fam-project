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

  delete from public.line_survey_sessions
  where retention_expires_at < now();
  get diagnostics deleted_line_survey_sessions = row_count;

  delete from public.line_user_preferences
  where retention_expires_at < now();
  get diagnostics deleted_line_user_preferences = row_count;

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
    'cleanedAt', now()
  );
end;
$function$;

revoke all on function public.cleanup_ai_career_expired_data() from public, anon, authenticated;
grant execute on function public.cleanup_ai_career_expired_data() to service_role;
