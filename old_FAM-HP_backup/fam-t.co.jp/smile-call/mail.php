<?php
/*
送信タスクテンプレ

@param {string} $フォームname： 格納後の変数形式
@param {array} $_SESSION['変数名']： セッション変数に格納後の配列

【確認項目】
1,リダイレクト先のURLを書く（2箇所）
2,mb_send_mail()の引数を埋める（問い合わせした人と、管理者宛に問い合わせがあったことを伝える）
3,メール本文に変数を埋め込む

*/
session_start();

header('Content-Type: text/html; charset=UTF-8');

//トークンチェック
function checkToken()
{
  //セッショントークンが空かなら不正アクセス
  if (empty($_SESSION['token'])) {
    header('Location:/smile-call/'); //リダイレクト先URLを書く
    session_destroy(); //セッション変数の破棄
    exit;
  }
}
checkToken();

$to = $_SESSION['inquiry_email'];
$title = "スマイルコールへのお問い合わせありがとうございます";
$header = "From:株式会社FAM<marketing@fam-t.co.jp>\n";
$header .= "Return-Path:marketing@fam-t.co.jp\n";
$header .= "Reply-to:marketing@fam-t.co.jp\n";
$opt = '-f' . 'marketing@fam-t.co.jp'; //送信エラーの時にエラーメールを返す先

//メールの本文
$message = <<<HTML
{$_SESSION['inquiry_name']} 様

弊社問い合わせフォームよりご連絡いただきありがとうございます。
以下の内容にてお問い合わせを承りました。
担当者より1～3営業日以内にご連絡いたしますので、
しばらくお待ちくださいますようお願い申し上げます。

■会社名/団体名
{$_SESSION['inquiry_company']}

■氏名
{$_SESSION['inquiry_name']}

■電話番号
{$_SESSION['inquiry_tel']}

■E-mail
{$_SESSION['inquiry_email']}

■郵便番号
{$_SESSION['inquiry_address']}

■都道府県
{$_SESSION['inquiry_prefectures']}

■市区町村・番地
{$_SESSION['inquiry_cities']}

■建物名
{$_SESSION['inquiry_building']}

━━━━━━━━━━━━━━━━━━━━━━
株式会社FAM
■TEL
03-5361-8428
■住所
〒160-0023
新宿区新宿5-15-7東晃ビル9階
■URL
https://www.fam-t.co.jp/
■E-mail
marketing@fam-t.co.jp
━━━━━━━━━━━━━━━━━━━━━━

HTML;

mb_language('ja'); // カレントの言語を日本語に設定する
mb_internal_encoding('UTF-8');
mb_send_mail($to, $title, $message, $header, $opt);

//マスター管理者にもお問い合わせがあったことを知らせる
mb_send_mail('marketing@fam-t.co.jp', 'スマイルコールからお問い合わせがありました', $message, $header, $opt);
session_destroy(); //セッション変数の破棄
header('Location:done.html');//送信完了後にリダイレクトするページを記述
