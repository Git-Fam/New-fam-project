---
name: implement-figma
description: FigmaデザインからHTML・SCSS・JavaScriptを実装する。新規セクション、ページ、レスポンシブ実装、デザイン差分修正に使う。
---

# Figma実装

1. `CLAUDE.md` と `PROJECT.md` を読む。
2. PC・SPフレーム、フォント、画像、SVG、余白、最大幅、Auto Layoutを確認する。
3. 既存の類似コンポーネントとclass命名を検索する。
4. 要素を「全体共通・複数ページ共通・ページ固有・JS動作あり」に分類する。
5. Auto Layoutをflex/gridへ翻訳し、不要なdivやabsoluteを増やさない。
6. PCは `pmin()`、SPは `s()`、既存mixinを基本にする。ただし `PROJECT.md` の指定を優先する。
   - `pmin()` はPCサイズのみに反映する。必ず `@include pc {}` で囲む。
   - `s()` はSPサイズのみに反映する。必ず `@include sp {}` で囲む。
   - `pmin()` の値をそのまま `s()` に置き換えてSPへコピーしない。SPはFigmaのSP値を使う。
7. PC基準幅、SP基準幅、中間幅、狭いSPで確認する。
8. 変更ファイル、デザインとの差異、未確認素材を報告する。
