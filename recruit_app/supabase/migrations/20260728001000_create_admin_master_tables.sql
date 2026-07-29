create table if not exists public.app_settings (
  id boolean primary key default true,
  comparison_count integer not null default 18542 check (comparison_count >= 0),
  job_count integer not null default 12 check (job_count >= 0),
  high_match_count integer not null default 4 check (high_match_count >= 0),
  require_line_before_result boolean not null default false,
  updated_at timestamptz not null default now(),
  constraint app_settings_singleton check (id)
);

insert into public.app_settings (id)
values (true)
on conflict (id) do nothing;

create table if not exists public.diagnosis_results (
  result_type text primary key,
  name text not null,
  catch_copy text not null,
  description text not null,
  strengths jsonb not null default '[]'::jsonb check (jsonb_typeof(strengths) = 'array'),
  jobs jsonb not null default '[]'::jsonb check (jsonb_typeof(jobs) = 'array'),
  industries jsonb not null default '[]'::jsonb check (jsonb_typeof(industries) = 'array'),
  line_message text not null,
  percent integer not null default 8 check (percent between 1 and 99),
  sort_order integer not null default 0,
  updated_at timestamptz not null default now()
);

create index if not exists diagnosis_results_sort_order_idx
  on public.diagnosis_results(sort_order);

create table if not exists public.swipe_cards (
  card_id text primary key,
  question text not null,
  visual text not null,
  image text not null,
  image_storage_path text,
  yes_scores jsonb not null default '{}'::jsonb check (jsonb_typeof(yes_scores) = 'object'),
  no_scores jsonb not null default '{}'::jsonb check (jsonb_typeof(no_scores) = 'object'),
  sort_order integer not null default 0,
  updated_at timestamptz not null default now()
);

create index if not exists swipe_cards_sort_order_idx
  on public.swipe_cards(sort_order);

alter table public.app_settings enable row level security;
alter table public.diagnosis_results enable row level security;
alter table public.swipe_cards enable row level security;

grant usage on schema public to service_role;
grant select, insert, update, delete on public.app_settings to service_role;
grant select, insert, update, delete on public.diagnosis_results to service_role;
grant select, insert, update, delete on public.swipe_cards to service_role;

insert into storage.buckets (id, name, public, file_size_limit, allowed_mime_types)
values (
  'swipe-images',
  'swipe-images',
  true,
  8388608,
  array['image/jpeg', 'image/png', 'image/webp']
)
on conflict (id) do update set
  public = excluded.public,
  file_size_limit = excluded.file_size_limit,
  allowed_mime_types = excluded.allowed_mime_types;

-- Admin reads/writes go through Edge Functions with the service role key.
-- The public app reads the same master through Edge Functions, not direct table policies.
