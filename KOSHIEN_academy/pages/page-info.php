<?php
/*
Template Name: info
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->
<div class="page-info">
  <section class="info_kv">
    <div class="inner--content">
      <h2 class="TL">
        <picture>
          <img src="<?php echo get_template_directory_uri(); ?>/img/info/info_kv-ttl.svg" alt="公開情報">
        </picture>
      </h2>
      <ul class="info--list">
        <!-- Smart Custom Fields(SCF)で繰り返し(pdf_ttl,pdf_file,pdf_check,another_url) -->
        <?php
        $free_item = SCF::get('info_item');
        $has_data = false;
        if (!empty($free_item) && is_array($free_item)) {
          foreach ($free_item as $fields) {

            if (!empty($fields['pdf_check'])) {
              $item_url = '';
              $is_related_post = false;
              $pdf_file = $fields['pdf_file'] ?? '';
              if (is_array($pdf_file)) {
                $pdf_file = reset($pdf_file) ?: '';
              }

              if (!empty($pdf_file)) {
                if (is_numeric($pdf_file)) {
                  $item_url = wp_get_attachment_url((int) $pdf_file);
                } elseif (is_string($pdf_file)) {
                  $item_url = $pdf_file;
                }
              }

              if (empty($item_url) && !empty($fields['another_url'])) {
                $another_url = $fields['another_url'];
                if (is_array($another_url)) {
                  $another_url = reset($another_url) ?: '';
                }
                if (is_numeric($another_url)) {
                  $item_url = get_permalink((int) $another_url);
                  $is_related_post = true;
                } elseif (is_string($another_url)) {
                  $item_url = $another_url;
                  $is_related_post = true;
                }
              }

              if (!empty($item_url)) {
                $has_data = true;
                $link_class = $is_related_post ? 'hover-opa is-related-post' : 'hover-opa';
        ?>
              <li>
                <a class="<?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($item_url); ?>" target="_blank" rel="noopener noreferrer">
                  <p class="TX"><?php echo $fields['pdf_ttl']; ?></p>
                </a>
              </li>
          <?php
              }
            }
          }
        }
        if (!$has_data) {
          ?>
          <p class="TX" style="text-align: center; color: #FFF;">公開中のPDFはありません。</p>
        <?php
        }
        ?>
      </ul>
    </div>
  </section>


</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>