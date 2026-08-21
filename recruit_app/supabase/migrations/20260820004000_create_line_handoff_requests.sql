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
