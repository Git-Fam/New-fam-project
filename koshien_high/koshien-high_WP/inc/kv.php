<!-- front -->
<?php if (is_front_page()): ?>
  <!-- front-page.php 側でヒーローを実装しているためkvは出力しない -->

<?php else: ?>

  <!-- ===== 学校案内（共通） ===== -->
  <?php if (is_page('about')): ?>
    <div class="kv kv--about">KV-about</div>
  <?php elseif (is_page('about/concept')): ?>
    <div class="kv kv--concept">KV-concept</div>
  <?php elseif (is_page('about/history')): ?>
    <div class="kv kv--history">KV-history</div>
  <?php elseif (is_page('about/facility')): ?>
    <div class="kv kv--facility">KV-facility</div>
  <?php elseif (is_page('about/uniform')): ?>
    <div class="kv kv--uniform">KV-uniform</div>

  <!-- ===== 中学校 ===== -->
  <?php elseif (is_page('junior')): ?>
    <div class="kv kv--junior">KV-junior</div>
  <?php elseif (is_page('junior/declaration')): ?>
    <div class="kv kv--junior-declaration">KV-junior-declaration</div>
  <?php elseif (is_page('junior/students')): ?>
    <div class="kv kv--junior-students">KV-junior-students</div>
  <?php elseif (is_page('junior/admission')): ?>
    <div class="kv kv--junior-admission">KV-junior-admission</div>
  <?php elseif (is_page('junior/life')): ?>
    <div class="kv kv--junior-life">KV-junior-life</div>
  <?php elseif (is_page('junior/club')): ?>
    <div class="kv kv--junior-club">KV-junior-club</div>
  <?php elseif (is_page('junior/feature')): ?>
    <div class="kv kv--junior-feature">KV-junior-feature</div>
  <?php elseif (is_page('junior/openschool')): ?>
    <div class="kv kv--junior-openschool">KV-junior-openschool</div>

  <!-- ===== 高等学校 ===== -->
  <?php elseif (is_page('high')): ?>
    <div class="kv kv--high">KV-high</div>
  <?php elseif (is_page('high/why')): ?>
    <div class="kv kv--high-why">KV-high-why</div>
  <?php elseif (is_page('high/course')): ?>
    <div class="kv kv--high-course">KV-high-course</div>
  <?php elseif (is_page('high/changed')): ?>
    <div class="kv kv--high-changed">KV-high-changed</div>
  <?php elseif (is_page('high/admission')): ?>
    <div class="kv kv--high-admission">KV-high-admission</div>
  <?php elseif (is_page('high/life')): ?>
    <div class="kv kv--high-life">KV-high-life</div>
  <?php elseif (is_page('high/club')): ?>
    <div class="kv kv--high-club">KV-high-club</div>
  <?php elseif (is_page('high/career')): ?>
    <div class="kv kv--high-career">KV-high-career</div>
  <?php elseif (is_page('high/feature')): ?>
    <div class="kv kv--high-feature">KV-high-feature</div>
  <?php elseif (is_page('high/openschool')): ?>
    <div class="kv kv--high-openschool">KV-high-openschool</div>

  <!-- ===== その他（共通） ===== -->
  <?php elseif (is_page('recruit')): ?>
    <div class="kv kv--recruit">KV-recruit</div>
  <?php elseif (is_page('alumni')): ?>
    <div class="kv kv--alumni">KV-alumni</div>
  <?php elseif (is_page('request')): ?>
    <div class="kv kv--request">KV-request</div>
  <?php elseif (is_page('contact')): ?>
    <div class="kv kv--contact">KV-contact</div>

  <!-- ===== お知らせ（標準投稿） ===== -->
  <?php elseif (is_post_type_archive('post') || is_home()): ?>
    <div class="kv kv--news">KV-news</div>
  <?php elseif (is_singular('post')): ?>
    <div class="kv kv--news-single">KV-news-single</div>
  <?php endif; ?>

<?php endif; ?>
