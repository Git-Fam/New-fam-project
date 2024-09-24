<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <?php
    // 開発用
    // $dev = '';
    $dev = '/pequod_terms';

    $root = $_SERVER['DOCUMENT_ROOT'];
    $dev_root = $root . $dev;

    $title = 'TOP';
    $description = 'ディスクリプション';
    $url = '';
    $is_home = true; // トップページのみ記載
    include($dev_root . '/includes/head.php');
    ?>
</head>

<body>
    <?php include($dev_root . '/includes/header.php'); ?>
    <div class="whopper">
        <?php
        $section = 'top';
        include($dev_root . '/includes/kv.php');
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
                                <h3 class="TL">ウォーターサーバー<br class="sp">総合窓口安心サポート</h3>
                            </div>
                        </div>
                        <div class="front__support--text">
                            <p class="TX">
                                この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。
                            </p>
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
                                                    <p class="TX">家電保険</p>
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
                                                        家電保険(動産総合保険)には付帯サービスとして、<wbr>
                                                        家電の修理費用の特典が付いています！
                                                    </p>
                                                    <small>
                                                        ※動産総合保険は、家電安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <a href="<?php echo $dev; ?>" target="_blank" rel="noopener noreferrer">
                                                        【保険サービス利用規約】スマホ安心サポート
                                                    </a>
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
                                                    <p class="TX">スマホ保険</p>
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
                                                        スマホ保険(通信端末修理費用保険)付帯サービスとして、<wbr>
                                                        スマホの修理費用を補填いたします！
                                                    </p>
                                                    <small>
                                                        ※通信端末修理費用保険は、スマホ安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <a href="<?php echo $dev; ?>" target="_blank" rel="noopener noreferrer">
                                                        【保険サービス利用規約】スマホ安心サポート
                                                    </a>
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
                                                    <p class="TX">家電保険</p>
                                                </li>
                                                <li>
                                                    <p class="TX">スマホ保険</p>
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
                                                                トイレが詰まった／水が出ない、止まらないなど
                                                            </p>
                                                        </li>
                                                        <li class="inner--list">
                                                            <h5 class="TL">
                                                                ガラスのトラブル
                                                            </h5>
                                                            <p class="TX">
                                                                強風でガラスが割れたノガラスにヒビが入っているなど
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
                                                        スマホ保険(通信端末修理費用保険)付帯サービスとして、<wbr>
                                                        スマホの修理費用を補填いたします！
                                                    </p>
                                                    <small>
                                                        ※通信端末修理費用保険は、スマホ安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <a href="<?php echo $dev; ?>" target="_blank" rel="noopener noreferrer">
                                                        プレミアム安心保証パック 家電住設
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="list--inner">
                                                <div class="C_bookmark"></div>
                                                <div class="inner--text">
                                                    <p class="TX">
                                                        家電保険(動産総合保険)には付帯サービスとして、<wbr>
                                                        家電の修理費用の特典が付いています！
                                                    </p>
                                                    <small>
                                                        ※動産総合保険は、家電安心サポートのお申し込み日の属する月の翌々1日からご利用いただけます。
                                                    </small>
                                                    <a href="<?php echo $dev; ?>" target="_blank" rel="noopener noreferrer">
                                                        プレミアム安心保証パック 通信端末
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
                                                <p class="TX"><span>月額&nbsp;</span>550円</p>
                                            </div>
                                        </li>

                                    </ul>
                                    <div class="single--img">
                                        <div class="img"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        <?php include($dev_root . '/includes/footer.php'); ?>
    </div>
    <?php include($dev_root . '/includes/jq.php'); ?>
</body>

</html>