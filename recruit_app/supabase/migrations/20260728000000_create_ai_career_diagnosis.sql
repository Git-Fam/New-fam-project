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
