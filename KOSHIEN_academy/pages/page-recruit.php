<?php
/*
Template Name: recruit
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->
<div class="page-recruit">
  <section class="recruit_kv">
    <div class="inner--bg">
      <video class="pc" src="<?php echo get_template_directory_uri(); ?>/img/recruit/recruit_kv-bg.mp4" autoplay muted loop playsinline></video>
      <video class="sp" src="<?php echo get_template_directory_uri(); ?>/img/recruit/recruit_kv-bg-sp.mp4" autoplay muted loop playsinline></video>
    </div>
    <div class="inner--top">
      <h2 class="TL">
        子どもたちの<br class="sp">心をつくる仕事。<br>自分自身の<br class="sp">心をみがく仕事。
      </h2>
    </div>
    <div class="inner--txt anime-fade">
      <p class="TX">
        子どもたちと関わると、<br class="sp">自分の在り方がいつも試されます。<br>
        なにを伝えるか。どう寄り添うか。<br>
        その在り方の積み重ねが、<br>
        ここではたらく職員を<br class="sp">成長させてくれます。<br>
        知識だけでは心は動きません。<br>
        正解や不正解を教えるだけでなく、<br>
        “こんな大人でありたい”と<br class="sp">思ってもらえる姿を示すことを、<br>
        わたしたちは大切にしています。<br>
        つまり、<br class="sp">自分自身の心をみがく姿勢が、<br>
        子どもたちの未来をつくっていく。<br>
        それが、甲子園学院で<br class="sp">はたらくということです。
      </p>
      <p class="TX-sub">KOSHIEN GAKUIN RECRUIT</p>
    </div>
  </section>
  <div class="recruit_sec--wrap">
    <section class="recruit_teacher anime-fade">
      <div class="C_sec-ttl type-01">
        <div class="icon"></div>
        <h3 class="TL">職員 募集要項</h3>
      </div>
      <div class="recruit_teacher--inner">
        <ul>
          <!-- Smart Custom Fields(SCF)で繰り返し-->
          <?php
          $free_item = SCF::get('recruit_item');
          $has_data = false;
          if (!empty($free_item) && is_array($free_item)) {
            foreach ($free_item as $fields) {

              if (!empty($fields['check'])) {
                $has_data = true;
          ?>
                <li>
                  <a class="hover-opa" href="<?php echo $fields['url']; ?>" target="_blank" rel="noopener noreferrer">
                    <p class="TX"><?php echo $fields['name']; ?></p>
                  </a>
                </li>
            <?php
              }
            }
          }
          if (!$has_data) {
            ?>
            <p class="TX" style="text-align: center; color: #FFF;">募集要項はありません。</p>
          <?php
          }
          ?>

        </ul>
      </div>
    </section>
    <section class="recruit_sec anime-fade">
      <div class="recruit_sec--inner">
        <div class="tabs">
          <div class="C_sec-ttl type-01">
            <div class="icon"></div>
            <h3 class="TL">事務職 募集要項/応募フォーム</h3>
          </div>
          <!-- <ul class="tab-list">
            <li class="size-l is-active">
              <a class="hover-opa">
                <div class="icon"></div>
                <p class="TX">甲子園学院</p>
              </a>
            </li>
            <li class="size-l">
              <a class="hover-opa">
                <div class="icon"></div>
                <p class="TX">甲子園大学</p>
              </a>
            </li>
            <li>
              <a class="hover-opa">
                <div class="icon"></div>
                <p class="TX">甲子園学院中学校・高等学校</p>
              </a>
            </li>
            <li>
              <a class="hover-opa">
                <div class="icon"></div>
                <p class="TX">甲子園学院小学校</p>
              </a>
            </li>
            <li>
              <a class="hover-opa">
                <div class="icon"></div>
                <p class="TX">甲子園学院幼稚園</p>
              </a>
            </li>
          </ul> -->
        </div>
        <div class="contents">
          <ul class="contents--list">
            <li class="contents--item is-active">
              <div class="item--area">
               <ul class="item--inner">
                <!-- <li class=“no-ttl--item”>
                    <p class=“TX”>
                      現在、求人募集は行っておりません。<br>
                      募集の際は、当ページにてご案内いたします。
                    </p>
                  </li> -->
                  <?php
                  $recruit_items = SCF::get('recruit_sec_item');
                  if (!empty($recruit_items) && is_array($recruit_items)) :
                      foreach ($recruit_items as $item) :
                  ?>
                      <li>
                          <div class="ttl">
                              <h4 class="TL"><?php echo esc_html($item['item_title']); ?></h4>
                          </div>
                          <div class="txt">
                              <p class="TX"><?php echo nl2br(esc_html($item['item_txt'])); ?></p>
                          </div>
                      </li>
                  <?php
                      endforeach;
                  endif;
                  ?>
              </ul>
              </div>
              <div class="form--area">
                <div class="C_sec-ttl type-03">
                  <h3 class="TL">応募フォーム</h3>
                </div>
                <div class="form--inner">
                  <div class="top--txt">
                    <p class="TX">
                      必要事項をご記入のうえ、履歴書（市販の履歴書で可）を応募フォームに添付して送信してください。
                    </p>
                  </div>
                  <?php
                  echo do_shortcode('[contact-form-7 id="90e394b" title="recruit"]');
                  ?>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>