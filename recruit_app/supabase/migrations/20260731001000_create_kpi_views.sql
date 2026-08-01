-- KPI views for the AI career diagnosis MVP.
-- Run this in Supabase Dashboard SQL Editor.

create or replace view public.daily_event_counts as
select
  (created_at at time zone 'Asia/Tokyo')::date as event_date,
  event_name,
  count(*)::integer as event_count
from public.diagnosis_events
group by 1, 2
order by 1 desc, 2;

create or replace view public.daily_kpi_summary as
with daily as (
  select
    (created_at at time zone 'Asia/Tokyo')::date as event_date,
    count(*) filter (where event_name = 'lp_view')::integer as lp_view,
    count(*) filter (where event_name = 'diagnosis_start')::integer as diagnosis_start,
    count(*) filter (where event_name = 'diagnosis_complete')::integer as diagnosis_complete,
    count(*) filter (where event_name = 'line_button_click')::integer as line_button_click,
    count(*) filter (where event_name = 'line_login_success')::integer as line_login_success,
    count(*) filter (where event_name = 'result_sent')::integer as result_sent
  from public.diagnosis_events
  group by 1
)
select
  event_date,
  lp_view,
  diagnosis_start,
  diagnosis_complete,
  line_button_click,
  line_login_success,
  result_sent,
  round(diagnosis_start::numeric / nullif(lp_view, 0) * 100, 1) as start_rate,
  round(diagnosis_complete::numeric / nullif(diagnosis_start, 0) * 100, 1) as complete_rate,
  round(line_button_click::numeric / nullif(diagnosis_complete, 0) * 100, 1) as line_click_rate,
  round(result_sent::numeric / nullif(diagnosis_complete, 0) * 100, 1) as result_sent_rate
from daily
order by event_date desc;

create or replace view public.result_type_summary as
select
  e.payload->>'resultType' as result_type,
  count(*)::integer as diagnosis_count,
  round(count(*)::numeric / nullif(sum(count(*)) over (), 0) * 100, 1) as diagnosis_rate
from public.diagnosis_events e
where e.event_name = 'diagnosis_complete'
  and e.payload ? 'resultType'
group by e.payload->>'resultType'
order by diagnosis_count desc, result_type;

grant select on public.daily_event_counts to service_role;
grant select on public.daily_kpi_summary to service_role;
grant select on public.result_type_summary to service_role;


