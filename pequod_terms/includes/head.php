<?php
$mainTitle = '株式会社pequod';
$description = '';
$mainUrl = 'https://usm.shop.pequod.jp';
?>

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="format-detection" content="email=no,telephone=no,address=no" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta property="og:locale" content="ja_JP" />

<title><?php echo $mainTitle; ?><?php echo $title; ?></title>
<meta name="title" content="<?php echo $mainTitle; ?><?php echo $title; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $mainUrl; ?><?php echo $url; ?>" />
<meta property="og:title" content="<?php echo $mainTitle; ?><?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:image" content="<?php echo $mainUrl; ?>/img/meta.png" />
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="<?php echo $mainUrl; ?><?php echo $url; ?>" />
<meta property="twitter:title" content="<?php echo $mainTitle; ?><?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $description; ?>" />
<meta property="twitter:image" content="<?php echo $mainUrl; ?>/img/meta.png" />

<link rel="stylesheet" href="css/main.css?ver=<?php echo filemtime('css/main.css'); ?>" />
<link rel="stylesheet" href="../css/main.css?ver=<?php echo filemtime('../css/main.css'); ?>" />