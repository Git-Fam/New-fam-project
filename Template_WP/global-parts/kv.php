<!-- front -->
<?php if (is_front_page()) : ?>
  <div>KV-frontKV-frontKV-frontKV-front</div>
<?php else : ?>

  <!-- voi -->
  <?php if (is_page('voi')) : ?>
    <div>KV-voiKV-voiKV-voiKV-voi</div>
  <?php endif; ?>

<?php endif; ?>
