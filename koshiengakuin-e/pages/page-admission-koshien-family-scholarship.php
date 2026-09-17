<?php
/*
Template Name: 入試情報 - 奨学金制度
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
          <img src="<?php echo get_template_directory_uri(); ?>/img/admission_koshien-family-scholarship_kv.webp" alt="" loading="lazy" aria-hidden="true" class="u-w100">

          <div class="p-admission-index__info">
            <span class="p-front-banner-info__top font-avenir-bold">Koshien Family Scholarship</span>
            <span class="p-front-banner-info__bottom">奨学金制度</span>
          </div>
        </div>

        <div class="p-admission-child__inner pc-pdt-70 pc-pdb-150 sp-pdt-56 sp-pdb-50">

          <h2 class="p-admission-child__subtitle pc-mgb-50 sp-mgb-35">
            下記に該当する場合は、<br class="pc-none">「ファミリー奨学金」として<br>
            入学後10万円を支給します。
          </h2>

          <div class="p-admission-child-numList sp-pdl-20 sp-pdr-20">
            <div class="p-admission-child-numList__item">
              <span class="p-admission-child-numList__num font-avenir">01</span>
              <p class="p-admission-child-numList__text">
                父母兄弟姉妹が、学院幼稚園～大学までのいずれかを卒業(園)、または在籍の場合
              </p>
            </div>
            <div class="p-admission-child-numList__item">
              <span class="p-admission-child-numList__num font-avenir">02</span>
              <p class="p-admission-child-numList__text">
                父母兄弟姉妹が、学院幼稚園～大学に同時入学(園)の場合
              </p>
            </div>
            <div class="p-admission-child-numList__item">
              <span class="p-admission-child-numList__num font-avenir">03</span>
              <p class="p-admission-child-numList__text">
                本人が、<br class="sp-none">学院幼稚園を卒園の場合
              </p>
            </div>
          </div>

        </div>


      </div>


      <?php get_template_part('./inc/footer'); ?>

    </main>
  </div>


</div>