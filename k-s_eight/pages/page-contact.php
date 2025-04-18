<?php
 
 /*
 Template Name: contact
 Template Post Type: page
 Template Path: pages/
*/


?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- <div class="bbb">contact</div> -->
<!-- mainよりも中の部分だけを入れ込む -->
   <div class="contact-form-wrapper">
          <p class="contact-text">
            ご質問やご相談がありましたら、下のフォームからお気軽にお問い合わせください。<br />
            数日中に担当者よりご連絡いたします。
          </p>

          <!-- <form class="contact-form" action="/submit" method="POST">
            <div class="form-group">
              <label for="name"
                >お名前 <span class="required">必須</span></label
              >
              <input
                type="text"
                id="name"
                name="name"
                placeholder="田中 太郎"
                required
              />
            </div>

            <div class="form-group">
              <label for="furigana"
                >フリガナ <span class="required">必須</span></label
              >
              <input
                type="text"
                id="furigana"
                name="furigana"
                placeholder="タナカ タロウ"
                required
              />
            </div>

            <div class="form-group">
              <label for="email"
                >メールアドレス <span class="required">必須</span></label
              >
              <input
                type="email"
                id="email"
                name="email"
                placeholder="info@example.com"
                required
              />
            </div>

            <div class="form-group">
              <label for="phone"
                >連絡可能電話番号 <span class="required">必須</span></label
              >
              <input
                type="tel"
                id="phone"
                name="phone"
                placeholder="000-0000-0000"
                required
              />
            </div>

            <div class="form-group">
              <label for="zip1">住所 </label>
              <div class="post-z">
                <div class="zip-wrapper">
                  <span class="post">〒</span>
                  <input
                    type="text"
                    id="zip1"
                    name="zip1"
                    maxlength="3"
                    placeholder="000"
                    required
                    class="post-input"
                  />
                  <span class="dash">-</span>
                  <input
                    type="text"
                    id="zip2"
                    name="zip2"
                    maxlength="4"
                    placeholder="0000"
                    required
                    class="post-input"
                  />
                </div>

                <input
                  type="text"
                  id="address"
                  name="address"
                  class="address-input"
                  placeholder="〇〇県××市△△丁目0-0"
                  required
                />
              </div>
            </div>

            <div class="form-group">
              <label for="message"
                >お問い合わせ内容 <span class="required">必須</span></label
              >
              <textarea
                id="message"
                name="message"
                placeholder="お問い合わせ内容を入力してください"
                rows="5"
                required
              ></textarea>
            </div>
            <div class="policy-wrapper">
              <div class="policy-text">
                <p>プライバシーポリシー</p>
              </div>
              <div class="element">
                株式会社ケイズエイトでは、お客様のプライバシーを尊重しお客様の個人情報を大切に保護することを重要な責務と考え、個人情報保護に関する法令を遵守するとともに、個人情報の取扱いに関して以下の事項を定めています。<br />1.個人情報の利用目的<br />お客様からご提供いただいた個人情報の利用目的は以下のとおりです。<br />お客様との契約に関する事項の確認ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミーミーダミーダミーダミーダミーダミー
              </div>
            </div>
            <div class="form-policy checkbox">
              <input type="checkbox" id="policy" name="policy" required />
              <label for="policy">プライバシーポリシーに同意する</label>
            </div>

            <div class="form-sub">
              <button type="submit" class="btn-submit">確認</button>
            </div>
          </form> -->
         <?php echo do_shortcode('[contact-form-7 id="7213716" title="Contact"]'); ?>

        </div>
        
<?php get_template_part('./inc/footer'); ?>