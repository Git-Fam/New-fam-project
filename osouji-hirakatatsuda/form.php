<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 日本語メールの文字化け対策
    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    // ▼▼▼ 重要 ▼▼▼
    // 送信元(From)は「このサイトを置いているサーバーのドメイン」のアドレスにする。
    // 例) info@osouji-hirakatatsuda.com など。@icloud.com や @gmail.com は使わないこと！
    $fromAddress = "info@osouji-hirakatatsuda.link18.jp"; // このサイトのドメインのアドレス（SPF認証を通すため）
    $fromName    = "おそうじ本舗枚方津田店";

    // フォームの入力値を変数に代入
    $radio = $_POST["radio"];
    $name = $_POST["name"];
    $furigana = $_POST["furigana"];
    $address = $_POST["address"];
    $tel = $_POST["tel"];
    $email = $_POST["email"];
    $isMsg = $_POST["isMsg"];
    
    // 送信先１
    $message1 = "以下内容で受け付けました。\n";
    $message1 .= "==============================================================\n\n";
    $message1 .= "お問合せ項目: " . htmlspecialchars($radio, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "名前（漢字）: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "ふりがな: " . htmlspecialchars($furigana, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "住所: " . htmlspecialchars($address, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "電話番号: " . htmlspecialchars($tel, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "メールアドレス: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "お問合せ内容: " . htmlspecialchars($isMsg, ENT_QUOTES, 'UTF-8') . "\n";
    $message1 .= "==============================================================\n";
    $message1 .= "こちらは自動返信メールです。\n" . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "に返信お願い致します。";

    // 送信先２
    $message2 = "お問い合わせありがとうございます。以下内容で受け付けました。\n";
    $message2 .= "==============================================================\n\n";
    $message2 .= "お問合せ項目: " . htmlspecialchars($radio, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "名前（漢字）: " . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "ふりがな: " . htmlspecialchars($furigana, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "住所: " . htmlspecialchars($address, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "電話番号: " . htmlspecialchars($tel, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "メールアドレス: " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "お問合せ内容: " . htmlspecialchars($isMsg, ENT_QUOTES, 'UTF-8') . "\n";
    $message2 .= "==============================================================\n";
    $message2 .= "こちらは自動返信メールです。担当者からの返信をお待ちください。\n";
    
    // メールを送信先1に送信（店舗への通知）
    // $to1 = "seedless0802@gmail.com"; // 受信者のテストメールアドレス
    $to1 = "liber0927@icloud.com"; // 店舗の受信メールアドレス
    $subject1 = "おそうじ本舗枚方津田店からお問い合わせがありました。"; // メールの件名
    // From はサーバーのドメイン、Reply-To をお客様のアドレスにする（返信ボタンでお客様へ返せる）
    $headers1  = "From: " . mb_encode_mimeheader($fromName) . " <" . $fromAddress . ">\r\n";
    $headers1 .= "Reply-To: " . $email . "\r\n";

    // メールを送信先2に送信（お客様への自動返信）
    $to2 = $_POST["email"]; // お客様のメールアドレス
    $subject2 = "お問い合わせを受け付けました。"; // メールの件名
    $headers2  = "From: " . mb_encode_mimeheader($fromName) . " <" . $fromAddress . ">\r\n";
    $headers2 .= "Reply-To: " . $fromAddress . "\r\n";

    // 2つのメールを送信（日本語対応の mb_send_mail を使用）
    $mail1 = mb_send_mail($to1, $subject1, $message1, $headers1);
    $mail2 = mb_send_mail($to2, $subject2, $message2, $headers2);

    if ($mail1 && $mail2) {
        // 送信が成功した場合の処理
        echo '<script>alert("送信が完了しました。担当者からの返信をお待ちください。"); window.location.href = "index.html";</script>';
    } else {
        // 送信が失敗した場合の処理
        echo '<script>alert("メールの送信に失敗しました。もう一度お試しください。");</script>';
    }
}
?>
