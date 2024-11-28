<?php
/*
Template Name: company
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>
<?php get_template_part('./inc/kv'); ?>

<main class="main">
  <div class="main__inner">

    <section class="C_other-contents">
      <div class="title">
        <h1 class="TL">運営会社</h1>
      </div>
      <div class="C_other-contents--container container__archive company-pa">
        <div class="C_other-contents--container--inner">

        <div class="C_terms-content company">
          <ul class="list">
            <?php
              $company_list = SCF::get('company_list');
              foreach ($company_list as $fields) {
                ?>
                  <li class="item">
                    <p class="label"><?php echo $fields['company_list_title']; ?></p>
                    <p class="TX"><?php echo $fields['company_list_text']; ?></p>
                  </li>
              <?php } ?>
          </ul>
        </div>
        </div>
      </div>
    </section>

    <?php get_template_part('./inc/banner'); ?>
  </div>
</main>

<?php get_template_part('./inc/footer'); ?>