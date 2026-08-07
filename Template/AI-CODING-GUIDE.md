# AIコーディング雛形の使い方

## 1. 案件開始時

`PROJECT.md` を案件仕様に合わせて埋めます。Claude Codeでは次のように依頼できます。

```text
/project-setup
この案件の仕様を整理し、PROJECT.mdを更新してください。
```

## 2. Figmaから実装

```text
/implement-figma
PROJECT.mdとFigmaを確認し、トップページのFVと導入セクションを実装してください。
対象外のファイルは変更せず、完了後に変更ファイルと未確認事項を報告してください。
```

## 3. WordPress化

```text
/build-wordpress
完成済みの静的トップページをWordPress化してください。
最初に既存テーマ構成を確認し、今回はfront-page.phpへの変換だけを行ってください。
```

## 4. 保守修正

```text
/maintenance
スマートフォンでヘッダーのボタンが画面外にはみ出す問題を、最小差分で修正してください。
原因と影響範囲も報告してください。
```

## 5. レビュー

```text
/review-frontend
今回の変更をレビューしてください。まず問題点だけを重要度順に報告し、まだ修正はしないでください。
```

## ファイルの役割

- `CLAUDE.md`: 常に守らせるプロジェクトルール
- `PROJECT.md`: 案件ごとに変わる仕様
- `.claude/skills/*/SKILL.md`: 作業ごとの手順
- `AI-CODING-GUIDE.md`: 人間向けの使い方

ルールを増やしすぎると指示がぼやけるため、常時必須の内容だけを `CLAUDE.md` に置き、作業手順はSkillsへ分けます。
