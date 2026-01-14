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
$post_data_1 = $_POST['name'];
$post_data_2 = $_POST['group'];
$post_data_3 = $_POST['business'];
$post_data_4 = $_POST['present'];
$post_data_5 = $_POST['plan'];
$post_data_6 = $_POST['email'];
$post_data_7 = $_POST['tel'];
$post_data_8 = $_POST['content'];


//受け取ったデータを配列に格納
$return_array = array($post_data_1,$post_data_2,$post_data_3,$post_data_4,$post_data_5,$post_data_6,$post_data_7,$post_data_8);
//「$return_array」をjson_encodeして出力
// echo json_encode($return_array);

/*
  送信確認画面テンプレ

  @param {array} $_POST： formからポストされた値の配列
  @param {array} $_h_POST： エスケープ処理後の配列
  @param {string} $フォームname： 格納後の変数形式
  @param {array} $_SESSION['変数名']： セッション変数に格納後の配列

  【確認項目】
  1,リダイレクト先のURLを書く
  2,エラーもしくは画面が表示されない場合はvar_dumpで中身を調べる
  3,確認画面に埋め込む場合はechoを入れる

*/

header("Content-Type: text/html; charset=UTF-8");

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
    return htmlspecialchars($string, ENT_QUOTES);
  }
}

$_h_POST = h_array($_POST);

//$フォームname = $_POST['フォームname'];の形でPOSTされた値を変数に格納していく
extract($_h_POST);

//$フォームnameをsession変数に格納（持ち回り用）
foreach ($_h_POST as $_name => $_value) {
  $_SESSION["$_name"] = $_value;
}

/*
  送信タスクテンプレ

  @param {string} $フォームname： 格納後の変数形式
  @param {array} $_SESSION['変数名']： セッション変数に格納後の配列

  【確認項目】
  1,リダイレクト先のURLを書く（2箇所）
  2,mb_send_mail()の引数を埋める（問い合わせした人と、管理者宛に問い合わせがあったことを伝える）
  3,メール本文に変数を埋め込む

*/

header('Content-Type: text/html; charset=UTF-8');
header('Content_Language: ja');

mb_language("uni");
mb_internal_encoding("UTF-8");

$to = $_SESSION['email'];
$title = 'Tweeticsへのお問い合わせありがとうございます';
$from = mb_encode_mimeheader("marketing@fam-t.co.jp");
$header = "From:株式会社FAM<marketing@fam-t.co.jp>\n";
$header .= "Return-Path:marketing@fam-t.co.jp\n";
$header .= "Reply-to: marketing@fam-t.co.jp\n";
$opt = '-f'.'marketing@fam-t.co.jp'; //送信エラーの時にエラーメールを返す先
//メールの本文
$message =<<<HTML

{$_SESSION['name']}様

お問い合わせいただきありがとうございます。

下記の内容でお問い合わせを承りました。
3営業日以内に担当者よりご連絡いたします。今しばらくお待ちください。

----------------------------

【お名前】
{$_SESSION['name']}

【企業名】
{$_SESSION['group']}

【営業担当者】
{$_SESSION['business']}

【紹介ID】
{$_SESSION['present']}

【希望プラン】
{$_SESSION['plan']}

【メールアドレス】
{$_SESSION['email']}

【電話番号】
{$_SESSION['tel']}

【詳細】
{$_SESSION['content']}

----------------------------

※万が一返信がない場合には、ご入力いただいたメールアドレスが誤っている場合があります。お手数ですが再度お問い合わせをお願いいたします。


HTML;

//管理者へのメールの本文
$message2 =<<<HTML

Tweeticsよりお問い合わせがありました。

----------------------------

【お名前】
{$_SESSION['name']}

【企業名】
{$_SESSION['group']}

【営業担当者】
{$_SESSION['business']}

【紹介ID】
{$_SESSION['present']}

【希望プラン】
{$_SESSION['plan']}

【メールアドレス】
{$_SESSION['email']}

【電話番号】
{$_SESSION['tel']}

【詳細】
{$_SESSION['content']}

----------------------------

HTML;

mb_send_mail($to, $title, $message, $header, $opt);

//マスター管理者にもお問い合わせがあったことを知らせる
mb_send_mail('marketing@fam-t.co.jp', 'Tweeticsよりお問い合わせがありました', $message2, $header, $opt);


echo json_encode($return_array);

?>