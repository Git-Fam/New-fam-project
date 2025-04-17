<?php


// 分割したファイルパスを配列に追加
$function_dirs = [
  __DIR__ . '/function/common',
];

foreach ($function_dirs as $dir) {
  if (is_dir($dir)) {
    foreach (glob($dir . '/*.php') as $file) {
      require_once $file;
    }
  }
}



?>