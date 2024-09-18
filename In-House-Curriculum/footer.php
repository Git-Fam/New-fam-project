<?php wp_footer() ?>

  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <?php if (is_home()) : ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js"></script>
    <script type="module" src="<?php echo get_template_directory_uri(); ?>/js/cooperator-p-script.js"></script>
  <?php else : ?>
  <?php endif; ?>

  <script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/cooperatorScript.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/colorPicker.js"></script>
  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

</body>
</html>