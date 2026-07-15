<?php
/*
Template Name: 学校案内
Template Post Type: page
Template Path: pages/
*/

// /about/ にアクセスされたら /about/facility/ へリダイレクト
wp_redirect(home_url('/about/facility/'), 301);
exit;
?>

