<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <?php
    // 開発用
    $dev = '/pequod_terms';

    $root = $_SERVER['DOCUMENT_ROOT'];
    $dev_root = $root . $dev;

    $title = '会社概要';
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
        $section = 'company';
        include($dev_root . '/includes/kv.php');
        ?>

        <main>
            <div class="wrap">
            <?php echo $title; ?><br>
                <?php echo $root; ?><br>
                <?php echo $dev_root; ?><br>
                <?php
                $section_title = 'いいいいaaaaい';
                include($dev_root . '/assets/section-title.php');
                ?>
            </div>
        </main>

        <?php include($dev_root . '/includes/footer.php'); ?>
    </div>
    <?php include($dev_root . '/includes/jq.php'); ?>
</body>

</html>