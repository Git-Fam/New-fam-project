<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
  <?php
  include('./includes/functions.php');

  $dev = getDevPath();

  $root = $_SERVER['DOCUMENT_ROOT'];
  $dev_root = $root . $dev;

  $title = ' | ';
  $description = '';
  $url = '/insurance-terms03.php';
  include($dev_root . '/includes/head.php');
  ?>
</head>

<body>

  <div class="whopper">
    <main>
      <div class="wrap wrap-sp">
        insurance-terms03
      </div>
    </main>
  </div>

  <?php include($dev_root . '/includes/jq.php'); ?>
</body>

</html>