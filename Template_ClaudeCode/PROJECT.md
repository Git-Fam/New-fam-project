# PROJECT.md

## 案件概要

- 案件名：AI実装テスト
- サイト種別：コーポレートサイト
- 対応範囲：トップページ
- 対応外：WordPress化、フォーム送信処理

## デザイン

- Figma URL：https://www.figma.com/design/iaARRTEC2VMKDlVSbmyj22/%E3%82%AB%E3%83%AA%E3%82%AD%E3%83%A5%E3%83%A9%E3%83%A0%E3%80%80%E3%82%B3%E3%83%BC%E3%83%87%E3%82%A3%E3%83%B3%E3%82%B0%E4%B8%AD?node-id=5157-346&m=dev
- PCフレーム幅：1280px
- SPフレーム幅：390px
- コンテンツ最大幅：未確定
- PC左右余白：未確定
- SP左右余白：未確定
- ブレークポイント：768px

## 使用技術

- HTML：使用
- SCSS：使用
- JavaScript：jQuery
- PHP：未使用
- WordPress：未使用

## コーディング

- 命名規則：BEMを基本とする
- PCサイズ指定：既存のpmin()を使用
- SPサイズ指定：既存のs()を使用
- jQuery使用：既存コードに合わせる
- アニメーション方針：最初は実装しない

## 注意事項

- 既存ディレクトリ構成を変更しない
- index.htmlを対象とする
- 最初はHeader、Hero、次の1セクションだけ実装する
- 指示範囲外を変更しない