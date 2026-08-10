<?php
/*
Template Name: about
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->
<div class="page-about">
  <div class="bg--wrap">
    <div class="inner--bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/about/about_kv-bg-pc.webp" media="(min-width: 768px)" type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_kv-bg-sp.webp">
      </picture>
    </div>
    <section class="about_kv">
      <div class="inner--content">
        <h2 class="TL">
          <picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/about/about_kv-ttl-pc.svg" media="(min-width: 768px)"
              type="image/svg+xml">
            <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_kv-ttl-sp.svg" alt="甲子園学院について ABOUT">
          </picture>
        </h2>
        <nav class="kv--nav">
          <ul>
            <li>
              <a class="hover-opa" href="#sec-spirit">建学の精神</a>
            </li>
            <li>
              <a class="hover-opa" href="#sec-history">沿革</a>
            </li>
            <!-- <li>
              <a class="hover-opa" href="#sec-members">役員・評議員</a>
            </li> -->
            <li>
              <a class="hover-opa" href="#sec-circle">　機関誌「園の輪」</a>
            </li>
          </ul>
        </nav>
      </div>
    </section>
    <section class="about_spirit" id="sec-spirit">
      <div class="C_sec-ttl type-01 anime-fade">
        <div class="icon"></div>
        <h3 class="TL">建学の精神</h3>
      </div>
      <div class="inner--content">
        <div class="item anime-fade">
          <h4 class="TL">
            <span class="kana">びんべんどりょく</span>
            黽勉努力
          </h4>
          <p class="TX">
            「黽勉」は、自らの心に従って自発的に勉め励む、自主創造の意味を持っています。<br class="pc">
            また、一人ひとりが自らの人格陶冶に勉めるという意味も含まれています。
          </p>
        </div>
        <div class="item anime-fade">
          <h4 class="TL">
            <span class="kana">わちゅうきょうどう</span>
            和衷協同
          </h4>
          <p class="TX">
            和やかに心をこめて力を合わせ、共に行動し、事に当たることをいい、<br class="pc">
            自分だけでなく人と人との関係における心の持ち方を示します。
          </p>
        </div>
        <div class="item anime-fade">
          <h4 class="TL">
            <span class="kana">しせいいっかん</span>
            至誠一貫
          </h4>
          <p class="TX">
            誠をもって人に接し、物事に対処して、一筋に真心を貫き通すことをいいます。<br class="pc">
            真心は天に通じ、よい結果に至るという信念の下に、誠実な人間を育てることに努めています。
          </p>
        </div>
      </div>
    </section>
  </div>
  <section class="about_history" id="sec-history">
    <div class="inner--bg"></div>
    <div class="C_sec-ttl type-01 anime-fade">
      <div class="icon"></div>
      <h3 class="TL">沿革</h3>
    </div>
    <div class="about_history--chronology anime-fade">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/about/about_history-chronology-pc.webp" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_history-chronology-sp.webp" alt="沿革年表">
      </picture>
    </div>
    <div class="about_history--relation anime-fade">
      <div class="img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_history-relation-01.svg" alt="甲子園学院創立者･校祖 / 久米 長八">
      </div>
      <div class="img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_history-relation-02.svg" alt="前理事長･学院長 / 久米 利男">
      </div>
    </div>
  </section>
  <!-- <section class="about_members" id="sec-members">
    <div class="C_sec-ttl type-02 anime-fade">
      <div class="icon"></div>
      <h3 class="TL">役員・評議員</h3>
    </div>
    <div class="inner--content">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/about/about_members-table-pc.svg" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_members-table-sp.svg" alt="役員・評議員一覧表">
      </picture>
      <ul class="members--tables">
        <li class="table anime-fade">
          <div class="ttl">
            <h4 class="TL">理事</h4>
          </div>
          <ul class="lists">
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">久米 知子</p>
                  <p class="kana">KUME TOMOKO</p>
                </div>
                <div class="item--label">
                  <p class="TX">理事長<br class="pc">役員長</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">尾﨑 秀夫</p>
                  <p class="kana">OZAKI HIDEO</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">宮島 隆之</p>
                  <p class="kana">MIYAJIMA TAKAYUKI</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">中道 一夫</p>
                  <p class="kana">NAKAMICHI KAZUO</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">𠮷田 光男</p>
                  <p class="kana">YOSHIDA MITSUO</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">松永 博</p>
                  <p class="kana">MATSUNAGA HIROSHI</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">江本 通彦</p>
                  <p class="kana">EMOTO MICHIHIKO</p>
                </div>
                <div class="item--label">
                  <p class="TX">学外<br class="pc">理事</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">福田 正</p>
                  <p class="kana">FUKUDA TADASHI</p>
                </div>
                <div class="item--label">
                  <p class="TX">学外<br class="pc">理事</p>
                </div>
              </div>
            </li>


          </ul>
        </li>
        <li class="table anime-fade">
          <div class="ttl">
            <h4 class="TL">監事</h4>
          </div>
          <ul class="lists">

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">芝池 勉</p>
                  <p class="kana">SHIBAIKE TSUTOMU</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">西川 淳</p>
                  <p class="kana">NISHIKAWA JUN</p>
                </div>
              </div>
            </li>

          </ul>
        </li>
        <li class="table anime-fade">
          <div class="ttl">
            <h4 class="TL">評議員</h4>
          </div>
          <ul class="lists">
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">早坂 三郎</p>
                  <p class="kana">HAYASAKA SABUROU</p>
                </div>
              </div>
            </li>
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">熊谷 正秀</p>
                  <p class="kana">KUMAGAI MASAHIDE</p>
                </div>
              </div>
            </li>
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">小仁 利之</p>
                  <p class="kana">KONI TOSHIYUKI</p>
                </div>
              </div>
            </li>
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">東耕 幸惠</p>
                  <p class="kana">TOUKOU YUKIE</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">森本 弘江</p>
                  <p class="kana">MORIMOTO HIROE</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">佐久間 春夫</p>
                  <p class="kana">SAKUMA HARUO</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">塚本 康子</p>
                  <p class="kana">TSUKAMOTO YASUKO</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">村上 順一</p>
                  <p class="kana">MURAKAMI JUNICHI</p>
                </div>
              </div>
            </li>
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">小谷 豪郎</p>
                  <p class="kana">KOTANI GOROU</p>
                </div>
              </div>
            </li>

            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">小池田 満</p>
                  <p class="kana">KOIKEDA MITSURU</p>
                </div>
              </div>
            </li>
            <li class="item">
              <div class="item--inner">
                <div class="item--info">
                  <p class="name">伊藤 博章</p>
                  <p class="kana">ITOU HIROAKI</p>
                </div>
              </div>
            </li>



          </ul>
        </li>
      </ul>
    </div>
  </section> -->
  <section class="about_circle" id="sec-circle">
    <div class="C_sec-ttl type-02 anime-fade">
      <div class="icon"></div>
      <h3 class="TL">　機関誌「園の輪」</h3>
    </div>
    <div class="about_circle--sub_ttl anime-fade">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/about/about_circle--sub_ttl-pc.webp" media="(min-width: 768px)"
          type="image/svg+xml">
        <img src="<?php echo get_template_directory_uri(); ?>/img/about/about_circle--sub_ttl-sp.webp">
      </picture>
      <h4 class="TL">
        幼稚園から<br>
        大学院までをつなぐ<br>
        機関誌「園の輪」
      </h4>
    </div>
    <div class="about_circle--contents">
      <div class="about_circle--contents--txt anime-fade">
        <p class="TX">
          昭和39（1964）年、甲子園短期大学が開学した年に、各学校園を繋ぎ、家庭とも結ぶ機関誌として「園の輪」が創刊されました。また、校訓の「和衷協同」の「和」とも通じており、学院総合連携にふさわしい名前として選ばれました。以来50数年を経て、現在では毎号巻頭を飾るエッセイや各学校園の教育活動などを全ページカラー印刷で年3回発行しています。
        </p>
      </div>
      <div class="about_circle--contents--pdf anime-fade">
        <!-- Smart Custom Fields(SCF)で繰り返し(pdf_ttl,pdf_file,pdf_check) -->
        <?php
        $free_item = SCF::get('about_sec-circle');
        $has_data = false;
        if (!empty($free_item) && is_array($free_item)) {
          foreach ($free_item as $fields) {

            if (!empty($fields['pdf_check'])) {
              $has_data = true;
              $pdf_url = is_numeric($fields['pdf_file']) ? wp_get_attachment_url($fields['pdf_file']) : $fields['pdf_file'];
              $pdf_image_url = is_numeric($fields['pdf_file']) ? wp_get_attachment_image_url($fields['pdf_file'], 'full') : $fields['pdf_file'];
        ?>
              <a class="hover-opa" href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="noopener noreferrer">
                <div class="img">
                  <img src="<?php echo esc_url($pdf_image_url); ?>">
                </div>
                <div class="txt">
                  <p class="TX"><?php echo $fields['pdf_ttl']; ?></p>
                  <div class="icon">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icon/pdf-icon.svg">
                  </div>
                </div>
              </a>
          <?php
            }
          }
        }
        if (!$has_data) {
          ?>
          <p class="TX" style="text-align: center;">公開中のPDFはありません。</p>
        <?php
        }
        ?>
      </div>
    </div>
  </section>
</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>