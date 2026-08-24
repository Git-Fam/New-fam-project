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
