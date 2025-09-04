<?php

// // テーマファイルの読み込みタイミングを調整
// function load_theme_functions()
// {
//   // 分割したファイルパスを配列に追加
//   $function_dirs = [
//     __DIR__ . '/function/common',
//     __DIR__ . '/function/cooperator',
//     __DIR__ . '/function/cooperator-2',
//     __DIR__ . '/function/cooperator-3',
//   ];

//   foreach ($function_dirs as $dir) {
//     if (is_dir($dir)) {
//       foreach (glob($dir . '/*.php') as $file) {
//         require_once $file;
//       }
//     }
//   }
// }
// // initアクション以降にテーマファイルを読み込む
// add_action('init', 'load_theme_functions', 1);


// // 分割したファイルパスを配列に追加
$function_dirs = [
  __DIR__ . '/function/common',
  __DIR__ . '/function/cooperator',
  __DIR__ . '/function/cooperator-2',
  __DIR__ . '/function/cooperator-3',
];

foreach ($function_dirs as $dir) {
  if (is_dir($dir)) {
    foreach (glob($dir . '/*.php') as $file) {
      require_once $file;
    }
  }
}


// 1) common は after_setup_theme（init より前）で読み込む
// add_action('after_setup_theme', function () {
//   $dir = __DIR__ . '/function/common';
//   if (is_dir($dir)) {
//     foreach (glob($dir . '/*.php') as $file) {
//       require_once $file;
//     }
//   }
// }, 0); // 優先度0で最速

// // 2) それ以外は init で読み込む
// add_action('init', function () {
//   $function_dirs = [
//     __DIR__ . '/function/cooperator',
//     __DIR__ . '/function/cooperator-2',
//     __DIR__ . '/function/cooperator-3',
//   ];
//   foreach ($function_dirs as $dir) {
//     if (is_dir($dir)) {
//       foreach (glob($dir . '/*.php') as $file) {
//         require_once $file;
//       }
//     }
//   }
// }, 1); // 早めに読みたいなら 0〜1 に


