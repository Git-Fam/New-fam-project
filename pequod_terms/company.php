<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <?php
    // 開発用
    // $dev = '';
    $dev = '/pequod_terms';

    $root = $_SERVER['DOCUMENT_ROOT'];
    $dev_root = $root . $dev;

    $title = '会社概要';
    $description = 'ディスクリプション';
    $url = '';
    include($dev_root . '/includes/head.php');
    ?>
</head>

<body>
    <?php include($dev_root . '/includes/header.php'); ?>
    <div class="whopper">
        <?php
        $section = 'company';
        include($dev_root . '/includes/kv.php');
        ?>

        <main>
            <div class="wrap">
                <div class="company">
                    <section class="company__overview wrap-sp" id="overview">
                        <div class="C_overview">
                            <div class="C_underLine">
                                <h3 class="TL">事業概要</h3>
                            </div>
                            <div class="C_overview__list">
                                <ul>
                                    <li>
                                        <div class="title">
                                            <p class="TL">社名</p>
                                        </div>
                                        <div class="content">
                                            <p class="TX">株式会社pequod</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <p class="TL">代表者</p>
                                        </div>
                                        <div class="content">
                                            <p class="TX">石原 壮大</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <p class="TL">設立日</p>
                                        </div>
                                        <div class="content">
                                            <p class="TX">2015年9月30日</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <p class="TL">住所</p>
                                        </div>
                                        <div class="content">
                                            <p class="TX">東京都渋谷区神泉町20番地15号 神泉モンドビル2F</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <p class="TL">電話番号</p>
                                        </div>
                                        <div class="content">
                                            <p class="TX">03-6821-1282</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <p class="TL">事業内容</p>
                                        </div>
                                        <div class="content">
                                            <p class="TX">ウォーターサーバー事業/アライアンス事業/セールスプロモーション事業</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <section class="company__access wrap-sp" id="access">
                        <div class="C_overview">
                            <div class="C_underLine">
                                <h3 class="TL">アクセス</h3>
                            </div>
                            <div class="C_overview__map">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3241.849896766165!2d139.68934547644744!3d35.65606967259531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188b5559a9a94f%3A0xd2c8867888ffe150!2z44CSMTUwLTAwNDUg5p2x5Lqs6YO95riL6LC35Yy656We5rOJ55S677yS77yQ4oiS77yR77yVIOelnuazieODouODs-ODieODk-ODqyAyZg!5e0!3m2!1sja!2sjp!4v1727155905473!5m2!1sja!2sjp"
                                    style="border:0;" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
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