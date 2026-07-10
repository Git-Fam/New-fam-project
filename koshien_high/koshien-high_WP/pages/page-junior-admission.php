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
                <a href="https://mirai-compass.net/usr/kosiengh/common/login.jsf" target="_blank" rel="noopener noreferrer" class="aside-nav-list-item-link-sub hover-opa">WEB出願</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="https://www.go-pass.net/kosiengh/" target="_blank" rel="noopener noreferrer" class="aside-nav-list-item-link-sub hover-opa">合否照会</a>
              </li>
              <li class="aside-nav-list-item-sub">
                <a href="https://mirai-compass.net/ent/kosiengh/common/login.jsf" target="_blank" rel="noopener noreferrer" class="aside-nav-list-item-link-sub hover-opa">入学手続き</a>
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
        <div class="scholarship-item is-active">
          <div class="scholarship-tab">A日程</div>
          <div class="scholarship-contents">
            <p class="recruiting-content-TL">A日程 募集要項</p>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">募集定員</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            第1学年　女子60名
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">受験資格</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            2027年3月　小学校卒業見込みの者
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">出願期間・方法</h3>
          <div class="recruiting-item-txt">
            <div class="TX-wrap-list">
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願期間｜ </p>
                <p class="TX">2026年12月4日（金）〜<br class="sp">2027年1月15日（金）</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願方法｜ </p>
                <p class="TX">WEB出願</p>
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
                <p class="TX">受験票 / 筆記具 / 直定規（20cm程度） / 上履き（受験生･保護者共に） / 水筒 / <br>腕時計（計算や辞書機能のついているものは使用できません）</p>
              </div>
              <div class="TX-wrap flex-none">
                <p class="TX TX-ttl">時程表　 </p>

                <div class="junior-admission-schedule-table-wrap">
                  <table class="junior-admission-schedule-table">
                    <tbody>
                      <tr>
                        <td class="junior-admission-schedule-table-time">9 : 00〜</td>
                        <td class="junior-admission-schedule-table-content">集合完了<br class="sp">（保護者同伴）</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">9 : 20〜10 : 10</td>
                        <td class="junior-admission-schedule-table-content">国語</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">10 : 30〜11 : 20</td>
                        <td class="junior-admission-schedule-table-content">算数</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">11 : 30</td>
                        <td class="junior-admission-schedule-table-content">面接</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">合格発表</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            2027年1月16日（土）　※WEBで合否発表
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
                    約500,000円（下記期間中にWEB受付）<br>
                    （内訳 入学金：350,000円、制服・副教材等諸費：約150,000円）
                  </p>
                </div>
              </div>

              <div class="TL-wrap">
                <h4 class="TL">手続き期間</h4>
                <div class="TL-txt-flex">
                  <div class="TL-txt-flex-item">
                    <p class="TX">2027年1月18日（月）〜1月22日（金）</p>
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
                    <p class="TX">約180,000円</p>
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
                <p class="TX">「学力奨学金制度」「入学金免除制度」「大阪府等他府県入学者奨学金制度」「ファミリー奨学金制度」 があります。なお、2つ以上の制度を併用することはできません。
                </p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">事前に審査がありますので、お問い合わせください。
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
        </div>

        <div class="scholarship-item">
          <div class="scholarship-tab">B日程</div>
          <div class="scholarship-contents">
            <p class="recruiting-content-TL">B日程 募集要項</p>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">募集定員</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            第1学年　女子60名
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">受験資格</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            2027年3月　小学校卒業見込みの者
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">出願期間・方法</h3>
          <div class="recruiting-item-txt">
            <div class="TX-wrap-list">
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願期間｜ </p>
                <p class="TX">2026年12月4日（金）〜<br class="sp">2027年1月19日（火）</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願方法｜ </p>
                <p class="TX">WEB出願</p>
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
                <p class="TX">2027年1月20日（水）　午前9時<br class="sp">集合</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">持参品｜ </p>
                <p class="TX">受験票 / 筆記具 / 直定規（20cm程度） / 上履き（受験生･保護者共に） / 水筒 / <br>腕時計（計算や辞書機能のついているものは使用できません）</p>
              </div>
              <div class="TX-wrap flex-none">
                <p class="TX TX-ttl">時程表　 </p>

                <div class="junior-admission-schedule-table-wrap">
                  <table class="junior-admission-schedule-table">
                    <tbody>
                      <tr>
                        <td class="junior-admission-schedule-table-time">9 : 00〜</td>
                        <td class="junior-admission-schedule-table-content">集合完了<br class="sp">（保護者同伴）</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">9 : 20〜10 : 10</td>
                        <td class="junior-admission-schedule-table-content">国語</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">10 : 30〜11 : 20</td>
                        <td class="junior-admission-schedule-table-content">算数</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">11 : 30</td>
                        <td class="junior-admission-schedule-table-content">面接</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">合格発表</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            2027年1月20日（水）　※WEBで合否発表
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
                    約500,000円（下記期間中にWEB受付）<br>
                    （内訳 入学金：350,000円、制服・副教材等諸費：約150,000円）
                  </p>
                </div>
              </div>

              <div class="TL-wrap">
                <h4 class="TL">手続き期間</h4>
                <div class="TL-txt-flex">
                  <div class="TL-txt-flex-item">
                    <p class="TX">2027年1月21日（木）〜1月27日（水）</p>
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
                    <p class="TX">約180,000円</p>
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
                <p class="TX">「学力奨学金制度」「入学金免除制度」「大阪府等他府県入学者奨学金制度」「ファミリー奨学金制度」 があります。なお、2つ以上の制度を併用することはできません。
                </p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">事前に審査がありますので、お問い合わせください。
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
        </div>

        <div class="scholarship-item">
          <div class="scholarship-tab">C日程</div>
          <div class="scholarship-contents">
            <p class="recruiting-content-TL">C日程 募集要項</p>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">募集定員</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            第1学年　女子60名
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">受験資格</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            2027年3月　小学校卒業見込みの者
            </p>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">出願期間・方法</h3>
          <div class="recruiting-item-txt">
            <div class="TX-wrap-list">
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願期間｜ </p>
                <p class="TX">2026年12月4日（金）〜<br class="sp">2027年1月22日（金）</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">出願方法｜ </p>
                <p class="TX">WEB出願</p>
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
                <p class="TX">2027年1月23日（土）　午前9時<br class="sp">集合</p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">持参品｜ </p>
                <p class="TX">受験票 / 筆記具 / 直定規（20cm程度） / 上履き（受験生･保護者共に） / 水筒 / <br>腕時計（計算や辞書機能のついているものは使用できません）</p>
              </div>
              <div class="TX-wrap flex-none">
                <p class="TX TX-ttl">時程表　 </p>

                <div class="junior-admission-schedule-table-wrap">
                  <table class="junior-admission-schedule-table">
                    <tbody>
                      <tr>
                        <td class="junior-admission-schedule-table-time">9 : 00〜</td>
                        <td class="junior-admission-schedule-table-content">集合完了<br class="sp">（保護者同伴）</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">9 : 20〜10 : 10</td>
                        <td class="junior-admission-schedule-table-content">国語</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">10 : 30〜11 : 20</td>
                        <td class="junior-admission-schedule-table-content">算数</td>
                      </tr>
                      <tr>
                        <td class="junior-admission-schedule-table-time">11 : 30</td>
                        <td class="junior-admission-schedule-table-content">面接</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="recruiting-item">
          <h3 class="recruiting-item-TL">合格発表</h3>
          <div class="recruiting-item-txt">
            <p class="TX">
            2027年1月23日（土）　※WEBで合否発表
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
                    約500,000円（下記期間中にWEB受付）<br>
                    （内訳 入学金：350,000円、制服・副教材等諸費：約150,000円）
                  </p>
                </div>
              </div>

              <div class="TL-wrap">
                <h4 class="TL">手続き期間</h4>
                <div class="TL-txt-flex">
                  <div class="TL-txt-flex-item">
                    <p class="TX">2027年1月18日（月）〜1月29日（金）</p>
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
                    <p class="TX">約180,000円</p>
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
                <p class="TX">「学力奨学金制度」「入学金免除制度」「大阪府等他府県入学者奨学金制度」「ファミリー奨学金制度」 があります。なお、2つ以上の制度を併用することはできません。
                </p>
              </div>
              <div class="TX-wrap">
                <p class="TX TX-ttl">・</p>
                <p class="TX">事前に審査がありますので、お問い合わせください。
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
        </div>
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
        <div class="scholarship-item is-active">
          <div class="scholarship-tab">学力特待生制度</div>
          <div class="scholarship-contents">
            <div class="scholarship-contents-item">
              <h3 class="ttl">学力特待生制度①</h3>
              <p class="TX">
                下記の公開模試において偏差値60以上で、かつA・Bいずれかの日程で受験し、入学する場合、審査の上、入学金ならびに中学校3年間の授業料を全額免除します。
              </p>
              <div class="img-wrap">
                <div class="img">
                  <div class="img-text">
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX">対象となる模試：五ツ木・駸々堂模試等、受験人数が1000名以上の2026年度11月までに実施の模試。</p>
                    </div>
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX">国語・算数の合計平均偏差値が60以上。</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="scholarship-contents-item">
              <h3 class="ttl">学力特待生制度②</h3>
              <p class="TX">
                下記の公開模試において偏差値50以上で、かつA・Bいずれかの日程で受験し、入学する場合、入学金を全額免除します。
              </p>
              <div class="img-wrap">
                <div class="img">
                  <div class="img-text">
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX">対象となる模試：五ツ木・駸々堂模試等、受験人数が1000名以上の2026年度11月までに実施の模試。</p>
                    </div>
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX">国語・算数の合計平均偏差値が50以上。</p>
                    </div>
                  </div>
                </div>
              </div>
              <p class="TX TX-point">
                ※①、②ともに事前に審査があります。ご希望の方は、できるだけ早く本校にお問い合わせください。
              </p>
            </div>
          </div>
        </div>
        <div class="scholarship-item">
          <div class="scholarship-tab">入学金免除制度</div>
          <div class="scholarship-contents">
            <div class="scholarship-contents-item">
              <h3 class="ttl">入学金免除制度</h3>
              <p class="TX">
              本校が指定するスポーツや吹奏楽、芸術・芸能などで一芸に秀で、中高6年間クラブ活動等で必ず継続して、その技能を磨く強い意思があり、かつAもしくはB日程で受験し、入学する場合、入学金を全額免除されるなどの奨学金制度が適用されます。
              </p>
            </div>
            <div class="scholarship-contents-item">
              <p class="TX TX-point">
                ※事前に審査があります。ご希望の方は、できるだけ早く本校にお問い合わせください。 
              </p>
            </div>
          </div>
        </div>
        <div class="scholarship-item">
          <div class="scholarship-tab">大阪府等他府県入学者<br class="pc">奨学金制度</div>
          <div class="scholarship-contents">
            <div class="scholarship-contents-item">
              <h3 class="ttl">大阪府等他府県入学者奨学金制度</h3>
              <p class="TX">
              2027年度入学試験出願時において、兵庫県以外の在住者が試験に合格した場合、入学金の半額（175,000円）を奨学金として支給します。
              </p>
            </div>
          </div>
        </div>
        <div class="scholarship-item">
          <div class="scholarship-tab">ファミリー奨学金制度</div>
          <div class="scholarship-contents">
            <div class="scholarship-contents-item">
              <h3 class="ttl">ファミリー奨学金制度</h3>
              <p class="TX">
              A・B・Cいずれかの日程で合格し、入学した者のうち、下記のどちらかの条件に当てはまる場合、入学後10万円が奨学金として支給されます。ただし、上記の制度の適用者は除きます。
              </p>
              <div class="img-wrap">
                <div class="img">
                  <div class="img-text">
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX">父母兄弟姉妹、受験生自身が、甲子園学院の幼稚園・小学校・中学校・高等学校・短期大学・大学のいずれかに 在籍、ま たは卒業（卒園）している。</p>
                    </div>
                    <div class="TX-wrap">
                      <p class="TX TX-ttl">・</p>
                      <p class="TX">2027年度（令和9年度）、父母兄弟姉妹が、甲子園学院の幼稚園・小学校・中学校・高等学校・短期大学・大学のいずれかに入学（入園）する。</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-01-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-01-pc.svg" alt="WEB出願">
            </picture>
          </div>
          <div class="hov">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-01-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-01-pc.svg" alt="WEB出願">
            </picture>
          </div>
        </a>
        <a href="https://www.go-pass.net/kosiengj/" target="_blank" rel="noopener noreferrer" class="">
          <div class="defo">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-02-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-02-pc.svg" alt="合否照会">
            </picture>
          </div>
          <div class="hov">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-02-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-02-pc.svg" alt="合否照会">
            </picture>
          </div>
        </a>
        <a href="https://mirai-compass.net/ent/kosiengj/common/login.jsf" target="_blank" rel="noopener noreferrer" class="">
          <div class="defo">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-03-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-defo-03-pc.svg" alt="入学手続き">
            </picture>
          </div>
          <div class="hov">
            <picture>
              <source srcset="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-03-sp.svg" media="(max-width: 767px)">
              <img src="<?php echo get_template_directory_uri(); ?>/img/junior-admission/junior-admission-student-btn-hov-03-pc.svg" alt="入学手続き">
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
