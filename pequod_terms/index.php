<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <?php
    include('./includes/functions.php');

    $dev = getDevPath();

    $title = '';
    $description = '';
    $url = '';
    $is_home = true; // トップページのみ記載
    include('./includes/head.php');
    ?>
</head>

<body>
    <?php include('./includes/header.php'); ?>
    <div class="whopper">
        <?php
        $section = 'top';
        include('./includes/kv.php');
        ?>

        <main>
            <div class="wrap">
                <div class="front">
                    <section class="front__support wrap-sp">
                        <div class="C_Title C_Title_another">
                            <div class="C_Water_drop">
                                <div class="icon"></div>
                                <div class="icon"></div>
                                <div class="icon"></div>
                            </div>
                            <div class="C_Title_another--text">
                                <p class="TX">初回サーバー契約時に同時お申し込み限定</p>
                            </div>
                            <div class="C_Title_another--title">
                                <h3 class="TL">窓口の安心サポート</h3>
                            </div>
                        </div>
                    </section>
                    <section class="front__set wrap-sp" id="set">
                        <div class="C_drop-book">
                            <div class="C_Water_drop-title">
                                <h3 class="TL">セット</h3>
                            </div>
                            <div class="C_bookmark tx-in">
                                <p class="TX">
                                    特典<br>あり
                                </p>
                            </div>
                        </div>
                        <div class="front__set--content">
                            <div class="C_set">
                                <div class="C_set--top">
                                    <div class="top--title">
                                        <div class="title">
                                            <h4 class="TL">家電安心サポート</h4>
                                        </div>
                                        <p class="TX">
                                            <span>月額&nbsp;</span>980円
                                        </p>
                                    </div>
                                    <div class="top--content">
                                        <div class="content--tags">
                                            <ul>
                                                <li>
                                                    <p class="TX">ウォーターサーバーの相談窓口</p>
                                                </li>
                                                <li>
                                                    <p class="TX">動産総合保険</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="content--sentence">
                                            <ul class="sentence--lists">
                                                <li class="list">
                                                    <div class="list--text">
                                                        <p class="TX">
                                                            お使いのウォーターサーバーでお困り事などをご相談ください。<br>
                                                            水漏れや、冷水温水異常、出水不良などのウォーターサーバートラブルについて適切なアドバイスを行います。
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="C_set--bottom">
                                    <ul class="bottom--content">
                                        <li class="list">
                                            <div class="list--inner">
                                                <div class="C_bookmark"></div>
                                                <div class="inner--text">
                                                    <p class="TX">
                                                        動産総合保険は付帯サービスになります。<wbr>
                                                        家電の修理費用を補償いたします。
                                                    </p>
                                                    <small>
                                                        ※動産総合保険は、家電安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <p class="terms--link">
                                                        利用規約<br>
                                                        <a href="<?php echo $dev; ?>/terms/appliances-support.php" target="_blank" rel="noopener noreferrer">
                                                            こちらをご確認ください
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins-form.jp/form/66fd0201a7bb9" target="_blank" rel="noopener noreferrer">
                                                            家具安心サポートWEB請求フォームはこちら
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins.co.jp/agencydocument/pequod/kadenanshinsupportClaim.pdf" target="_blank" rel="noopener noreferrer">
                                                            家具安心サポート郵送からの請求書はこちら
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="C_set color__change">
                                <div class="C_set--top">
                                    <div class="top--title">
                                        <div class="title">
                                            <h4 class="TL">スマホ安心サポート</h4>
                                        </div>
                                        <p class="TX">
                                            <span>月額&nbsp;</span>980円
                                        </p>
                                    </div>
                                    <div class="top--content">
                                        <div class="content--tags">
                                            <ul>
                                                <li>
                                                    <p class="TX">ウォーターサーバーの相談窓口</p>
                                                </li>
                                                <li>
                                                    <p class="TX">通信端末修理費用保険</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="content--sentence">
                                            <ul class="sentence--lists">
                                                <li class="list">
                                                    <div class="list--text">
                                                        <p class="TX">
                                                            お使いのウォーターサーバーでお困り事などをご相談ください。<br>
                                                            水漏れや、冷水温水異常、出水不良などのウォーターサーバートラブルについて適切なアドバイスを行います。
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="C_set--bottom">
                                    <ul class="bottom--content">
                                        <li class="list">
                                            <div class="list--inner">
                                                <div class="C_bookmark"></div>
                                                <div class="inner--text">
                                                    <p class="TX">
                                                        通信端末修理費用保険は付帯サービスになります。<wbr>
                                                        スマホの修理費用を補償いたします。
                                                    </p>
                                                    <small>
                                                        ※通信端末修理費用保険は、スマホ安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <p class="terms--link">
                                                        利用規約<br>
                                                        <a href="<?php echo $dev; ?>/terms/smartphone-support.php" target="_blank" rel="noopener noreferrer">
                                                            こちらをご確認ください
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins-form.jp/form/66fd04d15e43c" target="_blank" rel="noopener noreferrer">
                                                            スマホ安心サポート（通信端末修理費用保険）WEB請求フォームはこちら
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins.co.jp/agencydocument/pequod/sumahoanshinsupportClaim.pdf" target="_blank" rel="noopener noreferrer">
                                                            スマホ安心サポート（通信端末修理費用保険）郵送からのご請求はこちら
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="C_set">
                                <div class="C_set--top">
                                    <div class="top--title">
                                        <div class="title">
                                            <h4 class="TL">プレミアム安心保証パック</h4>
                                        </div>
                                        <p class="TX">
                                            <span>月額&nbsp;</span>1,780円
                                        </p>
                                    </div>
                                    <div class="top--content">
                                        <div class="content--tags">
                                            <ul>
                                                <li>
                                                    <p class="TX">ウォーターサーバーの相談窓口</p>
                                                </li>
                                                <li>
                                                    <p class="TX">駆けつけ</p>
                                                </li>
                                                <li>
                                                    <p class="TX">健康相談</p>
                                                </li>
                                                <li>
                                                    <p class="TX">動産総合保険</p>
                                                </li>
                                                <li>
                                                    <p class="TX">通信端末修理費用保険</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="content--sentence">
                                            <ul class="sentence--lists">
                                                <li class="list">
                                                    <div class="list--title">
                                                        <h5 class="TL">
                                                            ウォーターサーバーの相談窓口
                                                        </h5>
                                                    </div>
                                                    <div class="list--text">
                                                        <p class="TX">
                                                            お使いのウォーターサーバーでお困り事などをご相談ください。<br>
                                                            水漏れや、冷水温水異常、出水不良などのウォーターサーバートラブルについて適切なアドバイスを行います。
                                                        </p>
                                                    </div>
                                                </li>
                                                <li class="list">
                                                    <div class="list--title">
                                                        <h5 class="TL">
                                                            ライフレスキュー24
                                                        </h5>
                                                    </div>
                                                    <div class="list--text">
                                                        <p class="TX">
                                                            日常生活でのトラブルの際お電話1本で専門スタッフが駆けつけます。<br>
                                                            24時間365日いつでもご相談ください。
                                                        </p>
                                                    </div>
                                                    <ul class="inner--lists">
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                鍵のトラブル
                                                            </h5>
                                                            <p class="TX">
                                                                鍵を失くした/鍵が折れた/鍵の調子が悪いなど
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                水まわりのトラブル
                                                            </h5>
                                                            <p class="TX">
                                                                トイレが詰まった/水が出ない、止まらないなど
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                ガラスのトラブル
                                                            </h5>
                                                            <p class="TX">
                                                                強風でガラスが割れたガラスにヒビが入っているなど
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                電気/ガスのトラブル
                                                            </h5>
                                                            <p class="TX">
                                                                電気がつかない/給湯器が故障しているかもなど
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="list">
                                                    <div class="list--title">
                                                        <h5 class="TL">
                                                            メディカルレスキュー
                                                        </h5>
                                                    </div>
                                                    <div class="list--text">
                                                        <p class="TX">
                                                            医療スタッフが常駐し24時間365日お電話一本で適切なアドバイスをお届けします。<br>
                                                            ご自身やご家族の健康にかかわる記録を登録し確認することができます。
                                                        </p>
                                                    </div>
                                                    <ul class="inner--lists">
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                記録できる項目
                                                            </h5>
                                                            <p class="TX">
                                                                体重/食事/体温/血圧/食事/整理/服薬/メモ
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="C_set--bottom">
                                    <ul class="bottom--content">
                                        <li class="list">
                                            <div class="list--inner">
                                                <div class="C_bookmark"></div>
                                                <div class="inner--text">
                                                    <p class="TX">
                                                        通信端末修理費用保険は付帯サービスになります。<wbr>
                                                        スマホの修理費用を補償いたします。
                                                    </p>
                                                    <small>
                                                        ※通信端末修理費用保険は、スマホ安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <p class="terms--link">
                                                        利用規約<br>
                                                        <a href="<?php echo $dev; ?>/terms/safety-pack.php" target="_blank" rel="noopener noreferrer">
                                                            こちらをご確認ください
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins-form.jp/form/66fd04d15e43c" target="_blank" rel="noopener noreferrer">
                                                            プレミアム安心保証パック（通信端末修理費用保険）WEB請求フォームはこちら
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins.co.jp/agencydocument/pequod/sumahoanshinsupportClaim.pdf" target="_blank" rel="noopener noreferrer">
                                                            プレミアム安心保証パック（通信端末修理費用保険）郵送からのご請求はこちら
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="list--inner">
                                                <div class="C_bookmark"></div>
                                                <div class="inner--text">
                                                    <p class="TX">
                                                        動産総合保険は付帯サービスになります。<wbr>
                                                        家電の修理費用を補償いたします。
                                                    </p>
                                                    <small>
                                                        ※動産総合保険は、家電安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <p class="terms--link">
                                                        利用規約<br>
                                                        <a href="<?php echo $dev; ?>/terms/warranty-pack.php" target="_blank" rel="noopener noreferrer">
                                                            こちらをご確認ください
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins-form.jp/form/66fd0201a7bb9" target="_blank" rel="noopener noreferrer">
                                                            プレミアム安心保証パック（動産総合保険）WEB請求フォームはこちら
                                                        </a>
                                                    </p>
                                                    <p class="terms--link">
                                                        <a href="https://www.sakura-ins.co.jp/agencydocument/pequod/premiumanshinhosyoupuckClaim.pdf" target="_blank" rel="noopener noreferrer">
                                                            プレミアム安心保証パック（動産総合保険）郵送からのご請求はこちら
                                                        </a>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="C_set">
                                <div class="C_set--top">
                                    <div class="top--title">
                                        <div class="title">
                                            <h4 class="TL">動産総合保険（付帯サービス）</h4>
                                        </div>
                                    </div>
                                    <div class="top--content">
                                        <div class="content--sentence">
                                            <ul class="sentence--lists">
                                                <li class="list">
                                                    <ul class="inner--lists">
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                対象の機器
                                                            </h5>
                                                            <p class="TX">
                                                                ウォーターサーバー<br>
                                                                冷蔵庫・冷凍庫<br>
                                                                コーヒーメーカー<br>
                                                                ※事故日を機起算日として5年以内に新品として購入した機器
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                対象の損害
                                                            </h5>
                                                            <p class="TX">
                                                                外装の破損、損壊、水濡れ、電気的機械的故障、盗難
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                免責金額
                                                            </h5>
                                                            <p class="TX">
                                                                なし
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                保険金額
                                                            </h5>
                                                            <p class="TX">
                                                                最大30万円
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                年間使用上限回数
                                                            </h5>
                                                            <p class="TX">
                                                                1回
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <p class="TX">
                                                                【保険金請求に関するお問い合わせ先】<br>
                                                                さくら損害保険 保険金請求窓口　 電話番号：0120-502-720<br>
                                                                受付時間：9:00～17:00（年末年始は除く）
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="C_set">
                                <div class="C_set--top">
                                    <div class="top--title">
                                        <div class="title">
                                            <h4 class="TL">通信端末修理費用保険（付帯サービス）</h4>
                                        </div>
                                    </div>
                                    <div class="top--content">
                                        <div class="content--sentence">
                                            <ul class="sentence--lists">
                                                <li class="list">
                                                    <ul class="inner--lists">
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                対象の機器
                                                            </h5>
                                                            <p class="TX">
                                                                スマートフォン<br>
                                                                タブレット端末（タブレットPCを含みます。）<br>
                                                                ノートパソコン<br>
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                対象の損害
                                                            </h5>
                                                            <p class="TX">
                                                                外装破損・損壊、水濡れ、盗難、全損、故障(ただし、自然災害、経年劣化によるものは対象外とします。)
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                免責金額
                                                            </h5>
                                                            <p class="TX">
                                                                なし
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                年間保険金額
                                                            </h5>
                                                            <p class="TX">
                                                                上限5万円
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                年間保険回数
                                                            </h5>
                                                            <p class="TX">
                                                                1回
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <p class="TX">
                                                                【保険金請求に関するお問い合わせ先】<br>
                                                                さくら損害保険 保険金請求窓口　 電話番号：0120-982-267<br>
                                                                受付時間：10:00～19:00（年末年始は除く）
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </section>
                    <section class="front__single" id="single">
                        <div class="C_Water_drop-title">
                            <h3 class="TL">単品</h3>
                        </div>
                        <div class="front__single--content">
                            <div class="C_single">
                                <div class="single--inner">
                                    <ul class="single--lists">
                                        <li class="list">
                                            <div class="item">
                                                <p class="TX">HOZON</p>
                                            </div>
                                            <div class="cost">
                                                <p class="TX"><span>月額&nbsp;</span>550円</p>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="item">
                                                <p class="TX">SEITON</p>
                                            </div>
                                            <div class="cost">
                                                <p class="TX"><span>月額&nbsp;</span>550円</p>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="item">
                                                <p class="TX">メディカルレスキュー</p>
                                            </div>
                                            <div class="cost">
                                                <p class="TX"><span>月額&nbsp;</span>550円</p>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="item">
                                                <p class="TX">ライフレスキュー</p>
                                            </div>
                                            <div class="cost">
                                                <p class="TX"><span>月額&nbsp;</span>550円</p>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="item">
                                                <p class="TX">ウォーターサーバーの<wbr>相談窓口</p>
                                            </div>
                                            <div class="cost">
                                                <p class="TX"><span>月額&nbsp;</span>980円</p>
                                            </div>
                                        </li>

                                    </ul>
                                    <!-- <div class="single--img">
                                        <div class="img"></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <?php include('./includes/footer.php'); ?>
    </div>
    <?php include('./includes/jq.php'); ?>
</body>

</html>