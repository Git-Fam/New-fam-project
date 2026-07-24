<?php
/*
Template Name: お問い合わせ
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="page-contact">
  <section class="C_kv">
    <div class="C_kv-board">
      <h2 class="TL">お問い合わせ</h2>
    </div>
    <div class="C_kv-char">
      <div class="char-10">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-10.webp" alt="">
      </div>
      <div class="char-11 fuwafuwa duration-11 delay-03">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-11.webp" alt="">
      </div>
    </div>
  </section>
  <section class="contact-contents">
    <div class="contents-txt">
      <p class="TX">
        当院にご興味を持っていただきありがとうございます。ご質問のある方は下記フォームよりお問い合わせください。<br>
        「*」部分は必須入力となっております。
      </p>
    </div>
    <div class="contents-main">

      <?php echo do_shortcode('[contact-form-7 id="4a38243" title="お問い合わせ"]'); ?>
<!-- 
<div class="item-wrap">
<div class="item">
<div class="ttl">
<label class="TL">*お問い合わせ内容</label>
</div>
<div class="radio">
[radio radio-767 class:radio-inr use_label_element "採用エントリー" "その他お問い合わせ"]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="name">*お名前</label>
</div>
<div class="input">
[text* text-name autocomplete:name id:name]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="furigana">*フリガナ</label>
</div>
<div class="input">
[text* text-furigana id:furigana]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="email">*メールアドレス</label>
</div>
<div class="input">
[email* text-email autocomplete:email id:email]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="tel">電話番号</label>
</div>
<div class="input">
[tel* text-tel autocomplete:tel id:tel]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="zip">*郵便番号</label>
</div>
<div class="input">
[text* text-zip id:zip]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="address">*住所</label>
</div>
<div class="input">
[text* text-address id:address]
</div>
</div>
<div class="item">
<div class="ttl">
<label class="TL" for="message">お問い合わせ詳細</label>
</div>
<div class="input">
[textarea textarea id:message]
</div>
</div>

</div>
<div class="policy-wrap">
[acceptance acceptance-678]<a href="/privacy-policy">プライバシーポリシー</a>に同意する[/acceptance]

</div>
<div class="submit-wrap">
<button type="submit">送信</button>
</div> -->

      <!-- <form action="">
        <div class="item-wrap">
          <div class="item">
            <div class="ttl">
              <label class="TL">*お問い合わせ内容</label>
            </div>
            <div class="radio">
              <label for="entry">
                <input type="radio" name="contact" id="entry">
                採用エントリー
              </label>
              <label for="other">
                <input type="radio" name="contact" id="other">
                その他お問い合わせ
              </label>
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="name">*お名前</label>
            </div>
            <div class="input">
              <input type="text" name="name" id="name">
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="furigana">*フリガナ</label>
            </div>
            <div class="input">
              <input type="text" name="furigana" id="furigana">
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="email">*メールアドレス</label>
            </div>
            <div class="input">
              <input type="email" name="email" id="email">
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="tel">電話番号</label>
            </div>
            <div class="input">
              <input type="tel" name="tel" id="tel">
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="zip">*郵便番号</label>
            </div>
            <div class="input">
              <input type="text" name="zip" id="zip">
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="address">*住所</label>
            </div>
            <div class="input">
              <input type="text" name="address" id="address">
            </div>
          </div>
          <div class="item">
            <div class="ttl">
              <label class="TL" for="message">お問い合わせ詳細</label>
            </div>
            <div class="input">
              <textarea name="message" id="message"></textarea>
            </div>
          </div>

        </div>
        <div class="policy-wrap">
          <input type="checkbox" name="policy" id="policy">
          <label for="policy">
            <a href="#">プライバシーポリシー</a>に同意する
          </label>
        </div>
        <div class="submit-wrap">
          <button type="submit">送信</button>
        </div>
      </form> -->

    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>