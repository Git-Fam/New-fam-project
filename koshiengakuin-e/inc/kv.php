<!-- front -->
<?php if (is_front_page()): ?>
  <div class="p-front-kv">
    <p class="p-front-kv__catch">
      <span class="js-scroll-target a-fadeInUp" style="display: block;">
        わたしたちが育てたいのは、心です。<br>
        甲子園学院小学校は、<br class="pc-none">先生と児童、上級生と下級生、<br>
        一人ひとりの距離が近いことで、<br class="pc-none">心と心がつながる場所です。<br>
        そして人にやさしく、協力できる人、<br>
        人を思いやり、<br class="pc-none">感謝できる人に育っていきます。
      </span>
    </p>

    <div class="p-front-kv__image js-load-target a-fadeInUp">
      <picture>
        <source media="(max-width: 828px)" srcset="<?php echo get_template_directory_uri(); ?>/img/kv_sp.webp">
        <img class="u-w100" src="<?php echo get_template_directory_uri(); ?>/img/kv.webp" alt="心と心がつながる小学校">
      </picture>
    </div>
  </div>
<?php else: ?>

  <!-- voi -->
  <?php if (is_page('voi')): ?>
    <div>KV-voi</div>
  <?php endif; ?>

  <!-- ggg -->
  <?php if (is_page('ggg')): ?>
    <div>KV-ggg</div>
  <?php endif; ?>

  <!-- archive -->
  <?php if (is_post_type_archive('post')): ?>
    <!-- <div>KV-news</div> -->
  <?php endif; ?>

  <!-- single -->
  <?php if (is_singular('post')): ?>
    <!-- <div>KV-single-news</div> -->
  <?php endif; ?>

  <!-- archive-blog -->
  <?php if (is_post_type_archive('blog')): ?>
    <div>KV-blog</div>
  <?php endif; ?>

  <!-- single-blog -->
  <?php if (is_singular('blog')): ?>
    <div>KV-single-blog</div>
  <?php endif; ?>

  <!-- archive-column -->
  <?php if (is_post_type_archive('column')): ?>
    <div>KV-column</div>
  <?php endif; ?>

  <!-- single-column -->
  <?php if (is_singular('column')): ?>
    <div>KV-single-column</div>
  <?php endif; ?>

<?php endif; ?>