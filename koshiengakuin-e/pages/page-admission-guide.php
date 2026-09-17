<?php
/*
Template Name: 入試情報 - 募集要項
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
            <span class="p-front-banner-info__top font-avenir-bold">Admissions</span>
            <span class="p-front-banner-info__bottom">入学試験・募集要項</span>
          </div>
        </div>

        <div class="p-admission-child__inner pc-pdt-70 pc-pdb-150 sp-pdt-56 sp-pdb-80">

          <section>
            <div class="p-label-list">
              <div class="p-label-list__item">
                <h2 class="p-label-list__title">１次募集</h2>
                <div class="p-label-list__inner">
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">願書受付（ Ｗeｂ出願 ）</h3>
                    <?php
                    // acf のフィールドを取得
                    // 願書受付
                    // htmlタグがある場合はそのまま を出力
                    $application_period = get_field('願書受付');
                    if ($application_period) {
                      echo '<p class="p-label-list__text m-date">' . $application_period . '</p>';
                    }
                    ?>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">選考期日</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 選考期日
                      $selection_date = get_field('選考期日');
                      if ($selection_date) {
                        echo $selection_date;
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">合格発表</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 合格発表
                      $announcement_date = get_field('合格発表');
                      if ($announcement_date) {
                        echo $announcement_date;
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">入学手続日と納付金</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 入学手続日と納付金
                      $enrollment_procedure = get_field('入学手続日と納付金');
                      if ($enrollment_procedure) {
                        echo $enrollment_procedure;
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">（ 令和9年度 ）年間所要経費</h3>

                    <div class="p-price-table">
                      <div class="p-price-table__inner">
                        <ul class="p-price-table__list">
                          <?php
                          // acf のフィールドを取得
                          // 年間所要経費：1授業料
                          $tuition_fee = get_field('年間所要経費：1授業料');
                          if ($tuition_fee) {
                            echo '<li><span>(1)授業料</span><span>' . $tuition_fee . '円</span></li>';
                          }
                          // 年間所要経費：2教育充実費
                          $education_fee = get_field('年間所要経費：2教育充実費');
                          if ($education_fee) {
                            echo '<li><span>(2)教育充実費</span><span>' . $education_fee . '円</span></li>';
                          }
                          // 年間所要経費：3実験実習費
                          $experiment_fee = get_field('年間所要経費：3実験実習費');
                          if ($experiment_fee) {
                            echo '<li><span>(3)実験実習費</span><span>' . $experiment_fee . '円</span></li>';
                          }
                          // 年間所要経費：4育友会費
                          $association_fee = get_field('年間所要経費：4育友会費');
                          if ($association_fee) {
                            echo '<li><span>(4)育友会費</span><span>' . $association_fee . '円</span></li>';
                          }
                          ?>
                        </ul>
                        <?php
                        // acf のフィールドを取得
                        // 年間所要経費：計
                        $total_fee = get_field('年間所要経費：計');
                        if ($total_fee) {
                          echo '<div class="p-price-table__total">計 ' . $total_fee . '円</div>';
                        }
                        ?>
                      </div>
                      <div class="p-price-table__note">※年4回に分けて納入</div>
                    </div>

                    <p class="p-label-list__text pc-mgt-30 sp-mgt-30">
                      <?php
                      // acf のフィールドを取得
                      // 備考
                      $remarks = get_field('備考');
                      if ($remarks) {
                        echo $remarks;
                      }
                      ?>
                    </p>

                  </div>
                </div>
              </div>

              <div class="p-label-list__item">
                <h2 class="p-label-list__title">2次募集</h2>
                <div class="p-label-list__inner">
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">願書受付（ Ｗeｂ出願 ）</h3>
                    <?php
                    // acf のフィールドを取得
                    // 願書受付
                    // htmlタグがある場合はそのまま を出力
                    $application_period_2 = get_field('願書受付_2');
                    if ($application_period_2) {
                      echo '<p class="p-label-list__text m-date">' . $application_period_2 . '</p>';
                    }
                    ?>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">選考期日</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 選考期日
                      $selection_date_2 = get_field('選考期日_2');
                      if ($selection_date_2) {
                        echo $selection_date_2;
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">合格発表</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 合格発表
                      $announcement_date_2 = get_field('合格発表_2');
                      if ($announcement_date_2) {
                        echo '<p class="p-label-list__text">' . $announcement_date_2 . '</p>';
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">入学手続日と納付金</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 入学手続日と納付金
                      $enrollment_procedure_2 = get_field('入学手続日と納付金_2');
                      if ($enrollment_procedure_2) {
                        echo $enrollment_procedure_2;
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">（ 令和9年度 ）年間所要経費</h3>

                    <div class="p-price-table">
                      <div class="p-price-table__inner">
                        <ul class="p-price-table__list">
                          <?php
                          // acf のフィールドを取得
                          // 年間所要経費：1授業料
                          $tuition_fee_2 = get_field('年間所要経費：1授業料_2');
                          if ($tuition_fee_2) {
                            echo '<li><span>(1)授業料</span><span>' . $tuition_fee_2 . '円</span></li>';
                          }
                          // 年間所要経費：2教育充実費
                          $education_fee_2 = get_field('年間所要経費：2教育充実費_2');
                          if ($education_fee_2) {
                            echo '<li><span>(2)教育充実費</span><span>' . $education_fee_2 . '円</span></li>';
                          }
                          // 年間所要経費：3実験実習費
                          $experiment_fee_2 = get_field('年間所要経費：3実験実習費_2');
                          if ($experiment_fee_2) {
                            echo '<li><span>(3)実験実習費</span><span>' . $experiment_fee_2 . '円</span></li>';
                          }
                          // 年間所要経費：4育友会費
                          $association_fee_2 = get_field('年間所要経費：4育友会費_2');
                          if ($association_fee_2) {
                            echo '<li><span>(4)育友会費</span><span>' . $association_fee_2 . '円</span></li>';
                          }
                          ?>
                        </ul>
                        <?php
                        // acf のフィールドを取得
                        // 年間所要経費：計
                        $total_fee_2 = get_field('年間所要経費：計_2');
                        if ($total_fee_2) {
                          echo '<div class="p-price-table__total">計 ' . $total_fee_2 . '円</div>';
                        }
                        ?>
                      </div>
                      <div class="p-price-table__note">※年4回に分けて納入</div>
                    </div>

                    <p class="p-label-list__text pc-mgt-30 sp-mgt-30">
                      <?php
                      // acf のフィールドを取得
                      // 備考
                      $remarks_2 = get_field('備考_2');
                      if ($remarks_2) {
                        echo $remarks_2;
                      }
                      ?>
                    </p>

                  </div>
                </div>

              </div>
            </div>
          </section>

          <section>
            <h2 class="c-title-line pc-mgt-55 pc-mgb-25 sp-mgt-45 sp-mgb-20"><span>共通事項</span></h2>

            <div class="p-label-list">
              <div class="p-label-list__item">
                <h2 class="p-label-list__title m-type-pale">出願について</h2>
                <div class="p-label-list__inner">
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">募集人員</h3>
                    <p class="p-label-list__text">
                      <?php
                      // acf のフィールドを取得
                      // 募集人員
                      $number_of_applicants = get_field('募集人員');
                      if ($number_of_applicants) {
                        echo $number_of_applicants;
                      }
                      ?>
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">出願資格</h3>
                    <p class="p-label-list__text">
                      令和2年4月2日～<br>
                      令和3年4月1日に生まれた者
                    </p>
                  </div>
                  <div class="p-label-list__section">
                    <h3 class="p-label-list__subtitle">出願手続</h3>
                    <p class="p-label-list__text">
                      (1)入学願書（写真アップロード・現住所は住民票記載の住所）<br>
                      (2)検定料 20,000円〈銀行振込〉<br>
                      ※選考結果通知用封筒は、面接日にお渡しいたします。<br>
                      本校所定の封筒に宛先を記入し、920円分の切手を貼って選考日に提出してください<br>
                      ☆出願の仕方は本校ホームページでご案内いたします
                    </p>
                  </div>
                </div>
              </div>

              <div class="p-label-list__item">
                <h2 class="p-label-list__title m-type-pale">当日携帯品</h2>
                <div class="p-label-list__inner">
                  <div class="p-label-list__list">
                    <?php
                    // acf のフィールドを取得
                    // 当日携帯品
                    $items_to_bring = get_field('当日携帯品');
                    if ($items_to_bring) {
                      echo '<p class="p-label-list__text">' . $items_to_bring . '</p>';
                    }
                    ?>
                  </div>
                </div>
              </div>

            </div>
          </section>

          <section class="pc-mgt-20 sp-mgt-20">
            <div class="p-info-box">
              <div class="p-info-box__head">学費・制度</div>
              <div class="p-info-box__inner">
                <h3 class="p-info-box__title">ファミリー奨学金制度（専願者）</h3>
                <?php
                // acf のフィールドを取得
                // ファミリー奨学金制度（専願者）
                $family_scholarship = get_field('ファミリー奨学金制度（専願者）');
                if ($family_scholarship) {
                  echo '<p class="p-info-box__text">' . $family_scholarship . '</p>';
                }
                ?>
              </div>
            </div>

            <div class="p-info-box pc-mgt-20 sp-mgt-20">
              <div class="p-info-box__inner">
                <h3 class="p-info-box__title">その他</h3>
                <?php
                // acf のフィールドを取得
                // その他
                $other_info = get_field('その他');
                if ($other_info) {
                  echo '<p class="p-info-box__text">' . $other_info . '</p>';
                }
                ?>
              </div>
            </div>
          </section>

          <?php /*
            <div class="p-admission-child__pdf pc-mgt-30 sp-mgt-30">
              <a href="<?php echo get_template_directory_uri(); ?>/pdf/bosyuyoko.pdf" class="c-btn-pdf" target="_blank"><span>転入・帰国児用はこちら</span></a>
            </div>
            */ ?>

          <?php
          // acf のフィールドを取得
          // 募集要項PDF
          $admission_pdf = get_field('募集要項（pdf）');
          if ($admission_pdf) {
            echo '<div class="p-admission-child__btn pc-mgt-40 sp-mgt-30"><a href="' . esc_url($admission_pdf) . '" class="c-btn c-btn--fill" target="_blank"><div class="c-btn__inner"><span>募集要項（PDF）</span></div></a></div>';
          }
          ?>

          <p class="p-admission-child__note2 pc-mgt-10 sp-mgt-10">※その他詳細は、募集要項をご覧いただくか、直接お問い合わせください。 <br class="pc-none">（<a href="tel:0798-67-2366">0798-67-2366</a>）</p>

        </div>


      </div>


      <?php get_template_part('./inc/footer'); ?>

    </main>
  </div>


</div>