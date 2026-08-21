-- Configurable LINE AI consultation CTA copy.

alter table public.app_settings
  add column if not exists line_ai_cta_message text not null default
    'お話を聞く限り、
年収面と今後のキャリアについて
一度担当者と整理してみても良さそうです。

担当者と一度相談してみますか？',
  add column if not exists line_ai_cta_primary_label text not null default '相談してみる',
  add column if not exists line_ai_cta_primary_text text not null default '相談してみる',
  add column if not exists line_ai_cta_secondary_label text not null default 'もう少しAIに聞く',
  add column if not exists line_ai_cta_secondary_text text not null default 'もう少しAIに聞く';

grant select, insert, update, delete on public.app_settings to service_role;
