<?php
/*
Template Name: contact
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自ページ --start -->
<div class="page-contact">
  <section class="contact_kv">
    <h2 class="TL">
      <img src="<?php echo get_template_directory_uri(); ?>/img/contact/contact_kv-ttl.svg" alt="お問い合わせ CONTACT">
    </h2>
  </section>

  <section class="contact_contents">

    <div class="contact_contents--form">
      <div class="form--inner">
        <div class="top--txt">
          <p class="TX">
            ホームページ（お問い合わせフォーム）からのお問い合わせは、回答までにお時間がかかる場合があります。お急ぎの場合はお電話にてお問い合わせください。<br>
            在学生、卒業生、教員、職員の個人情報に関するお問い合わせには応じられません。<br>
            発信元や事由が明確でないお問い合わせに関しましては、お応えしかねる場合があります。<br>
            在学生の方のお問い合わせは窓口受付でお願いします。<br>
          </p>
        </div>
        
        <?php echo do_shortcode('[contact-form-7 id="3a15c6e" title="contact"]'); ?>
        
<!-- <ul class="form--list">
<li>
<div class="ttl">
<label for="job">ご質問内容</label>
</div>
<div class="txt">
<div class="input--area select--area">
<select name="job" id="job">
<option value="">___</option>
<option value="">選択肢01</option>
<option value="">選択肢02</option>
<option value="">選択肢03</option>
<option value="">選択肢04</option>
<option value="">選択肢05</option>
</select>
</div>
</div>
</li>
<li>
<div class="ttl">
<label for="name">お名前</label>
</div>
<div class="txt">
<div class="input--area">
<input type="text" name="name" id="name">
</div>
</div>
</li>
<li>
<div class="ttl">
<label for="kaana">ふりがな</label>
</div>
<div class="txt">
<div class="input--area">
<input type="text" name="kaana" id="kaana">
</div>
</div>
</li>
<li>
<div class="ttl">
<label for="email">メールアドレス</label>
</div>
<div class="txt">
<div class="input--area">
<input type="text" name="email" id="email">
</div>
</div>
</li>
<li>
<div class="ttl">
<label for="textarea">お問い合わせ</label>
</div>
<div class="txt">
<div class="input--area">
<textarea name="textarea" id="textarea"></textarea>
</div>
</div>
</li>
</ul>
<div class="btn">
<input class="hover-opa" type="submit" value="送信">
<div class="icon"></div>
</div> -->



      </div>
    </div>

    <div class="contact_contents--item">
      <div class="txt">
        <p class="TX">お電話・メールはこちら</p>
      </div>
      <div class="links">
        <a class="hover-opa" href="tel:0798-67-2100">
          <div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/img/icon/tel-icon.svg"></div>
          <p class="TX TX-num">0798-67-2100</p>
        </a>
        <a class="hover-opa" href="mailto:a-shomuk@koshien.ac.jp">
          <div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/img/icon/mail-icon.svg"></div>
          <p class="TX">a-shomuk@koshien.ac.jp</p>
        </a>
      </div>
    </div>
  </section>

</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>