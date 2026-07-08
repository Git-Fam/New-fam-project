<?php
/*
Template Name: 入試情報（高校）
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<main class="page page--high-admission page--high-all">

  <section class="high-admission-kv">
    <div class="high-admission-kv-bg">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-kv-bg-sp.webp" media="(max-width:767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-kv-bg-pc.webp" alt="">
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
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">学力特待生制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">運動部/文化部奨学金制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">大阪府等他府県入学者<br>奨学金制度</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">ファミリー奨学金制度</a>
              </li>
            </ul>
          </li>
          <li class="aside-nav-list-item">
            <a href="#student" class="aside-nav-list-item-link hover-opa">受験生のみなさまへ</a>
            <ul class="aside-nav-list-sub pc">
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">WEB出願</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">合否照会</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="#" class="aside-nav-list-item-link-sub hover-opa">入学手続き</a>
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
          <div class="high-admission-sec-ttl-bg"></div>
          <h2 class="TL">生徒募集要項</h2>
        </div>
      </div>
      <div class="high-admission-recruiting-inr js-fade">
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">募集コース募集定員</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
              プレミアムステージ 女子80名<br>
              スタンダードステージ 女子200名
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">受験資格</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
              2027年3月中学校卒業見込みの者及び中学校を卒業した者
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">出願期間・方法</h3>
          <div class="recruiting-item-txt">
            <div class="TX-wrap-list">
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願期間｜ </p>
                <p class="TX">2027年1月16日（金）〜<br class="sp">1月23日（金）</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願方法｜ </p>
                <p class="TX">WEB出願</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">必要書類｜ </p>
                <p class="TX">調査書（中学校作成用紙）</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">入学試験受験料｜ </p>
                <p class="TX">20,000円（WEB受付）</p>
              </div>
            </div>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">入学試験について</h3>
          <div class="recruiting-item-txt">
            <div class="TX-wrap-list">
              <div class="TX-wrap">
                <p class="TX TX-ttl">試験日｜ </p>
                <p class="TX">2027年1月16日（土）　午前9時<br class="sp">集合</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">持参品｜ </p>
                <p class="TX">受験票 / 筆記具 / 上履き / 弁当 / 腕時計（計算や辞書機能のついているものは使用できません）</p>
              </div>
              <div class="TX-wrap flex-none">
                <p class="TX TX-ttl">時程表　 </p>
                <p class="TX table-img">
                  <picture>
                    <source srcset="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-recruiting-table-sp.svg" media="(max-width:767px)">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-recruiting-table-pc.svg" alt="時程表">
                  </picture>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">合格発表</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
              2027年2月11日（木・祝） WEB上で合否発表<br>
              ※電話等による問い合わせには一切応じられません。
            </p>
          </div>
        </div>
        <div class="recruiting-item pd-r-sp">
          <h3 class="recruiting-item-TL">入学金手続き納付金について</h3>
          <div class="recruiting-item-txt">
            <div class="TL-wrap-list">

              <div class="TL-wrap">
                <h4 class="TL">納付金</h4>
                <div class="TL-txt">
                  <p class="TX">
                    約550,000円（下記期間中にWEB受付）<br>
                    （内訳 入学金：350,000円、制服・教科書・宿泊研修費等諸費：約200,000円）
                  </p>
                </div>
              </div>

              <div class="TL-wrap">
                <h4 class="TL">手続き期間</h4>
                <div class="TL-txt-flex">
                  <div class="TL-txt-flex-item">
                    <p class="TX TX-ttl">専願者：</p>
                    <p class="TX">2027年2月12日（金）〜2月16日（火）<br>招集日2月21日（土）</p>
                  </div>
                  <div class="TL-txt-flex-item">
                    <p class="TX TX-ttl">併願者：</p>
                    <p class="TX">2027年2月12日（金）〜3月23日（火）<br>招集日3月24日（水）</p>
                  </div>
                </div>
              </div>

              <div class="TL-wrap">
                <h4 class="TL">2026年度納付金（予定）</h4>
                <div class="TL-txt-flex">
                  <div class="TL-txt-flex-item">
                    <p class="TX TX-ttl">入学後の納付金（授業料等）：</p>
                    <p class="TX">約700,000円<br class="sp">（年4回で分納）</p>
                  </div>
                  <div class="TL-txt-flex-item">
                    <p class="TX TX-ttl">諸費・行事費・夏用制服等：</p>
                    <p class="TX">約85,000円</p>
                  </div>
                  <div class="TL-txt-flex-item">
                    <p class="TX TX-ttl">修学旅行費：</p>
                    <p class="TX">約210,000円（年5回で積立）</p>
                  </div>
                  <div class="TL-txt-flex-item">
                    <p class="TX TX-ttl">教育振興基金（任意）：</p>
                    <p class="TX">一口30,000円</p>
                  </div>
                </div>
              </div>

              <div class="TL-wrap">
                <div class="TL-txt">
                  <p class="TX">
                    ※いったん納入された納付金は、いかなる理由が生じても返還いたしません。<br>
                    ※招集日（制服採寸）2月20日（土）
                  </p>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">その他</h3>
          <div class="recruiting-item-txt">
            <div class="TX-wrap-list">
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">「学力奨学金制度」「部活動奨学金制度【運動部・文化部】」「大阪府等他府県入学者奨学金制度」「ファミリー奨学金制度」 があります。なお、2つ以上の制度を併用することはできません。
                </p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">詳細については<a class="hover-opa" href="#">高等学校奨学金制度</a>のページをご覧ください。</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">試験内容や結果についてのお問い合わせには、一切応じられませんのでご了承ください。</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">本学院中学校から高等学校へ内部進学する際には、入学金（350,000円）は免除されます。</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="scholarship" class="high-admission-scholarship">
      <div class="high-admission-scholarship-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <div class="high-admission-sec-ttl-bg"></div>
          <h2 class="TL">奨学金制度</h2>
        </div>
      </div>
      <div class="high-admission-scholarship-inr js-fade">

        <div class="scholarship-item">
          <div class="scholarship-tab">学力特待生制度</div>
          <div class="scholarship-contents">
            <div class="scholarship-contents-item">
              <h3 class="ttl">運動部奨学金制度</h3>
              <p class="TX">
                下記の公開模試において偏差値60以上で、かつA・Bいずれかの日程で受験し、入学する場合、審査の上、入学金ならびに中学校3年間の授業料を全額免除します。
              </p>
              <div class="img">
                <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-scholarship-img-01.svg" alt="運動部奨学金制度">
              </div>
            </div>
            <div class="scholarship-contents-item">
              <h3 class="ttl">文化部奨学金制度</h3>
              <p class="TX">
                下記の公開模試において偏差値50以上で、かつA・Bいずれかの日程で受験し、入学する場合、入学金を全額免除します。
              </p>
              <div class="img">
                <img src="<?php echo get_template_directory_uri(); ?>/img/high-admission/high-admission-scholarship-img-02.svg" alt="文化部奨学金制度">
              </div>
              <p class="TX TX-point">
                ※①、②ともに事前に審査があります。<br>
                　ご希望の方は、できるだけ早く本校にお問い合わせください。
              </p>
            </div>
          </div>
        </div>



      </div>
    </section>


    <section id="student" class="high-admission-student">
      <div class="high-admission-student-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <div class="high-admission-sec-ttl-bg"></div>
          <h2 class="TL">受験生のみなさまへ</h2>
        </div>
      </div>
      <div class="high-admission-student-inr"></div>
    </section>


    <section id="faq" class="high-admission-faq">
      <div class="high-admission-faq-ttl">
        <div class="high-admission-sec-ttl js-fade">
          <div class="high-admission-sec-ttl-bg"></div>
          <h2 class="TL">Q&A</h2>
        </div>
      </div>
      <div class="high-admission-faq-inr"></div>
    </section>

  </div>
</main>


<?php get_template_part('./inc/footer'); ?>