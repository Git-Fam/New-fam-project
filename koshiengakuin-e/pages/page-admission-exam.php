<?php
/*
Template Name: 入試情報 - 入学試験
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="p-admission">

  <div class="p-admission-content">

    <?php get_template_part('./inc/admission-sidebar'); ?>

    <main class="p-admission-content-main">

      <div class="p-admission-child">

        <div class="p-admission-child__kv">
          <img src="<?php echo get_template_directory_uri(); ?>/img/admission_exam_kv.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">

          <div class="p-admission-index__info">
            <span class="p-front-banner-info__top font-avenir-bold">Admissions Exam</span>
            <span class="p-front-banner-info__bottom">入学試験</span>
          </div>
        </div>

        <div class="p-admission-child__inner pc-pdt-70 pc-pdb-50 sp-pdt-56 sp-pdb-70">
          <section>
            <div class="p-label-list">
              <div class="p-label-list__item">
                <h2 class="p-label-list__title m-type-pale">入学試験＜一次＞　令和8年9月5日（土）</h2>
                <div class="p-label-list__inner">
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">願書受付（ Ｗeｂ出願 ）</h3>
                    <p class="p-label-list__text m-date">令和8年<span>8月3日</span>(月) -<span>17日</span>(月) </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">選考期日</h3>
                    <p class="p-label-list__text">
                      【親子面接】<br>
                      令和8年8月24日（月）～27日（木）<br>
                      （※親子面接の日時はWeb出願時にWeb上で選択できます）<br>
                      <br>
                      【入学選考】<br>
                      令和8年9月5日（土）午前9時～正午
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">合格発表</h3>
                    <p class="p-label-list__text">
                      令和 8年 9月 6日（日） 郵送 <br>
                      ※電話でのお問い合わせはご遠慮ください
                    </p>
                  </div>
                </div>
              </div>

              <div class="p-label-list__item">
                <h2 class="p-label-list__title m-type-pale">入学試験＜二次＞　令和9年1月23日（土）</h2>
                <div class="p-label-list__inner">
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">願書受付（ Ｗeｂ出願 ）</h3>
                    <p class="p-label-list__text m-date">令和9年<span>1月5日</span>(火) -<span>15日</span>(金) </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">選考期日</h3>
                    <p class="p-label-list__text">
                      【親子面接】<br>
                      令和9年1月20日（水）～21日（木）<br>
                      （※親子面接の日時はWeb出願時にWeb上で選択できます）<br>
                      <br>
                      【入学選考】<br>
                      令和9年1月23日（土）午前9時～正午
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">合格発表</h3>
                    <p class="p-label-list__text">
                      令和9年1月24日（日）郵送
                    </p>
                  </div>
                </div>
              </div>

            </div>
          </section>

          <p class="p-admission-child__note pc-mgt-30 sp-mgt-20">※その他詳細は、下の募集要項をご覧いただくか、直接お問い合わせください。 （0798-67-2366）</p>


        </div>


      </div>


      <?php get_template_part('./inc/footer'); ?>

    </main>
  </div>


</div>