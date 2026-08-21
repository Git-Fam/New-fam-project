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

  delete from public.line_conversation_messages
  where body_retention_expires_at < now();
  get diagnostics deleted_line_conversation_messages = row_count;

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
    'cleanedAt', now()
  );
end;
$function$;

revoke all on function public.cleanup_ai_career_expired_data() from public, anon, authenticated;
grant execute on function public.cleanup_ai_career_expired_data() to service_role;
