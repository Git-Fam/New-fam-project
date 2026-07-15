<?php
/*
Template Name: 入試情報（中学）
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--junior-admission page--high-admission page--high-all">

  <section class="high-admission-kv">
    <div class="high-admission-kv-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-kv-bg-sp.webp" media="(max-width:767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-kv-bg-pc.webp" alt="">
      </picture>
    </div>
    <div class="high-admission-kv-ttl">
      <h2 class="TL js-fade">
        </picture>
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-kv-ttl.svg" alt="入試情報">
      </h2>
    </div>
  </section>

  <aside class="high-admission-aside">
    <div class="high-admission-aside-inner">
      <div class="aside-ttl pc">ADMISSION</div>
      <nav class="aside-nav">
        <ul class="aside-nav-list">
          <li class="aside-nav-list-item">
            <a href="#" class="aside-nav-list-item-link hover-opa">入試情報トップ</a>
          </li>
          <li class="aside-nav-list-item">
            <a href="#recruiting" class="aside-nav-list-item-link hover-opa">生徒募集要項</a>
          </li>
          <li class="aside-nav-list-item">
            <a href="#scholarship" class="aside-nav-list-item-link hover-opa">奨学金制度</a>
            <ul class="aside-nav-list-sub pc">
              <li class="aside-nav-list-item-sub">
                <a href="#scholarship" class="aside-nav-list-item-link-sub hover-opa">学力特待生制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#scholarship" class="aside-nav-list-item-link-sub hover-opa">入学金免除制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#scholarship" class="aside-nav-list-item-link-sub hover-opa">大阪府等他府県入学者<br>奨学金制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#scholarship" class="aside-nav-list-item-link-sub hover-opa">ファミリー奨学金制度</a>
              </li>
            </ul>
          </li>
          <li class="aside-nav-list-item">
            <a href="#student" class="aside-nav-list-item-link hover-opa">受験生のみなさまへ</a>
            <ul class="aside-nav-list-sub pc">
              <li class="aside-nav-list-item-sub">
                <a href="https://mirai-compass.net/usr/kosiengj/common/login.jsf" target="_blank" rel="noopener noreferrer" class="aside-nav-list-item-link-sub hover-opa">WEB出願</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="https://www.go-pass.net/kosiengj/" target="_blank" rel="noopener noreferrer" class="aside-nav-list-item-link-sub hover-opa">合否照会</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="https://mirai-compass.net/ent/kosiengj/common/login.jsf" target="_blank" rel="noopener noreferrer" class="aside-nav-list-item-link-sub hover-opa">入学手続き</a>
              </li>
            </ul>
          </li>
          <li class="aside-nav-list-item">
            <a href="#faq" class="aside-nav-list-item-link hover-opa">Q&A</a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="page--high-admission-contents-wrap">

    <section id="recruiting" class="high-admission-recruiting">
      <div class="high-admission-recruiting-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <h2 class="TL"><picture>
            <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-recruiting-ttl-sp.webp" media="(max-width:767px)">
            <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-recruiting-ttl-pc.webp" alt="生徒募集要項">
          </picture></h2>
        </div>
      </div>

      <div class="high-admission-recruiting-inr js-fade">
        <?php
        // SCFから日程グループを取得
        $schedules = class_exists('SCF') ? SCF::get('日程グループ') : array();
        
        if (!empty($schedules)) :
          foreach ($schedules as $index => $sch) :
            $is_active = ($index === 0) ? ' is-active' : '';
        ?>
        <div class="scholarship-item<?php echo $is_active; ?>">
          <div class="scholarship-tab"><?php echo esc_html($sch['nyushi_tab']); ?></div>
          <div class="scholarship-contents">
            <p class="recruiting-content-TL"><?php echo esc_html($sch['nyushi_title']); ?></p>

            <!-- 募集定員 -->
            <?php if (!empty($sch['nyushi_capacity'])) : ?>
            <div class="recruiting-item">
              <h3 class="recruiting-item-TL">募集定員</h3>
              <div class="recruiting-item-txt">
                <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_capacity'])); ?></p>
              </div>
            </div>
            <?php endif; ?>

            <!-- 受験資格 -->
            <?php if (!empty($sch['nyushi_qualification'])) : ?>
            <div class="recruiting-item">
              <h3 class="recruiting-item-TL">受験資格</h3>
              <div class="recruiting-item-txt">
                <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_qualification'])); ?></p>
              </div>
            </div>
            <?php endif; ?>

            <!-- 出願期間・方法 -->
            <?php if (!empty($sch['nyushi_period']) || !empty($sch['nyushi_method'])) : ?>
            <div class="recruiting-item">
              <h3 class="recruiting-item-TL">出願期間・方法</h3>
              <div class="recruiting-item-txt">
                <div class="TX-wrap-list">
                  <?php if (!empty($sch['nyushi_period'])) : ?>
                  <div class="TX-wrap">
                    <p class="TX TX-ttl">出願期間｜ </p>
                    <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_period'])); ?></p>
                  </div>
                  <?php endif; ?>
                  <?php if (!empty($sch['nyushi_method'])) : ?>
                  <div class="TX-wrap">
                    <p class="TX TX-ttl">出願方法｜ </p>
                    <p class="TX"><?php echo esc_html($sch['nyushi_method']); ?></p>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <!-- 入学試験について（試験日・持参品・時程表） -->
            <?php if (!empty($sch['nyushi_examdate']) || !empty($sch['nyushi_items']) || !empty($sch['nyushi_sch1_time'])) : ?>
            <div class="recruiting-item">
              <h3 class="recruiting-item-TL">入学試験について</h3>
              <div class="recruiting-item-txt">
                <div class="TX-wrap-list">
                  <?php if (!empty($sch['nyushi_examdate'])) : ?>
                  <div class="TX-wrap">
                    <p class="TX TX-ttl">試験日｜ </p>
                    <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_examdate'])); ?></p>
                  </div>
                  <?php endif; ?>
                  <?php if (!empty($sch['nyushi_items'])) : ?>
                  <div class="TX-wrap">
                    <p class="TX TX-ttl">持参品｜ </p>
                    <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_items'])); ?></p>
                  </div>
                  <?php endif; ?>

                  <!-- 時程表 -->
                  <?php if (!empty($sch['nyushi_sch1_time'])) : ?>
                  <div class="TX-wrap flex-none">
                    <p class="TX TX-ttl">時程表　 </p>
                    <div class="junior-admission-schedule-table-wrap">
                      <table class="junior-admission-schedule-table">
                        <tbody>
                          <?php for ($i = 1; $i <= 6; $i++) :
                            $time = !empty($sch['nyushi_sch' . $i . '_time']) ? $sch['nyushi_sch' . $i . '_time'] : '';
                            $content = !empty($sch['nyushi_sch' . $i . '_content']) ? $sch['nyushi_sch' . $i . '_content'] : '';
                            if (!$time && !$content) continue;
                          ?>
                          <tr>
                            <td class="junior-admission-schedule-table-time"><?php echo esc_html($time); ?></td>
                            <td class="junior-admission-schedule-table-content"><?php echo nl2br(esc_html($content)); ?></td>
                          </tr>
                          <?php endfor; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>

            <!-- 合格発表 -->
            <?php if (!empty($sch['nyushi_result'])) : ?>
            <div class="recruiting-item">
              <h3 class="recruiting-item-TL">合格発表</h3>
              <div class="recruiting-item-txt">
                <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_result'])); ?></p>
              </div>
            </div>
            <?php endif; ?>

            <!-- 入学金手続き納付金 -->
            <?php if (!empty($sch['nyushi_payment']) || !empty($sch['nyushi_procedure']) || !empty($sch['nyushi_payment2'])) : ?>
            <div class="recruiting-item pd-r-sp">
              <h3 class="recruiting-item-TL">入学金手続き納付金について</h3>
              <div class="recruiting-item-txt">
                <div class="TL-wrap-list">

                  <?php if (!empty($sch['nyushi_payment'])) : ?>
                  <div class="TL-wrap">
                    <h4 class="TL">納付金</h4>
                    <div class="TL-txt">
                      <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_payment'])); ?></p>
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if (!empty($sch['nyushi_procedure'])) : ?>
                  <div class="TL-wrap">
                    <h4 class="TL">手続き期間</h4>
                    <div class="TL-txt-flex">
                      <div class="TL-txt-flex-item">
                        <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_procedure'])); ?></p>
                      </div>
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if (!empty($sch['nyushi_payment2'])) : ?>
                  <div class="TL-wrap">
                    <h4 class="TL">2026年度納付金（予定）</h4>
                    <div class="TL-txt">
                      <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_payment2'])); ?></p>
                    </div>
                  </div>
                  <?php endif; ?>

                  <?php if (!empty($sch['nyushi_note'])) : ?>
                  <div class="TL-wrap">
                    <div class="TL-txt">
                      <p class="TX"><?php echo nl2br(esc_html($sch['nyushi_note'])); ?></p>
                    </div>
                  </div>
                  <?php endif; ?>

                </div>
              </div>
            </div>
            <?php endif; ?>

            <!-- その他 -->
            <?php if (!empty($sch['nyushi_other'])) : ?>
            <div class="recruiting-item">
              <h3 class="recruiting-item-TL">その他</h3>
              <div class="recruiting-item-txt">
                <div class="TX-wrap-list">
                  <?php
                  $lines = preg_split('/\r\n|\r|\n/', $sch['nyushi_other']);
                  foreach ($lines as $line) :
                    $line = trim($line);
                    if ($line === '') continue;
                  ?>
                  <div class="TX-wrap">
                    <p class="TX TX-ttl">・</p>
                    <p class="TX"><?php echo esc_html($line); ?></p>
                  </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php endif; ?>

          </div>
        </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
    </section>


    

    <section id="scholarship" class="high-admission-scholarship">
      <div class="high-admission-scholarship-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <h2 class="TL">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-scholarship-ttl-sp.webp" media="(max-width:767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-scholarship-ttl-pc.webp" alt="奨学金制度">
            </picture>
          </h2>
        </div>
      </div>
      <div class="high-admission-scholarship-inr js-fade">
        <?php
        $scholarships = class_exists('SCF') ? SCF::get('奨学金グループ') : array();
        if (!empty($scholarships)) :
          foreach ($scholarships as $index => $sc) :
            $is_active = ($index === 0) ? ' is-active' : '';
        ?>
        <div class="scholarship-item<?php echo $is_active; ?>">
          <div class="scholarship-tab"><?php echo esc_html($sc['scholar_tab']); ?></div>
          <div class="scholarship-contents">

            <!-- 制度1 -->
            <?php if (!empty($sc['scholar_title1'])) : ?>
            <div class="scholarship-contents-item">
              <h3 class="ttl"><?php echo esc_html($sc['scholar_title1']); ?></h3>
              <?php if (!empty($sc['scholar_text1'])) : ?>
              <p class="TX"><?php echo nl2br(esc_html($sc['scholar_text1'])); ?></p>
              <?php endif; ?>

              <?php if (!empty($sc['scholar_note1'])) : ?>
              <div class="img-wrap">
                <div class="img">
                  <div class="img-text">
                    <?php
                    $notes1 = preg_split('/\r\n|\r|\n/', $sc['scholar_note1']);
                    foreach ($notes1 as $note) :
                      $note = trim($note);
                      if ($note === '') continue;
                    ?>
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX"><?php echo esc_html($note); ?></p>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <?php
              // 制度2が無い場合、※印はここに表示
              if (empty($sc['scholar_title2']) && !empty($sc['scholar_point'])) :
              ?>
              <p class="TX TX-point"><?php echo nl2br(esc_html($sc['scholar_point'])); ?></p>
              <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- 制度2 -->
            <?php if (!empty($sc['scholar_title2'])) : ?>
            <div class="scholarship-contents-item">
              <h3 class="ttl"><?php echo esc_html($sc['scholar_title2']); ?></h3>
              <?php if (!empty($sc['scholar_text2'])) : ?>
              <p class="TX"><?php echo nl2br(esc_html($sc['scholar_text2'])); ?></p>
              <?php endif; ?>

              <?php if (!empty($sc['scholar_note2'])) : ?>
              <div class="img-wrap">
                <div class="img">
                  <div class="img-text">
                    <?php
                    $notes2 = preg_split('/\r\n|\r|\n/', $sc['scholar_note2']);
                    foreach ($notes2 as $note) :
                      $note = trim($note);
                      if ($note === '') continue;
                    ?>
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX"><?php echo esc_html($note); ?></p>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <?php if (!empty($sc['scholar_point'])) : ?>
              <p class="TX TX-point"><?php echo nl2br(esc_html($sc['scholar_point'])); ?></p>
              <?php endif; ?>
            </div>
            <?php endif; ?>

          </div>
        </div>
        <?php
          endforeach;
        endif;
        ?>
      </div>
      <!-- <div class="igh-admission-scholarship-point js-fade">
        <p class="TX">
          ※上記の各制度を2つ以上併用することはできません。また、「運動部奨学金制度」ならびに「文化部奨学金制度」については、定員があります。
        </p>
        <p class="TX">
          ※奨学金制度については、成績や出席状況•生活態度等を進級時に審査し、条件を満たさない場合は、制度の無効とともに入学金および無効となるまでの奨学金を返金していただきます。また、自己都合による退学や転学、退部等についても同様です。
        </p>
      </div> -->
    </section>

    <section id="student" class="high-admission-student">
      <div class="high-admission-student-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <h2 class="TL">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-ttl-sp.webp" media="(max-width:767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-ttl-pc.webp" alt="受験生のみなさまへ">
            </picture>
          </h2>
        </div>
      </div>
      <div class="high-admission-student-inr js-fade">
        <a href="https://mirai-compass.net/usr/kosiengj/common/login.jsf" target="_blank" rel="noopener noreferrer" class="">
          <div class="defo">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-01-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-01-pc.webp" alt="WEB出願">
            </picture>
          </div>
          <div class="hov">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-01-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-01-pc.webp" alt="WEB出願">
            </picture>
          </div>
        </a>
        <a href="https://www.go-pass.net/kosiengj/" target="_blank" rel="noopener noreferrer" class="">
          <div class="defo">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-02-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-02-pc.webp" alt="合否照会">
            </picture>
          </div>
          <div class="hov">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-02-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-02-pc.webp" alt="合否照会">
            </picture>
          </div>
        </a>
        <a href="https://mirai-compass.net/ent/kosiengj/common/login.jsf" target="_blank" rel="noopener noreferrer" class="">
          <div class="defo">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-03-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-03-pc.webp" alt="入学手続き">
            </picture>
          </div>
          <div class="hov">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-03-sp.webp" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-03-pc.webp" alt="入学手続き">
            </picture>
          </div>
        </a>
      </div>
    </section>

    <section id="faq" class="high-admission-faq">
      <div class="high-admission-faq-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <h2 class="TL">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-faq-ttl-sp.webp" media="(max-width:767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-faq-ttl-pc.webp" alt="Q&A">
            </picture>
          </h2>
        </div>
      </div>
      <div class="high-admission-faq-inr">
        <div class="faq-item">
          <div class="item-q">
            <h3 class="TL">進路実績は？</h3>
          </div>
          <div class="item-a">
            <p class="TX">
              過去の実績は次の通りです。<br>
              ・甲子園大学<br>
              ・甲子園短期大学<br>
              ・4年制大学※<br>
              ・短期大学・専門学校<br>
              ・就職・その他<br>
              <br>
            </p>
            <p class="TX point">
              ※中央大学、関西大学、京都産業大学、近畿大学、甲南大学、龍谷大学、摂南大学、神戸学院大学、 桃山学院大学、京都外国語大学、佛教大学、神戸女学院大学、神戸女子大学、京都女子大学、甲南女子大学、 大阪音楽大学、大阪芸術大学、大阪経済大学、神奈川大学、追手門学院大学、大阪体育大学、関西外国語大学　他
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="item-q">
            <h3 class="TL">校則は?</h3>
          </div>
          <div class="item-a">
            <p class="TX">
            頭髪の染色・脱色・パーマ、化粧、運転免許取得等は禁止です。<br>
            アルバイトも禁止です（やむ得ない事情の場合、許可することがあります）。<br>
            ただし、携帯電話の校内持ち込みは許可制です。<br>
            反社会的行動等を取った場合、特別指導を行います。<br>
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="item-q">
            <h3 class="TL">進級・卒業の基準は?</h3>
          </div>
          <div class="item-a">
            <p class="TX">
            原則として年間の欠席日数が25日を超えた場合や成績が基準に達しなかった場合、進級・卒業はできません。
          </div>
        </div>
        <div class="faq-item">
          <div class="item-q">
            <h3 class="TL">食堂のメニューには<br class="sp">どんなものがある?</h3>
          </div>
          <div class="item-a">
            <p class="TX">
            日替わりランチ、オムライス、ラーメン、うどん・そばなど。<br>
            他に季節限定メニュー、アイスクリーム、ジュース、サンドウィッチ、パンもあります。<br>
            一番人気はからあげとポテトです。<br>
            </p>
          </div>
        </div>
        <div class="faq-item">
          <div class="item-q">
            <h3 class="TL">自転車通学はできる?</h3>
          </div>
          <div class="item-a">
            <p class="TX">
            本校実施の自転車安全講習会を受講した場合のみ許可します。
            </p>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>

<?php get_template_part('./inc/footer'); ?>
