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
on conflict (survey_key, question_key) do update set
  question_label = excluded.question_label,
  options = excluded.options,
  sort_order = excluded.sort_order,
  enabled = excluded.enabled,
  updated_at = now();
