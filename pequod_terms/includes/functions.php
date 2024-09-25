<?php
function getDevPath() {
  // ポート 8888 の場合
  if ($_SERVER['SERVER_PORT'] == '8888') {
    return '/pequod_terms';
  }
  // それ以外の場合
  return '';
}