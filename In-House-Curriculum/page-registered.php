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

  // Form
  $Form01 = $_POST['Form01'];

  // FAM
  $FAM01 = $_POST['FAM01'];

  // test
  $test01 = $_POST['test01'];

  // JS
  $JS01 = $_POST['JS01'];

  // WP
  $WP01 = $_POST['WP01'];

  // SEO
  $SEO01 = $_POST['SEO01'];





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
    // Form
    'Form01' => $Form01,
    // FAM
    'FAM01' => $FAM01,
    // test
    'test01' => $test01,
    // JS
    'JS01' => $JS01,
    // WP
    'WP01' => $WP01,
    // SEO
    'SEO01' => $SEO01

  );

  wp_update_user($userdata);

//   wp_redirect(bloginfo('url') . '/my');
  wp_redirect(bloginfo('url') . '/test-hp-2/my');
  exit;
}


?>

<?php get_header(); ?>

      <div class="registered">

          <div class="registered--wap">
              <div class="registered--wap--title">
                  <p class="TX">更新完了</p>
              </div>
              <a class="registered--wap--back" href="<?php bloginfo('url'); ?>/my">戻る</a>
          </div>

      </div>
      

<?php get_footer(); ?>
