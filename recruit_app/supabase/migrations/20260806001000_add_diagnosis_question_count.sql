alter table public.app_settings
  add column if not exists diagnosis_question_count integer not null default 40;

do $$
begin
  if not exists (
    select 1
    from pg_constraint
    where conname = 'app_settings_diagnosis_question_count_check'
  ) then
    alter table public.app_settings
      add constraint app_settings_diagnosis_question_count_check
      check (diagnosis_question_count >= 1);
  end if;
end $$;
