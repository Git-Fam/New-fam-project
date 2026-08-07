alter table public.swipe_cards
  add column if not exists enabled boolean not null default true;
