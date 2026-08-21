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
