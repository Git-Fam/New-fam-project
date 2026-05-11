<?php
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
session_start();

header("Content-Type: text/html; charset=UTF-8");

//直アクセスでリダイレクトする
if(!$_POST){
header('Location:/smile-call/');//リダイレクト先URLを書く
}

//トークンチェック
function checkToken(){
//セッションが空か生成したトークンと異なるトークンでPOSTされたときは不正アクセス
if(empty($_SESSION['token']) || ($_SESSION['token'] != $_POST['token'])){
header('Location:/smile-call/');//リダイレクト先URLを書く
session_destroy();//セッション変数の破棄
exit;
}
}

//サーバ側でのデータバリデーション
function validatePost($flg){
if(flg == 'error') {
header('Location:/smile-call/');//リダイレクト先URLを書く
session_destroy();//セッション変数の破棄
exit;
}
}

checkToken();

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

//メールアドレス用バリデーション（$mailが変数の場合）
if(strpos($mail,'@')===false){
validatePost(error);
}
if(mb_strlen($mail,'utf-8') !==strlen($mail)) {
validatePost(error);
}

/*
文字数制限チェック

@param {string} $str：変数
@param {int} num：制限文字数

*/
//項目の数だけ、増やして書く
if(mb_strlen($str,'utf-8') > num) {
validatePost(error);
}

?>

  <!-- 確認画面の各項目に出力する場合の記述テンプレ -->
  <!--<?php echo $フォームname ?>-->

  
    <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content= "">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="/smile-call/assets/css/app.css">
<title>お問い合わせ確認画面｜SMILE CALL（スマイルコール）</title>
<meta name=”robots” content=”noindex”>
</head>
<body>
<div class="l-wrap">

      <div class="p-confirm">
        <form action="mail.php" method="post" id="confirmForm" name="confirmForm">
          <div class="p-confirm__inner">
            <p class="p-confirm__ttl">確認画面</p>
            <ul>
              <li>
                <dl>
                  <dt>会社名/団体名</dt>
                  <dd>
                    <?php echo $inquiry_company ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>氏名</dt>
                  <dd>
                    <?php echo $inquiry_name ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>電話番号</dt>
                  <dd>
                    <?php echo $inquiry_tel ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>E-mail</dt>
                  <dd>
                    <?php echo $inquiry_email ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>郵便番号</dt>
                  <dd>
                    <?php echo $inquiry_address ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>都道府県</dt>
                  <dd>
                    <?php echo $inquiry_prefectures ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>市区町村・番地</dt>
                  <dd>
                    <?php echo $inquiry_cities ?>
                  </dd>
                </dl>
              </li>
              <li>
                <dl>
                  <dt>建物名</dt>
                  <dd>
                    <?php echo $inquiry_building ?>
                  </dd>
                </dl>
              </li>
            </ul>
            <div class="p-confirm__btn--wrap">
              <a href="javascript:void(0)" onclick="javascript:history.back()" class="p-confirm__btn--return">修正する</a>
              <p class="p-confirm__btn--submitWrap">
                <input type="submit" value="送信する" class="p-confirm__btn--submit">
              </p>
            </div>
          </div>
        </form>
      </div>
      <footer>
<div class="l-footer__innre">
  <a href="https://www.fam-t.co.jp/">運営会社</a>
  <p>&copy;2018 FAM  All rights reserved.</p>
</div>
</footer>

</div><!-- l-wrap -->
<!--[if lt IE 9]>
<script src="//api.html5media.info/1.1.8/html5media.min.js"></script>
<![endif]-->
<script src="/smile-call/assets/js/bundle.js"></script>
</body>
</html>

