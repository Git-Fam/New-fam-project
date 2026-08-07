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
    'cleanedAt', now()
  );
end;
$function$;

revoke all on function public.cleanup_ai_career_expired_data() from public, anon, authenticated;
grant execute on function public.cleanup_ai_career_expired_data() to service_role;
