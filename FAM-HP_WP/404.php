<?php get_template_part('global-parts/header'); ?>

<main class="not-found">
  <div class="not-found__inner">
    <p class="not-found__num">404</p>
    <h1 class="not-found__title">Page Not Found</h1>
    <p class="not-found__text">
      お探しのページは見つかりませんでした。<br>
      URLが間違っているか、ページが削除された可能性があります。
    </p>
    <a href="<?php echo get_home_url(); ?>" class="not-found__btn">TOPへ戻る</a>
  </div>
</main>


<?php get_template_part('global-parts/footer'); ?>