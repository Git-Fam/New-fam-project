alter table public.app_settings
  add column if not exists comparison_increment_interval_hours numeric not null default 2,
  add column if not exists comparison_increment_count integer not null default 13,
  add column if not exists comparison_count_updated_at timestamptz not null default now();

do $$
begin
  if not exists (
    select 1
    from pg_constraint
    where conname = 'app_settings_comparison_increment_interval_hours_check'
  ) then
    alter table public.app_settings
      add constraint app_settings_comparison_increment_interval_hours_check
      check (comparison_increment_interval_hours >= 0);
  end if;

  if not exists (
    select 1
    from pg_constraint
    where conname = 'app_settings_comparison_increment_count_check'
  ) then
    alter table public.app_settings
      add constraint app_settings_comparison_increment_count_check
      check (comparison_increment_count >= 0);
  end if;
end $$;
