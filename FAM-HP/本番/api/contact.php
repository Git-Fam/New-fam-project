<?php
function isAjax()
{
  if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
      return true;
  }
  return false;
}
if(!isAjax()) {
  exit;
}
//ajax送信でPOSTされたデータを受け取る
// $post_data_1 = $_POST['type'];
// $post_data_2 = $_POST['name'];
// $post_data_3 = $_POST['affiliation'];
// $post_data_4 = $_POST['email'];
// $post_data_5 = $_POST['tel'];
// $post_data_6 = $_POST['context'];

//受け取ったデータを配列に格納
// $return_array = array($post_data_1,$post_data_2,$post_data_3,$post_data_4);
//「$return_array」をjson_encodeして出力
// echo json_encode($return_array);

//直アクセスでリダイレクトする
if(!$_POST){
  echo false;
  exit;
}

//サーバ側でのデータバリデーション
function validatePost($flg){
  if(flg == 'error') {
    echo false;
    exit;
  }
}

//POST配列ごと洗浄
function h_array($string) {
  if (is_array($string)) {
    return array_map("h_array", $string);
  } else {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }
}

$_h_POST = h_array($_POST);

//$フォームname = $_POST['フォームname'];の形でPOSTされた値を変数に格納していく
extract($_h_POST);

//$フォームnameをsession変数に格納（持ち回り用）
foreach ($_h_POST as $_name => $_value) {
  $_SESSION["$_name"] = $_value;
}


header('Content-Type: text/html; charset=UTF-8');
header('Content_Language: ja');

mb_language("uni");
mb_internal_encoding("UTF-8");

$to = $_SESSION['email'];
$title = 'お問い合わせありがとうございます';
$from = mb_encode_mimeheader("株式会社FAM");
$header = "From: " . $from . "<contract@fam-t.co.jp>\n";
$header .= "Return-Path:contract@fam-t.co.jp\n";
$header .= "Reply-to:contract@fam-t.co.jp\n";
$opt = '-f' . 'contract@fam-t.co.jp'; //送信エラーの時にエラーメールを返す先

//自動返信メール
//メール本文
$message =<<<EOT

{$_SESSION['name']}様

お問い合わせいただきありがとうございます。

下記の内容でお問い合わせを承りました。
3営業日以内に担当者よりご連絡いたします。今しばらくお待ちください。

----------------------------

【お問い合わせ項目】
{$_SESSION['type']}

【お名前】
{$_SESSION['name']}

【企業名/学校名】
{$_SESSION['affiliation']}

【メールアドレス】
{$_SESSION['email']}

【電話番号】
{$_SESSION['tel']}

【お問い合わせ内容】
{$_SESSION['context']}

----------------------------

※このメールは、宛先に記載された方のみに送信することを意図したものです。
万が一、誤ってそれ以外の方に着信している場合は、大変お手数お掛けしますが
送信者までお知らせいただくとともに、受信したメールを削除していただきますようお願い申し上げます。


・・・・・・・・・・・・・・・・・・・・・
株式会社FAM
〒160-0022 東京都新宿区新宿5-15-7東晃ビル9階
HP： https://fam-t.co.jp
Mail： contract@fam-t.co.jp
☆業界シェアNO.1多言語通訳アプリ　URL:http://www.fam-t.co.jp/smile-call/
☆Twitter自動フォローシステム　URL:https://www.fam-t.co.jp/tweetics/
☆完全成果報酬型 MEO ドットコム　URL:http://www.fam-t.co.jp/meo.com/
・・・・・・・・・・・・・・・・・・・・・

EOT;

//お問い合わせ確認メール
//メール本文
$message2 =<<<EOT

採用サイトよりお問い合わせがありました。

----------------------------

【お問い合わせ項目】
{$_SESSION['type']}

【お名前】
{$_SESSION['name']}

【企業名/学校名】
{$_SESSION['affiliation']}

【メールアドレス】
{$_SESSION['email']}

【電話番号】
{$_SESSION['tel']}

【お問い合わせ内容】
{$_SESSION['context']}

----------------------------

EOT;
mb_send_mail($to, $title, $message, $header, $opt);

//マスター管理者にもお問い合わせがあったことを知らせる
mb_send_mail('contract@fam-t.co.jp', 'お問い合わせがありました', $message2, $header, $opt);


echo json_encode($return_array);


?>
