<?php
/*
Template Name: company
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="company_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/company/company_kv-bg-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/company/company_kv-bg.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/company/company_kv-ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/company/company_kv-ttl.svg" alt="COMPANT PROFILE / 会社概要・沿革">
      </picture>

    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_company">

    <section id="company_sec_01" class="company_type_section company_type_video">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-01.svg" alt="01"></p>
              <h3 class="TL">紹介動画</h3>
            </div>
            <p class="TX">PROMOTION VIDEO</p>
          </div>
        </div>
        <div class="company_sec s-pop">
          <div class="video_area">
            <img id="video_open" src="<?php echo get_template_directory_uri(); ?>/img/company/mov_thumb.webp">
            <div class="video_area_fixed">
              <div class="video_area_fixed_bg video_close"></div>
              <div class="close_btn video_close">
                <img src="<?php echo get_template_directory_uri(); ?>/img/company/close_btn.svg">
              </div>
              <div class="video_area_fixed_inner">
                <video class="video" id="video" src="<?php echo get_template_directory_uri(); ?>/img/company/company-video.mp4" muted controls></video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="company_sec_02" class="company_type_section company_type-color">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-02.svg" alt="02"></p>
              <h3 class="TL">会社概要</h3>
            </div>
            <p class="TX">COMPANY PROFILE</p>
          </div>
        </div>
        <div class="company_sec s-pop">
          <div class="table_area">
            <div class="C_table">
              <ul class="C_table_list">
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      会社名
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      オフロム株式会社
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      所在地
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      〒910-3608<br>
                      福井県福井市三留町72字10番地（みとめ工業団地）
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      TEL
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      （0776）98-3800
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      FAX
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      （0776）98-3598
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      E-mail
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      ofrom.co.ltd@ofrom.com
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      設立
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      1983年5月20日（昭和58年）
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      資本金
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      2,000万円
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      決算期
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      12月
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      従業員数
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      96名
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      代表者
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      代表取締役社長 笈田寿宏
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      土地概況
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      土地<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>13,275㎡（4,015坪）<br>
                      建物<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>5,168㎡（1,563坪）内訳<br>
                      管理棟<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>853㎡（258坪）<br>
                      工場<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>2,071㎡（626坪）<br>
                      倉庫<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>2,244㎡（679坪）<br>
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      主要取引先
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      <a class="underline" href="https://www.optexgroup.co.jp/" target="_blank"
                        rel="noopener noreferrer">オプテックスグループ株式会社</a><br>
                      <a class="underline" href="https://www.mfg.optexgroup.co.jp/" target="_blank"
                        rel="noopener noreferrer">オプテックス・エムエフジー株式会社</a>
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      取引銀行
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      北陸銀行 福井支店<br>
                      商工組合中央金庫 福井支店<br>
                      福井銀行 清水町支店<br>
                      日本政策金融公庫 福井支店
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      関連企業
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      <a class="underline" href="https://www.liverock-tech.com/" target="_blank"
                        rel="noopener noreferrer">ライブロックテクノロジーズ株式会社</a>
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="company_sec_03" class="company_type_section">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-03.svg" alt="03"></p>
              <h3 class="TL">沿革</h3>
            </div>
            <p class="TX">HISTORY</p>
          </div>
        </div>
        <div class="company_sec s-pop">
          <div class="table_area">
            <div class="C_table">
              <ul class="C_table_list no-wrap">
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1983年5月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      福井市にてオフロム株式会社を設立、セキュリティ用センサを主に製造を始める
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1983年8月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      ワイヤレス方式の来客(侵入)<br class="sp">検知システムの製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1984年8月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      自動ドア用センサの製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1985年10月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      非接触温度計の製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1987年1月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      清水町に本社・工場を新築・移転、光電スイッチの製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1988年3月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      工場を増築（第2期工事完成）
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1988年7月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      自動照明機器(センサライト)の<br class="sp">製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1991年2月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      流通センターを増築<br class="sp">（第3期工事完成）
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1994年10月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      小電力方式によるワイヤレス・セキュリティシステムの製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1994年12月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      品質管理システムISO9002を<br class="sp">認証取得
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1996年10月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      資本金を2,000万円に増資
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1997年5月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      環境管理システムISO14001を<br class="sp">認証取得
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1997年10月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      生産治工具、検査機器の<br class="sp">社内生産開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1998年7月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      変位計（レーザ、LED）の製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      1999年10月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      情報関連機器の<br class="sp">製造開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2000年8月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      クリーンルームを設置、<br class="sp">液晶関連機器の製造開始<br class="sp">(第4期工事完成)
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2003年10月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      品質管理システムISO9001を<br class="sp">認証取得
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2006年4月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      BPR活動開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2007年11月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      シリコンチューナーモジュール<br class="sp">”クレーム０”にて100万台生産達成表彰を受賞
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2008年2月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      3D CAD導入
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2010年2月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      マイクロソルダリング技術検定制度(1級)導入
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2011年4月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      自動化推進プロジェクト開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2014年8月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      中国向け製品輸出開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2015年1月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      ライブロックテクノロジーズ<br class="sp">株式会社と業務提携
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2015年5月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      新基幹業務システム運用開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2017年4月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      改善プロジェクトⅢ開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2018年1月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      防湿材_自動塗布機(自社開発品)導入
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2019年1月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      3D_AOI導入
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2019年4月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      きづきプロジェクト活動開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2020年1月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      D改善プロジェクト開始
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2021年1月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      フレキシブル後付治具(自社開発品)導入
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2022年6月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      X線リールカウンター導入
                    </p>
                  </div>
                </li>
                <li class="item">
                  <div class="ttl">
                    <h4 class="TL">
                      2022年9月
                    </h4>
                  </div>
                  <div class="txt">
                    <p class="TX">
                      新規実装ライン導入
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="company_sec_04" class="company_type_section company_type-color">
      <div class="other_sec_inner">
        <div class="sec_ttl s-pop">
          <div class="C_item-ttl">
            <div class="ttl">
              <p class="num"><img src="<?php echo get_template_directory_uri(); ?>/img/common/C_item-ttl-num-04.svg" alt="04"></p>
              <h3 class="TL">アクセス</h3>
            </div>
            <p class="TX">access</p>
          </div>
        </div>
        <div class="company_sec s-pop">
          <div class="map_area">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3226.170646227722!2d136.156837!3d36.040541000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5ff8b90561c40455%3A0x8a1f65a6d043b7e8!2z44Kq44OV44Ot44Og77yI5qCq77yJ!5e0!3m2!1sja!2sjp!4v1771915478622!5m2!1sja!2sjp"
              style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <div class="sent_area">
            <div class="ttl">
              <h4 class="TL">当社までの交通案内</h4>
            </div>
            <div class="txt_wrap">
              <div class="txt">
                <h4 class="TL">・車でお越しの場合</h4>
                <p class="TX">
                  金沢方面からは、<br class="sp">北陸自動車道「福井IC」より約40分<br>
                  京都・滋賀・名古屋方面からは、<br class="sp">北陸自動車道「鯖江IC」より約30分
                </p>
              </div>
              <div class="txt">
                <h4 class="TL">・電車でお越しの場合</h4>
                <p class="TX">
                  JR福井駅より、タクシーにて約20分
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>