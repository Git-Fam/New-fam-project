<!-- front -->
<?php if (is_front_page()) : ?>
  <div class="KV KV_front"></div>
<?php else : ?>

  <!-- about-us -->
  <?php if (is_page('about-us')) : ?>
    <div class="KV KV_about-us"></div>
  <?php endif; ?>

  <!-- business -->
  <?php if (is_page('business')) : ?>
    <div class="KV KV_business"></div>
  <?php endif; ?>

  <!-- example -->
  <?php if (is_post_type_archive('post')) : ?>
    <div class="KV KV_example"></div>
  <?php endif; ?>

  <!-- recruit -->
  <?php if (is_page('recruit')) : ?>
    <div class="KV KV_recruit"></div>
  <?php endif; ?>

  <!-- contact -->
  <?php if (is_page('contact') || is_page('contact-complete') || is_page('contact-confirm')) : ?>
    <div class="KV KV_contact"></div>
  <?php endif; ?>

<?php endif; ?>