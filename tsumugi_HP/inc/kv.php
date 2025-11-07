<!-- front -->
<?php if (is_front_page()): ?>
  <div>KV-frontKV</div>
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
    <div>KV-news</div>
  <?php endif; ?>

  <!-- single -->
  <?php if (is_singular('post')): ?>
    <div>KV-single-news</div>
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
