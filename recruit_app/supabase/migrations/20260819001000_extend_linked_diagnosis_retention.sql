-- Keep LINE-linked diagnoses for 180 days while leaving unlinked diagnoses short-lived.

create or replace function public.set_linked_diagnosis_retention()
returns trigger
language plpgsql
security definer
set search_path = public, pg_temp
as $function$
declare
  retention_target timestamptz := now() + interval '180 days';
  should_extend boolean := false;
  linked_record_changed boolean := false;
begin
  should_extend := (
    new.line_user_id is not null
    or new.user_id is not null
    or new.status in ('linked', 'sent')
  );

  if tg_op = 'INSERT' then
    linked_record_changed := true;
  else
    linked_record_changed := (
      old.line_user_id is distinct from new.line_user_id
      or old.user_id is distinct from new.user_id
      or old.status is distinct from new.status
    );
  end if;

  if should_extend and linked_record_changed then
    if new.expires_at is null or new.expires_at < retention_target then
      new.expires_at := retention_target;
    end if;
  end if;

  return new;
end;
$function$;

drop trigger if exists set_linked_diagnosis_retention_trigger on public.diagnoses;

create trigger set_linked_diagnosis_retention_trigger
before insert or update on public.diagnoses
for each row
execute function public.set_linked_diagnosis_retention();

update public.diagnoses
set expires_at = now() + interval '180 days'
where (
    line_user_id is not null
    or user_id is not null
    or status in ('linked', 'sent')
  )
  and expires_at < now() + interval '180 days';

revoke all on function public.set_linked_diagnosis_retention() from public, anon, authenticated;
