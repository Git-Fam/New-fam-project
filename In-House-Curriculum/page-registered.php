<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // div
  $div01 = $_POST['div01'];
  $div02 = $_POST['div02'];
  $div03 = $_POST['div03'];
  $div04 = $_POST['div04'];
  $div05 = $_POST['div05'];
  $div06 = $_POST['div06'];
  $div07 = $_POST['div07'];
  $responsive = $_POST['responsive'];

  // JQ
  $JQ01 = $_POST['JQ01'];
  $JQ02 = $_POST['JQ02'];
  $JQ03 = $_POST['JQ03'];
  $JQ04 = $_POST['JQ04'];
  $JQ05 = $_POST['JQ05'];
  $JQ06 = $_POST['JQ06'];
  $JQ07 = $_POST['JQ07'];
  $JQ08 = $_POST['JQ08'];
  $JQ09 = $_POST['JQ09'];
  $JQ10 = $_POST['JQ10'];
  $JQLast = $_POST['JQLast'];

  // LP
  $LP01 = $_POST['LP01'];

  // Sass
  $Sass01 = $_POST['Sass01'];
  $Sass02 = $_POST['Sass02'];
  $Sass03 = $_POST['Sass03'];

  // Form
  $Form01 = $_POST['Form01'];

  // FAM
  $FAM01 = $_POST['FAM01'];
  $FAM02 = $_POST['FAM02'];
  $FAM03 = $_POST['FAM03'];

  // test
  $test01 = $_POST['test01'];

  // JS
  $JS01 = $_POST['JS01'];

  // WP
  $WP01 = $_POST['WP01'];
  $WP02 = $_POST['WP02'];
  $WP03 = $_POST['WP03'];

  // SEO
  $SEO01 = $_POST['SEO01'];

  // React
  $React01 = $_POST['React01'];
  $React01__5 = $_POST['React01__5'];
  $React02_1 = $_POST['React02_1'];
  $React02_2 = $_POST['React02_2'];
  $React02_3 = $_POST['React02_3'];
  $React02_4 = $_POST['React02_4'];
  $React02_5 = $_POST['React02_5'];
  $React02_6 = $_POST['React02_6'];
  $React02_7 = $_POST['React02_7'];
  $React02_8 = $_POST['React02_8'];
  $React02_9 = $_POST['React02_9'];
  $React03_1 = $_POST['React03_1'];
  $React03_2 = $_POST['React03_2'];
  $React03_3 = $_POST['React03_3'];
  $React03_4 = $_POST['React03_4'];
  $React03__5 = $_POST['React03__5'];
  $React04 = $_POST['React04'];
  $React04_1 = $_POST['React04_1'];
  $React04_2 = $_POST['React04_2'];
  $React04_3 = $_POST['React04_3'];
  $React04_4 = $_POST['React04_4'];
  $React04_5 = $_POST['React04_5'];
  $React04_6 = $_POST['React04_6'];
  $React05 = $_POST['React05'];
  $React06 = $_POST['React06'];
  $React06_1 = $_POST['React06_1'];
  $React06_2 = $_POST['React06_2'];
  $React06_3 = $_POST['React06_3'];
  $React06_4 = $_POST['React06_4'];
  $React06_5 = $_POST['React06_5'];
  $React07 = $_POST['React07'];
  $React08 = $_POST['React08'];
  $React09 = $_POST['React09'];
  $React09_1 = $_POST['React09_1'];
  $React09_2 = $_POST['React09_2'];
  $React09_3 = $_POST['React09_3'];
  $React09_4 = $_POST['React09_4'];
  $React09_5 = $_POST['React09_5'];
  $React09_6 = $_POST['React09_6'];
  $React10 = $_POST['React10'];
  $React11 = $_POST['React11'];


  // Java
  $Java01 = $_POST['Java01'];
  $Java02 = $_POST['Java02'];
  $Java03 = $_POST['Java03'];
  $Java04 = $_POST['Java04'];
  $Java05 = $_POST['Java05'];
  $Java06 = $_POST['Java06'];
  $Java07 = $_POST['Java07'];
  $Java08 = $_POST['Java08'];
  $Java09 = $_POST['Java09'];
  $Java10 = $_POST['Java10'];
  $Java11 = $_POST['Java11'];
  $Java12 = $_POST['Java12'];
  $Java_object_01 = $_POST['Java_object_01'];
  $Java_object_02 = $_POST['Java_object_02'];
  $Java_object_03 = $_POST['Java_object_03'];
  $Java_object_04 = $_POST['Java_object_04'];
  $Java_object_05 = $_POST['Java_object_05'];
  $Java_app_01 = $_POST['Java_app_01'];
  $Java_app_02 = $_POST['Java_app_02'];
  $Java_app_03 = $_POST['Java_app_03'];
  $Java_app_04 = $_POST['Java_app_04'];
  $Java_app_05 = $_POST['Java_app_05'];
  $Java_app_06 = $_POST['Java_app_06'];
  $Java_springBoot_01 = $_POST['Java_springBoot_01'];
  $Java_springBoot_02 = $_POST['Java_springBoot_02'];
  $Java_springBoot_03 = $_POST['Java_springBoot_03'];
  $Java_springBoot_04 = $_POST['Java_springBoot_04'];
  $Java_springBoot_05 = $_POST['Java_springBoot_05'];
  $Java_springBoot_06 = $_POST['Java_springBoot_06'];
  $Java_springBoot_07 = $_POST['Java_springBoot_07'];
  $Java_springBoot_08 = $_POST['Java_springBoot_08'];
  $Java_springBoot_09 = $_POST['Java_springBoot_09'];
  $Java_springBoot_10 = $_POST['Java_springBoot_10'];
  $Java_springBoot_11 = $_POST['Java_springBoot_11'];
  $Java_WebsoketSTOMP_01 = $_POST['Java_WebsoketSTOMP_01'];
  $Java_WebsoketSTOMP_02 = $_POST['Java_WebsoketSTOMP_02'];
  $Java_WebsoketSTOMP_03 = $_POST['Java_WebsoketSTOMP_03'];
  $Java_WebsoketSTOMP_04 = $_POST['Java_WebsoketSTOMP_04'];
  $Java_WebsoketSTOMP_05 = $_POST['Java_WebsoketSTOMP_05'];
  $Java_WebsoketSTOMP_06 = $_POST['Java_WebsoketSTOMP_06'];

  // Design
  $Design01 = $_POST['Design01'];
  $Design01_2 = $_POST['Design01_2'];
  $Design02 = $_POST['Design02'];
  $Design02_2 = $_POST['Design02_2'];
  $Design02_3 = $_POST['Design02_3'];
  $Design02_4 = $_POST['Design02_4'];
  $Design02_5 = $_POST['Design02_5'];
  $Design02_6 = $_POST['Design02_6'];
  $Design03 = $_POST['Design03'];
  $Design03_2 = $_POST['Design03_2'];
  $Design03_3 = $_POST['Design03_3'];
  $Design03_4 = $_POST['Design03_4'];
  $Design04 = $_POST['Design04'];
  $Design04_2 = $_POST['Design04_2'];
  $Design04_3 = $_POST['Design04_3'];
  $Design04_4 = $_POST['Design04_4'];
  $Design04_4_1 = $_POST['Design04_4_1'];
  $Design04_4_2 = $_POST['Design04_4_2'];
  $Design04_4_3 = $_POST['Design04_4_3'];
  $Design05 = $_POST['Design05'];
  $Design06 = $_POST['Design06'];
  $Design06_2 = $_POST['Design06_2'];
  $Design07 = $_POST['Design07'];
  $Design07_2 = $_POST['Design07_2'];
  $Design07_3 = $_POST['Design07_3'];
  $Design07_4 = $_POST['Design07_4'];
  $Design08 = $_POST['Design08'];
  $Design08_2 = $_POST['Design08_2'];
  $Design09 = $_POST['Design09'];
  $Design09_2 = $_POST['Design09_2'];
  $Design09_3 = $_POST['Design09_3'];
  






  // ユーザー情報の更新
  $user_id = get_current_user_id();
  $userdata = array(
    'ID' => $user_id,
    // div
    'div01' => $div01,
    'div02' => $div02,
    'div03' => $div03,
    'div04' => $div04,
    'div05' => $div05,
    'div06' => $div06,
    'div07' => $div07,
    'responsive' => $responsive,
    // JQ
    'JQ01' => $JQ01,
    'JQ02' => $JQ02,
    'JQ03' => $JQ03,
    'JQ04' => $JQ04,
    'JQ05' => $JQ05,
    'JQ06' => $JQ06,
    'JQ07' => $JQ07,
    'JQ08' => $JQ08,
    'JQ09' => $JQ09,
    'JQ10' => $JQ10,
    'JQLast' => $JQLast,
    // LP
    'LP01' => $LP01,
    // Sass
    'Sass01' => $Sass01,
    'Sass02' => $Sass02,
    'Sass03' => $Sass03,
    // Form
    'Form01' => $Form01,
    // FAM
    'FAM01' => $FAM01,
    'FAM02' => $FAM02,
    'FAM03' => $FAM03,
    // test
    'test01' => $test01,
    // JS
    'JS01' => $JS01,
    // WP
    'WP01' => $WP01,
    'WP02' => $WP02,
    'WP03' => $WP03,
    // SEO
    'SEO01' => $SEO01,

    // React
    'React01' => $React01,
    'React01__5' => $React01__5,
    'React02_1' => $React02_1,
    'React02_2' => $React02_2,
    'React02_3' => $React02_3,
    'React02_4' => $React02_4,
    'React02_5' => $React02_5,
    'React02_6' => $React02_6,
    'React02_7' => $React02_7,
    'React02_8' => $React02_8,
    'React02_9' => $React02_9,
    'React03_1' => $React03_1,
    'React03_2' => $React03_2,
    'React03_3' => $React03_3,
    'React03_4' => $React03_4,
    'React03__5' => $React03__5,
    'React04' => $React04,
    'React04_1' => $React04_1,
    'React04_2' => $React04_2,
    'React04_3' => $React04_3,
    'React04_4' => $React04_4,
    'React04_5' => $React04_5,
    'React04_6' => $React04_6,
    'React05' => $React05,
    'React06_1' => $React06_1,
    'React06_2' => $React06_2,
    'React06_3' => $React06_3,
    'React06_4' => $React06_4,
    'React06_5' => $React06_5,
    'React07' => $React07,
    'React08' => $React08,
    'React09' => $React09,
    'React09_1' => $React09_1,
    'React09_2' => $React09_2,
    'React09_3' => $React09_3,
    'React09_4' => $React09_4,
    'React09_5' => $React09_5,
    'React09_6' => $React09_6,
    'React10' => $React10,
    'React11' => $React11,

    // Java
    'Java01' => $Java01,
    'Java02' => $Java02,
    'Java03' => $Java03,
    'Java04' => $Java04,
    'Java05' => $Java05,
    'Java06' => $Java06,
    'Java07' => $Java07,
    'Java08' => $Java08,
    'Java09' => $Java09,
    'Java10' => $Java10,
    'Java11' => $Java11,
    'Java12' => $Java12,
    'Java_object_01' => $Java_object_01,
    'Java_object_02' => $Java_object_02,
    'Java_object_03' => $Java_object_03,
    'Java_object_04' => $Java_object_04,
    'Java_object_05' => $Java_object_05,
    'Java_app_01' => $Java_app_01,
    'Java_app_02' => $Java_app_02,
    'Java_app_03' => $Java_app_03,
    'Java_app_04' => $Java_app_04,
    'Java_app_05' => $Java_app_05,
    'Java_app_06' => $Java_app_06,
    'Java_springBoot_01' => $Java_springBoot_01,
    'Java_springBoot_02' => $Java_springBoot_02,
    'Java_springBoot_03' => $Java_springBoot_03,
    'Java_springBoot_04' => $Java_springBoot_04,
    'Java_springBoot_05' => $Java_springBoot_05,
    'Java_springBoot_06' => $Java_springBoot_06,
    'Java_springBoot_07' => $Java_springBoot_07,
    'Java_springBoot_08' => $Java_springBoot_08,
    'Java_springBoot_09' => $Java_springBoot_09,
    'Java_springBoot_10' => $Java_springBoot_10,
    'Java_springBoot_11' => $Java_springBoot_11,
    'Java_WebsoketSTOMP_01' => $Java_WebsoketSTOMP_01,
    'Java_WebsoketSTOMP_02' => $Java_WebsoketSTOMP_02,
    'Java_WebsoketSTOMP_03' => $Java_WebsoketSTOMP_03,
    'Java_WebsoketSTOMP_04' => $Java_WebsoketSTOMP_04,
    'Java_WebsoketSTOMP_05' => $Java_WebsoketSTOMP_05,
    'Java_WebsoketSTOMP_06' => $Java_WebsoketSTOMP_06,

    // Design
    'Design01' => $Design01,
    'Design01_2' => $Design01_2,
    'Design02' => $Design02,
    'Design02_2' => $Design02_2,
    'Design02_3' => $Design02_3,
    'Design02_4' => $Design02_4,
    'Design02_5' => $Design02_5,
    'Design02_6' => $Design02_6,
    'Design03' => $Design03,
    'Design03_2' => $Design03_2,
    'Design03_3' => $Design03_3,
    'Design03_4' => $Design03_4,
    'Design04' => $Design04,
    'Design04_2' => $Design04_2,
    'Design04_3' => $Design04_3,
    'Design04_4' => $Design04_4,
    'Design04_4_1' => $Design04_4_1,
    'Design04_4_2' => $Design04_4_2,
    'Design04_4_3' => $Design04_4_3,
    'Design05' => $Design05,
    'Design06' => $Design06,
    'Design06_2' => $Design06_2,
    'Design07' => $Design07,
    'Design07_2' => $Design07_2,
    'Design07_3' => $Design07_3,
    'Design07_4' => $Design07_4,
    'Design08' => $Design08,
    'Design08_2' => $Design08_2,
    'Design09' => $Design09,
    'Design09_2' => $Design09_2,
    'Design09_3' => $Design09_3,


  );

  wp_update_user($userdata);

  //   wp_redirect(bloginfo('url') . '/my');
  // wp_redirect(bloginfo('url') . '/test-hp-2/my');
  wp_redirect(home_url('/my'));
  exit;
}



?>

<?php get_header(); ?>

<div class="registered">

  <div class="registered--wap">
    <div class="registered--wap--title">
      <p class="TX">更新完了</p>
    </div>
    <a class="registered--wap--back" href="<?php echo home_url('/my'); ?>">戻る</a>
  </div>

</div>


<?php get_footer(); ?>