<?php
$default_cat_id = get_option('default_category'); // 未分類を除外するため
$categories     = get_categories(array(
  'orderby'    => 'name',
  'order'      => 'ASC',
  'exclude'    => array((int) $default_cat_id),
  'hide_empty' => true,
));

$all_url = get_permalink(get_option('page_for_posts'));
if (! $all_url) {
  $all_url = home_url('/');
}
?>
<aside class="category_area s-pop">
  <h4 class="TL">
    <img src="<?php echo get_template_directory_uri(); ?>/img/news/category_ttl.svg" alt="CATEGORY / カテゴリー">
  </h4>
  <ul class="category_list">
    <li class="item">
      <a href="<?php echo home_url('/news'); ?>">全て</a>
    </li>
    <?php foreach ($categories as $cat) : ?>
      <li class="item">
        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</aside>