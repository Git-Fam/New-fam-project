<?php
/*
Template Name: 入試情報（高校）
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high-admission page--high-all">

  <section class="high-admission-kv">
    <div class="high-admission-kv-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-kv-bg-sp.webp" media="(max-width:767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-kv-bg-pc.webp" alt="">
      </picture>
    </div>
    <div class="high-admission-kv-ttl">
      <h2 class="TL js-fade">
        </picture>
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-kv-ttl.svg" alt="入試情報">
      </h2>
    </div>
  </section>

  <aside class="high-admission-aside">
    <div class="high-admission-aside-inner">
      <div class="aside-ttl pc">ADMISSION</div>
      <nav class="aside-nav">
        <ul class="aside-nav-list">
          <li class="aside-nav-list-item">
            <a href="#" class="aside-nav-list-item-link hover-opa">入試情報トップ</a>
          </li>
          <li class="aside-nav-list-item">
            <a href="#" class="aside-nav-list-item-link hover-opa">生徒募集要項</a>
          </li>
          <li class="aside-nav-list-item">
            <a href="#" class="aside-nav-list-item-link hover-opa">奨学金制度</a>
            <ul class="aside-nav-list-sub pc">
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">学力特待生制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">運動部/文化部奨学金制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">大阪府等他府県入学者<br>奨学金制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">ファミリー奨学金制度</a>
              </li>
            </ul>
          </li>
          <li class="aside-nav-list-item">
            <a href="#" class="aside-nav-list-item-link hover-opa">受験生のみなさまへ</a>
            <ul class="aside-nav-list-sub pc">
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">WEB出願</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">合否照会</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">入学手続き</a>
              </li>
            </ul>
          </li>
          <li class="aside-nav-list-item">
            <a href="#" class="aside-nav-list-item-link hover-opa">Q&A</a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>



</main>


<?php get_template_part('./inc/footer'); ?>