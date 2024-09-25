<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
  <?php
  // 開発用
  // $dev = '';
  $dev = '/pequod_terms';

  $root = $_SERVER['DOCUMENT_ROOT'];
  $dev_root = $root . $dev;

  $title = ' | ';
  $description = '';
  $url = '';
  include($dev_root . '/includes/head.php');
  ?>
</head>

<body>

  <?php include($dev_root . '/includes/jq.php'); ?>
</body>

</html>