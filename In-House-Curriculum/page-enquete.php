<?php
if (!is_user_logged_in()) {
  wp_redirect(home_url('/login'));
  exit;
}
get_header();
?>


<div class="control">
  <div class="control--wap">
    <div class="control--paper">
  
    <!-- バインダー金具    -->
    <div class="binder-clip"></div> 
      <div class="control--wap--item">

        <!-- フォーム  -->
        <iframe 
          class="responsive-form"
          src="https://docs.google.com/forms/d/e/1FAIpQLSe0s6KMKB9v3z4HWLCya0Bkcm3TSc2Jit4pmGqor0Yeq3stmA/viewform?embedded=true" 
          frameborder="0" 
          marginheight="0" 
          marginwidth="0">
          読み込んでいます…
        </iframe>

      </div>
    </div>
  </div>
</div>


<!-- 背景アニメーション用  -->


<ul class="circles">
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
  <li></li>
</ul>



