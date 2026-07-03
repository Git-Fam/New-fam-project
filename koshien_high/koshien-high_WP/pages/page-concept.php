<?php
/*
Template Name: ブランドコンセプト・ごあいさつ
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--concept">

    <!-- ============ FV（sticky固定） ============ -->
    <div class="p-concept-fv-wrap">
      <section class="p-concept-fv" id="js-concept-fv">
        <div class="p-concept-fv__slider">
          <div class="p-concept-fv__slide is-active">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/concept/fv_01_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/concept/fv_01_pc.webp" alt="">
            </picture>
          </div>
          <div class="p-concept-fv__slide">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/concept/fv_02_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/concept/fv_02_pc.webp" alt="">
            </picture>
          </div>
        </div>
        <div class="p-concept-fv__white" id="js-fv-white"></div>
        <div class="p-concept-fv__gauge">
          <span class="p-concept-fv__gauge-fill" id="js-fv-gauge-fill"></span>
        </div>
      </section>
    </div>

    <!-- ============ 理念テキスト（FVに重なって上がってくる） ============ -->
    <div class="p-concept-content">
      <section class="p-concept-philosophy" id="js-concept-philosophy">
        <div class="p-concept-philosophy__inner">
          <div class="p-concept-philosophy__text">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/concept/philosophy_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/concept/philosophy_pc.webp" alt="あなたの人生をつくるのは、あなた自身の心です。…">
            </picture>
          </div>
        </div>
      </section>
        


      <!-- ============ Vロゴ＋グループロゴ一覧（footer流用コピペ） ============ -->
      <section class="p-concept-logos">
        <div class="p-concept-logos__inner">
          <div class="p-concept-logos__mark">
            <img src="<?php echo get_template_directory_uri(); ?>/img/footer/gakuin-logo.webp" alt="甲子園学院">
          </div>
          <nav class="p-concept-logos__group">
            <ul>
              <li><a href="https://www.koshien.ac.jp/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-01.webp" alt="甲子園大学"></a></li>
              <li><a href="https://www.koshien-c.ac.jp/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-02.webp" alt="甲子園短期大学"></a></li>
              <li><a href="https://www.koshien-c.ac.jp/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-04.webp" alt="甲子園中学校・高等学校"></a></li>
              <li><a href="https://www.koshiengakuin-e.ed.jp/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-05.webp" alt="甲子園学院小学校"></a></li>
              <li><a href="https://www.koshiengakuin-k.ed.jp/" target="_blank" rel="noopener noreferrer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer/school-name-06.webp" alt="甲子園学院幼稚園"></a></li>
            </ul>
          </nav>
        </div>
      </section>


      <!-- ============ ごあいさつへの導線（スクロールダウン矢印） ============ -->
      <div class="p-greeting-title">
            <img src="<?php echo get_template_directory_uri(); ?>/img/home/concept/greeting-title.webp" alt="ごあいさつ">
      </div>


      <!-- ============ ごあいさつ（背景sticky＋ボックスがスクロールで上昇） ============ -->
      <section class="p-greeting" id="greeting">
        <div class="p-greeting__sticky">
          <!-- 背景写真（固定） -->
          <div class="p-greeting__bg">
            <picture>
              <source media="(max-width:767px)" srcset="<?php echo get_template_directory_uri(); ?>/img/home/concept/greeting_person_sp.webp">
              <img src="<?php echo get_template_directory_uri(); ?>/img/home/concept/greeting_person_pc.webp" alt="校長 川崎芳徳">
            </picture>
          </div>
          <!-- テキスト（スクロールで下から上へ流れる） -->
          <div class="p-greeting__scroller" id="js-greeting-scroller">
            <div class="p-greeting__box">
              <p class="p-greeting__role">甲子園学院中学校・高等学校長</p>
              <p class="p-greeting__name">川崎　芳徳</p>
            <div class="p-greeting__msg">
              <p>令和８年４月、甲子園学院中学校・高等学校長に<br class="pc">
                就任しました川崎芳徳と申します。<br class="pc">
                現在、予測困難な時代を迎え、中学校・高等学校教育には、<br class="pc">
                「想定外の事象と向き合い対応する力」や、<br class="pc">
                「不透明な未来を切り拓く力」の涵養が求められています。<br class="pc">
                このような中、本校では、校訓である<br class="pc">
                「黽勉努力（びんべんどりょく）」の精神により、<br class="pc">
                自主・自律を目指し、「決められたことを、ただ<br class="pc">
                守っていればよい」ではなく、道徳倫理を身につけ適切な<br class="pc">
                行動・選択が取れるよう人格形成に取り組んでいます。<br class="pc">
                その取組の一環として、令和８年９月から、<br class="pc">
                登下校時の服装について、「制服・私服併用可能期間」を<br class="pc">
                設定し、式典や考査等以外の日は、自身の心身の状況、<br class="pc">
                気候・天候、放課後のスケジュールなど、<br class="pc">
                ＴＰＯに応じて服装を自由に選べることとしました。<br class="pc">
                創立85年目を迎える歴史と伝統があるがゆえに、<br class="pc">
                「不易：時代を経ても決して変わらない、<br class="pc">
                普遍的な真理や本質を貫くこと」と、<br class="pc">
                「流行：時代や状況の移り変わり、社会のニーズに合わせて<br class="pc">
                新しいものを取り入れていくこと」を、<br class="pc">
                適切に見極めていくことが重要であると考えます。<br class="pc">
                これから、ますます発展を遂げていく<br class="pc">
                甲子園学院中学校・高等学校に、どうぞご注目ください！
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</main>


<?php get_template_part('./inc/footer'); ?>