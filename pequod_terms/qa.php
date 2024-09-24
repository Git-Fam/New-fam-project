<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <?php
    // 開発用
    // $dev = '';
    $dev = '/pequod_terms';

    $root = $_SERVER['DOCUMENT_ROOT'];
    $dev_root = $root . $dev;

    $title = 'Q&A';
    $description = 'ディスクリプション';
    $url = '';
    $is_home = true; // トップページのみ記載
    include($dev_root . '/includes/head.php');
    ?>

    <!-- ▼フォント -->
</head>

<body>
    <?php include($dev_root . '/includes/header.php'); ?>
    <div class="whopper">
        <?php
        $section = 'qa';
        include($dev_root . '/includes/kv.php');
        ?>

        <main>
            <div class="wrap">
                <div class="qa wrap-sp">
                    <section class="qa__prevalent">
                        <div class="qa__prevalent--top">
                            <div class="C_Title">
                                <div class="C_Water_drop">
                                    <div class="icon"></div>
                                    <div class="icon"></div>
                                    <div class="icon"></div>
                                </div>
                                <div class="C_Title--title">
                                    <h3 class="TL">よくあるご質問</h3>
                                </div>
                            </div>
                            <div class="qa__prevalent--top--text">
                                <p class="TX">
                                    当社のサービスについて、お客様からよくいただくご質問とご回答をまとめております。
                                </p>
                            </div>
                        </div>
                        <div class="qa__prevalent--links">
                            <div class="C_linkIn">
                                <a href="#hozon" class="C_linkIn--item hover-opa" id="link-hozon">
                                    <p class="TX">HOZON</p>
                                </a>
                                <a href="#seiton" class="C_linkIn--item hover-opa" id="link-seiton">
                                    <p class="TX">SEITON</p>
                                </a>
                                <a href="#medical" class="C_linkIn--item hover-opa" id="link-medical">
                                    <p class="TX">メディカルレスキュー</p>
                                </a>
                                <a href="#life" class="C_linkIn--item hover-opa" id="link-life">
                                    <p class="TX">ライフレスキュー</p>
                                </a>
                            </div>
                        </div>
                        <div class="qa__prevalent--content">

                            <div class="content--item" id="hozon">
                                <div class="item--title">
                                    <h4 class="TL">HOZON</h4>
                                </div>
                                <div class="item--container">
                                    <!-- ここにQAのコンテンツ入れてく感じで！ -->
                                </div>
                            </div>

                            <div class="content--item" id="seiton">
                                <div class="item--title">
                                    <h4 class="TL">SEITON</h4>
                                </div>
                                <div class="item--container">
                                    <!-- ここにQAのコンテンツ入れてく感じで！ -->
                                </div>
                            </div>

                            <div class="content--item" id="medical">
                                <div class="item--title">
                                    <h4 class="TL">メディカルレスキュー</h4>
                                </div>
                                <div class="item--container">
                                    <!-- ここにQAのコンテンツ入れてく感じで！ -->
                                </div>
                            </div>

                            <div class="content--item" id="life">
                                <div class="item--title">
                                    <h4 class="TL">ライフレスキュー</h4>
                                </div>
                                <div class="item--container">
                                    <!-- ここにQAのコンテンツ入れてく感じで！ -->
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