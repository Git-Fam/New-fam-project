<?php
 
 /*
 Template Name: contact-confirm
 Template Post Type: page
 Template Path: pages/
*/


?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- <div class="bbb">contact-confirm</div> -->
<!-- mainよりも中の部分だけを入れ込む -->
 <div class="contact-form-wrapper">
          <p class="contact-text">
            ご入力いただいた内容に間違いがないか、<br class="sp" />
            確認をお願いいたします。
          </p>

          <form class="contact-form" action="/submit" method="POST">
            <div class="form-group">
              <label>お名前</label>
              <p class="confirm-value pd-t">田中 太郎</p>
              <input type="hidden" name="name" value="田中 太郎" />
            </div>

            <div class="form-group">
              <label>フリガナ</label>
              <p class="confirm-value pd-t">タナカ タロウ</p>
              <input type="hidden" name="furigana" value="タナカ タロウ" />
            </div>

            <div class="form-group">
              <label>メールアドレス</label>
              <p class="confirm-value pd-t">info@example.com</p>
              <input type="hidden" name="email" value="info@example.com" />
            </div>

            <div class="form-group">
              <label>連絡可能電話番号</label>
              <p class="confirm-value pd-t">000-0000-0000</p>
              <input type="hidden" name="phone" value="000-0000-0000" />
            </div>

            <div class="form-group">
              <label>住所</label>
              <div class="post-z">
                <div class="zip-wrapper">
                  <span class="post">〒</span>
                  <p class="confirm-text">000-0000</p>
                  <input type="hidden" name="zip1" value="000" />
                  <input type="hidden" name="zip2" value="0000" />
                </div>

                <p class="confirm-text">〇〇県××市△△丁目0-0</p>
                <input
                  type="hidden"
                  name="address"
                  value="〇〇県××市△△丁目0-0"
                />
              </div>
            </div>

            <div class="form-group">
              <label>お問い合わせ内容</label>
              <p class="confirm-value pd-t">
                お問い合わせ内容がここに表示されます。
              </p>
              <input
                type="hidden"
                name="message"
                value="お問い合わせ内容がここに表示されます。"
              />
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
              <input
                type="checkbox"
                id="policy"
                name="policy"
                checked
                disabled
              />
              <label for="policy">プライバシーポリシーに同意しました</label>
            </div>

            <div class="form-sub">
              <button type="button" class="btn-back" onclick="history.back()">
                戻る
              </button>
              <button type="submit" class="btn-submit">送信する</button>
            </div>
          </form>
        </div>

<?php get_template_part('./inc/footer'); ?>