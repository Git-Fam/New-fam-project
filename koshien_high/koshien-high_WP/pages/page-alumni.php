<?php
/*
Template Name: 卒業生の方・翠城会
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<?php
$theme_uri = get_template_directory_uri();
$img       = $theme_uri . '/img/home/alumni';

$pdf_certificate    = 'https://www.koshiengakuin-h.ed.jp/document/syomei.pdf';
$pdf_address_label  = 'https://www.koshiengakuin-h.ed.jp/document/addresslabel.pdf';
?>

<main class="page page--alumni">

  <!-- ============ KV ============ -->
  <section class="p-alumni-hero">

    <picture class="p-alumni-hero__pic">
      <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_hero.webp">
      <img src="<?php echo $img; ?>/pc_hero.webp" alt="GRADUATES 卒業生の方" class="p-alumni-hero__img">
    </picture>

    <div class="p-alumni-hero__ttl">
      <picture>
        <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/alumni/alumni-ttl_sp.webp">
        <img src="<?php echo get_template_directory_uri(); ?>/img/home/alumni/alumni-ttl_pc.webp" alt="GRADUATES　卒業生の方">
      </picture>
    </div>

  </section>

  <!-- ============ 各種証明書発行について ============ -->
  <section class="p-alumni" id="graduate">
    <div class="p-alumni__inner">

      <div class="p-alumni__heading js-fade">
        <picture>
          <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_heading_main.webp">
          <img src="<?php echo $img; ?>/pc_heading_main.webp" alt="各種証明書発行について">
        </picture>
      </div>

      <!-- ---- 証明書の種類、手数料 ---- -->
      <div class="p-alumni__block js-fade">
        <div class="p-alumni__subheading">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_sub1.webp">
            <img src="<?php echo $img; ?>/pc_sub1.webp" alt="証明書の種類、手数料">
          </picture>
        </div>

        <p class="p-alumni__text">
          学校教育法施行規則により、成績及び単位修得に関する記録の保存期間が定められています。<br>
          この保存期間を経過している場合は、これらの証明書を発行することができませんのでご了承ください。
        </p>

        <div class="p-alumni__table">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_table1.webp">
            <img src="<?php echo $img; ?>/pc_table1.webp" alt="証明書の種類・保存期間・発行手数料一覧">
          </picture>
        </div>

        <p class="p-alumni__note">
          ※提出先から様式の指定がある場合はお知らせください。なければ本校の様式にて発行します。<br>
          ※証明書は１通ずつ封筒に入れてお渡しします。また、卒業証明書以外（成績証明書、単位取得証明書、調査書、推薦書）は厳封（本人開封無効）です。<br>
          ※手数料は切手でご用意をお願いいたします。
        </p>
      </div>

      <!-- ---- 申請に必要なもの ---- -->
      <div class="p-alumni__block js-fade">
        <div class="p-alumni__subheading">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_sub2.webp">
            <img src="<?php echo $img; ?>/pc_sub2.webp" alt="申請に必要なもの">
          </picture>
        </div>

        <p class="p-alumni__text">
          学校教育法施行規則により、成績及び単位修得に関する記録の保存期間が定められています。<br>
          この保存期間を経過している場合は、これらの証明書を発行することができませんのでご了承ください。
        </p>

        <div class="p-alumni__steps">
          <div class="p-alumni__step">
            <p class="p-alumni__step-head"><span class="p-alumni__step-num">&#10102;</span>証明書交付願</p>
            <p class="p-alumni__step-text p-indent">
              下のリンクからダウンロードし、必要事項をご記入ください。<br>
              ※各種証明書は卒業時の氏名での発行となります。
            </p>
            <a href="<?php echo esc_url($pdf_certificate); ?>" target="_blank" rel="noopener noreferrer" class="p-alumni__dl-btn">
              <span class="p-alumni__dl-btn-txt">証明書交付願</span>
              <span class="p-alumni__dl-btn-icon" aria-hidden="true"></span>
            </a>
          </div>

          <div class="p-alumni__step">
            <p class="p-alumni__step-head"><span class="p-alumni__step-num">&#10103;</span>本人確認書類</p>
            <p class="p-alumni__step-text p-indent">
              身分証明書（運転免許証、健康保険証、パスポート、マイナンバーカード等の公的書類）<br>
              郵送による申請の場合は、その写し。
            </p>
          </div>

          <div class="p-alumni__step">
            <p class="p-alumni__step-head"><span class="p-alumni__step-num">&#10104;</span>証明書発行手数料</p>
            <p class="p-alumni__step-text p-indent">上記表の金額分の切手をご準備ください。</p>
          </div>

          <div class="p-alumni__step">
            <p class="p-alumni__step-head"><span class="p-alumni__step-num">&#10105;</span>返信用切手（証明書の郵送を希望する場合）</p>
             <p class="p-alumni__step-text p-indent">
              身分証明書（運転免許証、健康保険証、パスポート、マイナンバーカード等の公的書類）<br>
              郵送による申請の場合は、その写し。
            </p>
            <div class="p-alumni__table p-alumni__table--sub p-indent">
              <picture>
                <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_table2.webp">
                <img src="<?php echo $img; ?>/pc_table2.webp" alt="返信用切手の金額一覧">
              </picture>
            </div>
          </div>
        </div>
      </div>

      <!-- ---- 申請方法 ---- -->
      <div class="p-alumni__block js-fade">
        <div class="p-alumni__subheading">
          <picture>
            <source media="(max-width:767px)" srcset="<?php echo $img; ?>/sp_sub3.webp">
            <img src="<?php echo $img; ?>/pc_sub3.webp" alt="申請方法">
          </picture>
        </div>

        <div class="p-alumni__method">
          <h3 class="p-alumni__method-title">窓口での手続き</h3>
          <p class="p-alumni__method-lead">
            事前にお電話で来校日時をご連絡ください（連絡先は下記【お問い合わせ先】をご覧ください。）
            上記①〜④の書類等を準備し、来校の上、申請手続きを行ってください。また、提出先から証明書の様式の指定がある場合は、用紙をお持ちください。
          </p>
          <dl class="p-alumni__dl">
            <div class="p-alumni__dl-row">
              <dt>受付場所</dt>
              <dd>法人事務局　庶務課（山手幹線沿いの正門から入り、守衛室で入校手続きを行ってください。中・高校舎ではありませんので、ご注意ください。）</dd>
            </div>
            <div class="p-alumni__dl-row">
              <dt>申請できる人</dt>
              <dd>原則、本人が申請してください。</dd>
            </div>
            <div class="p-alumni__dl-row">
              <dt>受取方法と発行に要する日数</dt>
              <dd>証明書の準備ができましたら、ご連絡しますので、窓口まで取りにお越しください。郵送をご希望の場合は、申請時に返信用切手をご準備ください（封筒は必要ありません）。なお、証明書の発行には１週間程度（英文の場合は10日程度）かかります。</dd>
            </div>
          </dl>

          <hr class="p-alumni__divider">

          <h3 class="p-alumni__method-title">郵送による手続き</h3>
          <p class="p-alumni__method-lead">
            上記①〜④の書類等を同封し、下記にご郵送ください。また、提出先から証明書の様式の指定がある場合は、用紙を同封してください。
          </p>
          <dl class="p-alumni__dl">
            <div class="p-alumni__dl-row">
              <dt>送付先</dt>
              <dd>
                〒663-8107　西宮市瓦林町4-25 学校法人甲子園学院 法人事務局 庶務課 証明書発行係宛<br>
                宛名ラベル（PDF）を下のボタンからダウンロードしてお使いください。
                <a href="<?php echo esc_url($pdf_address_label); ?>" target="_blank" rel="noopener noreferrer" class="p-alumni__dl-btn">
                  <span class="p-alumni__dl-btn-txt">宛名ラベル</span>
                  <span class="p-alumni__dl-btn-icon" aria-hidden="true"></span>
                </a>
              </dd>
            </div>
            <div class="p-alumni__dl-row">
              <dt>受取方法と発行に要する日数</dt>
              <dd>証明書は郵送にてお送りしますので、申請時に返信用切手を同封してください（封筒は必要ありません）。なお、証明書の発行には書類到着後、1週間程度（英文の場合は10日程度）かかります。</dd>
            </div>
            <div class="p-alumni__dl-row">
              <dt>その他</dt>
              <dd>本人確認書類の写しは証明書発行業務以外には使用しません。また、業務終了後は適切に廃棄処分します（返却はいたしません。）</dd>
            </div>
          </dl>
        </div>
      </div>

      <!-- ---- お問い合わせ導線 ---- -->
      <div class="p-alumni__contact js-fade">
        <p class="p-alumni__contact-text">このページの内容に関するお問い合わせは法人事務局 庶務課までお願いします。</p>
        <a href="<?php echo home_url('/contact/'); ?>" class="p-alumni__contact-btn">
          <span class="p-alumni__contact-btn-txt">お問い合わせ</span>
          <span class="p-alumni__contact-btn-icon" aria-hidden="true"></span>
        </a>
      </div>

      <div class="p-alumni__info js-fade">
        <p class="p-alumni__info-title">お電話・メールはこちら</p>
        <div class="p-alumni__info-row">
          <a href="tel:0798-67-2100" class="p-alumni__info-tel">
            <span class="p-alumni__info-icon p-alumni__info-icon--tel" aria-hidden="true"></span>
            0798-67-2100
          </a>
          <a href="mailto:a-shomuk@koshien.ac.jp" class="p-alumni__info-mail">
            <span class="p-alumni__info-icon p-alumni__info-icon--mail" aria-hidden="true"></span>
            a-shomuk@koshien.ac.jp
          </a>
        </div>
        <p class="p-alumni__info-hours">営業時間：9時～17時（土・日・祝日及び事務取扱のない日を除く）</p>
      </div>

    </div>
  </section>

</main>


<?php get_template_part('./inc/footer'); ?>
