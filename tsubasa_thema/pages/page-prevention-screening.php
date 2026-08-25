<?php
/*
Template Name: 予防・検診
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<div class="page-prevention-screening">
  <section class="C_kv">
    <div class="C_kv-board">
      <h2 class="TL TL-mini">予防接種・検診</h2>
    </div>
    <div class="C_kv-char">
      <div class="char-03">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-03.webp" alt="">
      </div>
    </div>
  </section>
  <section class="prevention-screening-contents">
    <div class="prevention-screening-contents-ttl">
      <div class="C_front-ttl">
        <div class="wing left-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
        <h2 class="TL">予防接種について</h2>
        <div class="wing right-wing">
          <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
        </div>
      </div>
    </div>
    <div class="prevention-screening-contents-txt">
      <p class="TX">
        当院では予防接種専用の診察室を設け、診療時間内であればいつでも接種が可能です。お子さま一人ひとりに合わせた接種スケジュールをご提案し、安心して予防接種を受けていただけます。Web予約時は接種歴の入力にご協力ください。入力が難しい場合は、お電話またはご来院にてご相談ください。予防接種に関するご質問もお気軽にどうぞ。
      </p>
    </div>
    <div class="prevention-screening-contents-items">
      <div class="item">
        <div class="C_contents_box">
          <div class="C_contents_box-ttl">
            <div class="C_contents_box-ttl-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_contents_box-ttl-bg.webp" alt="">
            </div>
            <h2 class="TL">
              予防接種の時期について
            </h2>
          </div>
          <div class="C_contents_box-txt">
            <p class="TX">
              日本小児科学会が推奨する予防接種スケジュールを掲載しています。
            </p>
          </div>
          <div class="C_contents_box-btn">
            <?php
            $schedule_pdf = SCF::get('schedule_pdf');
            $schedule_pdf_url = is_numeric($schedule_pdf) ? wp_get_attachment_url($schedule_pdf) : $schedule_pdf;
            if (!empty($schedule_pdf_url)):
            ?>
            <a class="C_btn C_btn-pd-50"
              href="<?php echo esc_url($schedule_pdf_url); ?>"
              target="_blank" rel="noopener noreferrer">
              <p class="TX">予防接種スケジュール</p>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="C_contents_box">
          <div class="C_contents_box-ttl">
            <div class="C_contents_box-ttl-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_contents_box-ttl-bg.webp" alt="">
            </div>
            <h2 class="TL">
              当日の持ち物
            </h2>
          </div>
          <div class="C_contents_box-list">
            <ul class="list">
              <li class="TX">マイナンバーカード</li>
              <li class="TX">母子手帳</li>
              <li class="TX">診察券</li>
              <li class="TX">子育て支援医療費<br>受給資格証</li>
              <li class="TX">受給資格証</li>
              <li class="TX">替えのオムツ</li>
              <li class="TX">予診票</li>
            </ul>
            <p class="TX-point">
              ※定期接種は忘れると接種できません
            </p>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="C_contents_box">
          <div class="C_contents_box-ttl">
            <div class="C_contents_box-ttl-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_contents_box-ttl-bg.webp" alt="">
            </div>
            <h2 class="TL">
              定期接種
            </h2>
          </div>
          <div class="C_contents_box-list">
            <ul class="list">
              <li class="TX">五種混合ワクチン</li>
              <li class="TX">肺炎球菌ワクチン</li>
              <li class="TX">B型肝炎ワクチン</li>
              <li class="TX">ロタウイルスワクチン</li>
              <li class="TX">BCGワクチン</li>
              <li class="TX">麻疹 • 風疹 (MR) ワクチン</li>
              <li class="TX">水疱 (水ぼうそう) ワクチン</li>
              <li class="TX">日本脳炎ワクチン</li>
              <li class="TX">二種混合ワクチン</li>
              <li class="TX">
                子宮頸がんワクチン<br>
                <span class="TX-s">(ヒトパピローマウイルスワクチン)</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="item">
        <div class="C_contents_box">
          <div class="C_contents_box-ttl">
            <div class="C_contents_box-ttl-bg">
              <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_contents_box-ttl-bg.webp" alt="">
            </div>
            <h2 class="TL">
              任意接種
            </h2>
          </div>
          <div class="C_contents_box-list">
            <ul class="list">
              <li class="TX">おたふくかぜワクチン</li>
              <li class="TX">インフルエンザワクチン</li>
              <li class="TX">
                三種混合ワクチン<br>
                <span class="TX-s">(ジフテリア、破傷風、百日咳)</span>
              </li>
              <li class="TX">不活化ポリオワクチン</li>
              <li class="TX">A型肝炎ワクチン</li>
              <li class="TX">狂犬病ワクチン</li>
              <li class="TX">髄膜炎菌ワクチン</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="C_under-point">
    <div class="C_under-point-char">
      <div class="char-02 fuwafuwa duration-11 delay-05">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_under-point-char-02.webp" alt="">
      </div>
    </div>
    <div class="C_front-ttl">
      <div class="wing left-wing">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
      </div>
      <h3 class="TL">検診について</h3>
      <div class="wing right-wing">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
      </div>
    </div>
    <div class="C_under-point-txt">
      <p class="TX">
        体重、身長、頭位を測って身体の発育をみます。言葉の遅れなどの精神発達や首すわりや独り立ちなどの運動発達をみます。できるだけエビデンスに基づきわかりやすく説明させていただきます。その他子育てでの困ったこと、わからないことは何でも気軽にご相談ください。
      </p>
    </div>
    <div class="C_under-point-contents">
      <!-- <div class="contents-item">
        <div class="contents-item-ttl">
          <h3 class="TL">乳幼児健診の際に<br>行う検査</h3>
        </div>
        <div class="contents-item-txt">
          <p class="TX">腎臓超音波検査</p>
          <p class="TX">弱視スクリーニング検査</p>
          <p class="TX">股関節超音波検査</p>
          <p class="TX">心臓超音波検査</p>
        </div>
      </div> -->
      <div class="contents-item">
        <div class="contents-item-ttl">
          <h3 class="TL">当日の持ち物</h3>
        </div>
        <div class="contents-item-txt">
          <p class="TX">健康保険証</p>
          <p class="TX">替えのオムツ</p>
          <p class="TX">診察券</p>
          <p class="TX">母子手帳</p>
          <p class="TX">子育て支援医療費<br>受給資格証</p>
          <p class="TX">母子健康のしおり内の<br>健診受診票</p>
        </div>
      </div>
    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>