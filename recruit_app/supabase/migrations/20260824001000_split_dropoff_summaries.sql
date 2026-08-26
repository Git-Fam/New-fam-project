create or replace view public.dropoff_position_summary as
select
  question_order,
  max(total_questions)::integer as total_questions,
  sum(dropoff_count)::integer as dropoff_count,
  max(updated_at) as last_counted_at
from public.diagnosis_dropoff_counts
group by question_order
order by dropoff_count desc, question_order asc;

grant select on public.dropoff_position_summary to service_role;

create or replace view public.dropoff_card_summary as
select
  image_id,
  sum(dropoff_count)::integer as dropoff_count,
  count(distinct question_order)::integer as position_count,
  min(question_order)::integer as first_question_order,
  max(question_order)::integer as last_question_order,
  max(updated_at) as last_counted_at
from public.diagnosis_dropoff_counts
where image_id is not null and image_id <> ''
group by image_id
order by dropoff_count desc, image_id asc;

grant select on public.dropoff_card_summary to service_role;
