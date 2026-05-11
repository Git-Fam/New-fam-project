<?php
/*
フォーム入力画面テンプレ

@param {int} $_SESSION['token']： 持ち回り用トークン

【確認項目】
1,submitボタンの直前にhiddenで送る

*/
//必ずファイルの一番上に記述する
session_start();
$_SESSION['token'] = rtrim(base64_encode(openssl_random_pseudo_bytes(32)),'=');

//エンティティ変換関数
function h($str){
return htmlspecialchars($str,ENT_QUOTES,'utf-8');
}
?>

 
  <!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="description" content= "SMILE CALL（スマイルコール）はスマートフォン、タブレット端末、PCを利用したテレビ電話型の多言語通訳サービスアプリです。英語・中国語・韓国語・スペイン語・ポルトガル語の5言語を、日本国内のコールセンターから高い通信品質・接続率で、24時間365日通訳いたします。">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="/smile-call/assets/css/app.css">
<title>SMILE CALL（スマイルコール）｜多言語通訳サービスアプリ</title>
<!-- Global site tag (gtag.js) - Google Analytics -->

<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-119171128-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-119171128-1');
</script>

<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-140432516-2>"></script>
<script>
window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
ga('create', 'UA-140432516-2', 'auto', {'name': 'myTracker'});
ga('myTracker.send', 'pageview');
</script>

<!-- 測定ツール BowNow -->
<script id="_bownow_ts">
var _bownow_ts = document.createElement('script');
_bownow_ts.charset = 'utf-8';
_bownow_ts.src = 'https://contents.bownow.jp/js/UTC_6483aebef2c7c42a01e8/trace.js';
document.getElementsByTagName('head')[0].appendChild(_bownow_ts);
</script>

</head>
<body>
<div class="l-wrap">

<header>
  <div class="l-header__inner">

    <nav class="l-menu clearfix u-hide-overHeader">
      <div class="c-menu1"></div>
      <div class="c-menu2"></div>
      <div class="c-menu3"></div>
      <p class="c-menuTxt">MENU</p>
    </nav>

    <div class="l-header__leftItem">
      <h1><a href="#"><img src="/smile-call/assets/img/logo.png" alt="SMILECALL"></a></h1>
      <ul class="u-hide-underHeader">
        <li><a href="#p-top-firstView__content">スマイルコールとは</a></li>
        <li><a href="#p-top-characteristic">サービスの特徴</a></li>
        <li><a href="#p-top-example">導入例</a></li>
        <li><a href="#p-top-performance">導入実績</a></li>
        <li><a href="#p-top-flow">ご利用までの流れ</a></li>
        <li><a href="#p-top-price">料金プラン</a></li>
      </ul>
    </div>

    <div class="l-header__leftItem u-hide-overHeader">
      <ul id="l-menu">
        <li><a href="#p-top-firstView__content">スマイルコールとは</a></li>
        <li><a href="#p-top-characteristic">サービスの特徴</a></li>
        <li><a href="#p-top-example">導入例</a></li>
        <li><a href="#p-top-performance">導入実績</a></li>
        <li><a href="#p-top-flow">ご利用までの流れ</a></li>
        <li><a href="#p-top-price">料金プラン</a></li>
      </ul>
    </div>

    <div class="l-header__rightItem">
      <a href="tel:0120881676" class="l-header__rightItem--tel">
        <p>お電話での<br class="u-hide-overHeader">お問い合わせ</p>
        <p class="u-hide-underHeader">0120-881-676</p>
      </a>
      <a href="#p-top-form" class="l-header__rightItem--mail">WEBでの<br class="u-hide-overSp">お問い合わせ</a>
    </div>
  </div>
</header>
      <div class="p-top-container">

        <div class="p-top-firstView">
          <div class="p-top-firstView__container">
            <div class="p-top-firstView__inner">
              <p><img src="/smile-call/assets/img/img_fv_band_sp.png" class="u-hide-overSp" alt=""></p>
              <p><img src="/smile-call/assets/img/img_fv_band.png" alt=""></p>
              <p>通訳サービスがタブレット・スマート<br class="u-hide-over780 u-hide-underSp">フォンから<br class="u-hide-underMore">利用可能。スタッフを抱え<br class="u-hide-over780 u-hide-underSp">ないから大幅コストダウン！</p>
              <p>24時間365日、<br>コトバの壁を<br>サポートいたします。</p>
              <p><img src="/smile-call/assets/img/icon_fv_logo.png" alt=""></p>
            </div>
          </div>

          <div class="p-top-firstView-sp u-pc-dn"><img src="/smile-call/assets/img/bg_fv_lady_sp.png" alt=""></div>

          <div class="p-top-firstView__content" id="p-top-firstView__content">
            <p>2020年の東京オリンピックを控え海外からの観光客は年々増加しており、どの業種でも避けては通れない言語の壁があると思います。<br class="u-hide-underSp">トラブルは事前予想することができず、いつ発生するかわかりません。サービスの向上・トラブル時対応に最適なサービスになります。150名体制でお客様からの通訳依頼をお待ちしております。</p>
            <p>スマイルコールとは</p>
            <p>スマートフォン、タブレット端末、<br class="u-hide-overMore">PCを利用した多言語通訳サービス</p>
            <p>ワンタッチで英語・中国語・韓国語・スペイン語・ポルトガル語のオペレーターが登場し、通訳でサポートします。外国人旅行者の約93％が話す英・中・韓の3言語を含む、計5つの言語を日本国内のコールセンターから高い通信品質・接続率で、365日通訳いたします。</p>
            <p></p>
          </div>
        </div>

        <div class="p-top-firstView-moreContent">
          <div class="p-top-firstView-moreContent__inner">
            <p class="p-top-firstView-moreContent__ttl">対応言語</p>
            <div class="p-top-firstView-moreContent__correspondence">
              <ul>
                <li>
                  <dl>
                    <dt>英語</dt>
                    <dd><img src="/smile-call/assets/img/icon_moreContent_en.png" alt="英語"></dd>
                  </dl>
                </li>
                <li>
                  <dl>
                    <dt>韓国語</dt>
                    <dd><img src="/smile-call/assets/img/icon_moreContent_co.png" alt="韓国語"></dd>
                  </dl>
                </li>
                <li>
                  <dl>
                    <dt>中国語</dt>
                    <dd><img src="/smile-call/assets/img/icon_moreContent_cn.png" alt="中国語"></dd>
                  </dl>
                </li>
                <li>
                  <dl>
                    <dt>スペイン語</dt>
                    <dd><img src="/smile-call/assets/img/icon_moreContent_sp.png" alt="スペイン語"></dd>
                  </dl>
                </li>
                <li>
                  <dl>
                    <dt>ポルトガル語</dt>
                    <dd><img src="/smile-call/assets/img/icon_moreContent_po.png" alt="ポルトガル語"></dd>
                  </dl>
                </li>
              </ul>
            </div>

            <p class="p-top-firstView-moreContent__ttl">通訳選択方法</p>
            <div class="p-top-firstView-moreContent__howTo">
              <div class="p-top-firstView-moreContent__howTo--item">
                <p class="p-top-firstView-moreContent__howTo--img"><img src="/smile-call/assets/img/img_fv_step01_new.png" alt=""></p>
                <p class="u-ff-Note_mid p-top-firstView-moreContent__howTo--step01">通訳したい言語をワンタッチ選択</p>
              </div>
              <div class="p-top-firstView-moreContent__howTo--item">
                <p class="p-top-firstView-moreContent__howTo--img"><img src="/smile-call/assets/img/img_fv_step02_new.png" alt=""></p>
                <p class="u-ff-Note_mid p-top-firstView-moreContent__howTo--step02">オペレーターが通訳をして<br>お客様をサポートします</p>
              </div>
            </div>
          </div>
        </div>

        <div class="p-top-merit" id="p-top-merit">
          <div class="p-top-merit__inner">
            <p class="p-top-merit__Ttl">スマイルコール導入の</p>
            <p class="p-top-merit__emphasisTtl"><span class="p-top-merit__marker--sp"><span>3</span><span>大</span>メリット</span></p>

            <ul class="p-top-merit__merit-list">
              <li><img src="/smile-call/assets/img/icon_merit_01.png" alt="01"><br>
              外国人の採用・教育まで<br><strong>工数削減</strong></li>
              <li><img src="/smile-call/assets/img/icon_merit_02.png" alt="02"><br>
              質の高いオペレーター<span class="u-dib">と翻訳で</span><br><strong>企業様サービスの向上</strong></li>
              <li><img src="/smile-call/assets/img/icon_merit_03.png" alt="03"><br>
              スタッフの管理不要、<br>退職の<strong>リスク０</strong></li>
            </ul>

            <p class="p-top-merit__subTtl">2年連続、接続率99％以上・<br class="  u-hide-overSp">通話開始まで10秒以内保証！</p>
          </div>

          <ul class="p-top-merit__detail">
            <li>
              <p>導入はしたけれど繋がらなければ意味がない。SmileCallは緊急トラブル、クレーム対応も勿論、お客様の店舗販売など様々な場面で使用頂いております。その中で使いたいときに繋がらない。そんなサービスでは導入する意味がない。その為、 お客様の満足度の指針の一つとして接続率を重要視し、日時で数値管理、シフト管理を行いサービス改善を行っております。</p>
              <div><img src="/smile-call/assets/img/img-7675.png" alt=""></div>
            </li>
            <li>
              <p>また、実際にお客様と通訳するのは、オペレーターの方です。そのためオペレーターの方には、その会社の社員としての立ち居振る舞いが求められます。そのため、採用基準を厳格に設け、ただ単純に言語が上手なだけでなく、お客様の求める笑顔であったり、コミュニケーションの教育を徹底しております。オペレーターの満足度の向上こそサービスの品質だと思っています。</p>
              <div><img src="/smile-call/assets/img/img-7869.png" alt=""></div>
            </li>
          </ul>
        </div>

        <div class="p-top-characteristic" id="p-top-characteristic">
          <div class="p-top-characteristic__inner">
            <p class="c-top-sectionTtl">スマイルコールの特徴</p>
            <div class="p-top-characteristic__flex">
              <div class="p-top-characteristic__item p-top-characteristic__item01">
                <p class="p-top-characteristic__item--ttl">接続率95%以上を保証</p>
                <p class="p-top-characteristic__item--txt">2015年は接続率100%達成。また、2016年は接続率99.2％を達成。2017年も接続率99%以上を推移しております。</p>
              </div>

              <div class="p-top-characteristic__item p-top-characteristic__item02">
                <p class="p-top-characteristic__item--ttl">通訳開始まで10秒以内を保証</p>
                <p class="p-top-characteristic__item--txt">とっさのニーズにも迅速に対応します。ボタンのプッシュから3.5秒での通話スタートを目標に、毎週1回、秒数を集計し、改善に努めています。</p>
              </div>

              <div class="p-top-characteristic__item p-top-characteristic__item03">
                <p class="p-top-characteristic__item--ttl">コールセンターは日本国内のみ</p>
                <p class="p-top-characteristic__item--txt">通訳スタッフは全て日本国内に拠点を置くコールセンターに常駐。安心・高品質な日本語への通訳が可能です。また、万が一コールセンターでトラブルが起こった場合も迅速な対応を行います。</p>
              </div>

              <div class="p-top-characteristic__item p-top-characteristic__item04">
                <p class="p-top-characteristic__item--ttl">導入研修を実施</p>
                <p class="p-top-characteristic__item--txt">導入時に、弊社の社員を派遣し導入研修を実施。実際に外国人エキストラも同行して実演を行うことで、現場スタッフの皆さまのサービス理解をサポートします。<br>＊有料サービスになります</p>
              </div>

              <div class="p-top-characteristic__item p-top-characteristic__item05">
                <p class="p-top-characteristic__item--ttl">通話ログレポートのご提供</p>
                <p class="p-top-characteristic__item--txt">必要に応じて一定期間の通話レポートを発行。対応の好例の確認や、外国人旅行者の細かなニーズ把握などが可能になります。<br>＊有料サービスになります</p>
              </div>

              <div class="p-top-characteristic__item p-top-characteristic__item06">
                <p class="p-top-characteristic__item--ttl">毎日のサポートコール</p>
                <p class="p-top-characteristic__item--txt">システム担当が常駐し、すべてのお客様の利用状況を毎日チェック。不具合がある端末を見つけ次第、こちらからサポートのお電話をさせていただきます。</p>
              </div>
            </div>
          </div>
        </div>

        <div class="p-top-example" id="p-top-example">
          <div class="p-top-example__inner">
            <p class="c-top-sectionTtl">導入例</p>
            <div class="p-top-example__content">
              <video controls poster="/smile-call/assets/img/movie-thum.jpg">
                <source src="/smile-call/assets/img/video.mp4">
                <p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
              </video>
            </div>
          </div>
        </div>

        <div class="p-top-performance" id="p-top-performance">
          <div class="p-top-performance__inner">
            <p class="c-top-sectionTtl">導入実績</p>
            <div class="p-top-performance__content">
              <p><img src="/smile-call/assets/img/icon_company/icon_company_01.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_02.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_03.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_04.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_05.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_06.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_07.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_08.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_09.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_10.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_11.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_12.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_13.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_14.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_15.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_16.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_17.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_18.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_19.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_20.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_21.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_22.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_23.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_24.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_25.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_26.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_27.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_28.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_29.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_30.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_31.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_32.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_33.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_34.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_35.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_36.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_37.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_38.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_39.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_40.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_41.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_42.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_43.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_44.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_45.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_46.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_47.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_48.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_49.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_50.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_51.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_52.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_53.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_54.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_55.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_56.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_57.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_58.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_59.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_60.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_61.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_62.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_63.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_64.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_65.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_66.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_67.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_68.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_69.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_70.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_71.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_72.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_73.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_74.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_75.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_76.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_77.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_78.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_79.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_80.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_81.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_82.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_83.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_84.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_85.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_86.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_87.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_88.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_89.png" alt=""></p>
              <p><img src="/smile-call/assets/img/icon_company/icon_company_dummy.png" alt=""></p>
            </div>
          </div>
        </div>

        <div class="p-top-flow" id="p-top-flow">
          <div class="p-top-flow__inner">
            <p class="p-top-flow__Ttl">サービスご利用までの流れ</p>
            <p class="p-top-flow__emphasisTtl">最短<span>3</span>日（弊社営業日）にて<br class="u-hide-overMore">ご利用いただけます！</p>
            <div class="p-top-flow__content">
              <ul class="p-top-flow__step">
                <li class="p-top-flow__stepList c-stepList-after">
                  <div class="p-top-flow__stepList--spWrap">
                    <p class="p-top-flow__stepList--icon"><img src="/smile-call/assets/img/icon_step_01.png" alt="step_01"></p>
                    <p class="p-top-flow__stepList--ttl">お申し込み</p>
                  </div>
                  <p class="p-top-flow__stepList--txt">お電話か<a href="#p-top-form">お問い合わせフォーム</a>にてお問い合わせください。折り返し営業担当からご連絡させていただきます。</p>
                </li>
                <li class="p-top-flow__stepList c-stepList-after">
                  <div class="p-top-flow__stepList--spWrap">
                    <p class="p-top-flow__stepList--icon"><img src="/smile-call/assets/img/icon_step_02.png" alt="step_02"></p>
                    <p class="p-top-flow__stepList--ttl">アカウントの発行</p>
                  </div>
                  <p class="p-top-flow__stepList--txt">ご連絡先にアカウント情報を送ります。</p>
                </li>
                <li class="p-top-flow__stepList c-stepList-after">
                  <div class="p-top-flow__stepList--spWrap">
                    <p class="p-top-flow__stepList--icon"><img src="/smile-call/assets/img/icon_step_03.png" alt="step_03"></p>
                    <p class="p-top-flow__stepList--ttl">セットアップ</p>
                  </div>
                  <p class="p-top-flow__stepList--txt">専用アプリケーションのセットアップ方法をご案内致します。</p>
                </li>
                <li class="p-top-flow__stepList c-stepList-after">
                  <div class="p-top-flow__stepList--spWrap">
                    <p class="p-top-flow__stepList--icon"><img src="/smile-call/assets/img/icon_step_04.png" alt="step_04"></p>
                    <p class="p-top-flow__stepList--ttl">ご利用開始</p>
                  </div>
                  <p class="p-top-flow__stepList--txt">セットアップ完了後、すぐにお使いいただけます。</p>
                </li>
                <li class="p-top-flow__stepList">
                  <div class="p-top-flow__stepList--spWrap">
                    <p class="p-top-flow__stepList--icon"><img src="/smile-call/assets/img/icon_step_05.png" alt="step_05"></p>
                    <p class="p-top-flow__stepList--ttl">初回料金の<br class="u-hide-underMore">お支払い</p>
                  </div>
                  <p class="p-top-flow__stepList--txt">銀行振込にて初回料金をお支払いください。</p>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="p-top-price" id="p-top-price">
          <div class="p-top-price__inner">
            <p class="p-top-price__Ttl">1アカウントあたりの<br class="u-hide-overSp">料金プラン</p>
            <p class="p-top-price__emphasisTtl"><span class="p-top-price__marker--sp"><span>1</span>週間<span>無料</span></span><br class="u-hide-overMore"><span class="p-top-price__marker--sp">トライアルキャンペーン</span></p>
            <div class="p-top-price__content">
              <table>
                <tbody>
                  <tr>
                    <th class="p-top-price__table--plan"></th>
                    <td class="p-top-price__table--plan"><span>30分プラン</span></td>
                    <td class="p-top-price__table--plan"><span>60分プラン</span></td>
                  </tr>
                  <tr>
                    <th class="p-top-price__table--ttl">月額</th>
                    <td class="p-top-price__table--data"><span>¥14,000-</span></td>
                    <td class="p-top-price__table--data"><span>¥24,000-</span></td>
                  </tr>
                  <tr>
                    <th class="p-top-price__table--ttl">対応可能<br class="u-hide-overSp">時間</th>
                    <td class="p-top-price__table--data"><span>24時間対応</span></td>
                    <td class="p-top-price__table--data"><span>24時間対応</span></td>
                  </tr>
                  <tr>
                    <th class="p-top-price__table--ttl">利用時間</th>
                    <td class="p-top-price__table--data"><span>30分/月</span></td>
                    <td class="p-top-price__table--data"><span>60分/月</span></td>
                  </tr>
                  <tr>
                    <th class="p-top-price__table--ttl">初期費用</th>
                    <td class="p-top-price__table--data"><span>¥30,000-</span></td>
                    <td class="p-top-price__table--data"><span>¥30,000-</span></td>
                  </tr>
                </tbody>
              </table>
              <div class="p-top-price__caution">
                <ul>
                  <li>契約期間は1年です</li>
                  <li>ご利用端末は別途ご用意ください</li>
                  <li>ご利用にはWi-Fiまたは電話回線（3G・LTE）でのインターネット接続が必要です</li>
                  <li>中国語は北京語のみ対応です</li>
                  <li>価格には消費税を含みません</li>
                  <li>各プランとも月額利用料は前払いです</li>
                  <li>契約時に初期＋月額利用（2ヶ月分）をお支払いただきます</li>
                  <li>30分・60分コースで時間超過した場合は、1分あたり340円となります</li>
                  <li>本サービスは、犯罪行為、条例、法令等に違反する恐れのある場合など、お客様の了承を得ることなくサービスの提供を中断、または停止する場合があります。詳しくは、利用規約をご覧ください</li>
                  <li>当社は、事業上の理由、システムの過負荷・システムの不具合・メンテナンス・法令の制定改廃・天災地変・偶発的事故・停電・通信障害・不正アクセス、その他の事由により、本サービスをいつでも変更、中断、終了することができるものとし、これによって生じた如何なる損害についても、一切責任を負いません</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="p-top-form" id="p-top-form">
          <div class="p-top-form__inner">
            <p class="c-top-sectionTtl">サービスのお申し込み・<br class="u-hide-overSp">問い合わせ</p>
            <div class="p-top-form__content">
              <form action="confirm.php" method="post" id="inquiryForm" name="inquiryForm">
              <ul>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>会社名/団体名</dt>
                    <dd><input id="inquiry_company" class="company" type="text" name="inquiry_company" placeholder="株式会社FAM" required maxlength="100"></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>氏名</dt>
                    <dd><input id="inquiry_name" class="name" type="text" name="inquiry_name" placeholder="山田　太郎" required maxlength="100"></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>電話番号</dt>
                    <dd><input id="inquiry_tel" class="tel" type="tel" name="inquiry_tel" placeholder="09000000000" required maxlength="100"></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>E-mail</dt>
                    <dd><input id="inquiry_email" class="email" type="email" name="inquiry_email" placeholder="xxxxx@xxx.ne.jp" required maxlength="100"></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>郵便番号</dt>
                    <dd><input id="inquiry_address" class="address" type="text" name="inquiry_address" placeholder="0000000" required maxlength="100"></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>都道府県</dt>
                    <dd><label class="inquiry_prefectures">
                      <select name="inquiry_prefectures" class="prefectures-input">
                        <option value="" selected="selected">選択してください</option>
                        <option value="北海道">北海道</option>
                        <option value="青森県">青森県</option>
                        <option value="岩手県">岩手県</option>
                        <option value="宮城県">宮城県</option>
                        <option value="秋田県">秋田県</option>
                        <option value="山形県">山形県</option>
                        <option value="福島県">福島県</option>
                        <option value="茨城県">茨城県</option>
                        <option value="栃木県">栃木県</option>
                        <option value="群馬県">群馬県</option>
                        <option value="埼玉県">埼玉県</option>
                        <option value="千葉県">千葉県</option>
                        <option value="東京都">東京都</option>
                        <option value="神奈川県">神奈川県</option>
                        <option value="新潟県">新潟県</option>
                        <option value="富山県">富山県</option>
                        <option value="石川県">石川県</option>
                        <option value="福井県">福井県</option>
                        <option value="山梨県">山梨県</option>
                        <option value="長野県">長野県</option>
                        <option value="岐阜県">岐阜県</option>
                        <option value="静岡県">静岡県</option>
                        <option value="愛知県">愛知県</option>
                        <option value="三重県">三重県</option>
                        <option value="滋賀県">滋賀県</option>
                        <option value="京都府">京都府</option>
                        <option value="大阪府">大阪府</option>
                        <option value="兵庫県">兵庫県</option>
                        <option value="奈良県">奈良県</option>
                        <option value="和歌山県">和歌山県</option>
                        <option value="鳥取県">鳥取県</option>
                        <option value="島根県">島根県</option>
                        <option value="岡山県">岡山県</option>
                        <option value="広島県">広島県</option>
                        <option value="山口県">山口県</option>
                        <option value="徳島県">徳島県</option>
                        <option value="香川県">香川県</option>
                        <option value="愛媛県">愛媛県</option>
                        <option value="高知県">高知県</option>
                        <option value="福岡県">福岡県</option>
                        <option value="佐賀県">佐賀県</option>
                        <option value="長崎県">長崎県</option>
                        <option value="熊本県">熊本県</option>
                        <option value="大分県">大分県</option>
                        <option value="宮崎県">宮崎県</option>
                        <option value="鹿児島県">鹿児島県</option>
                        <option value="沖縄県">沖縄県</option>
                    </select></label></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>市区町村・番地</dt>
                    <dd><input id="inquiry_cities" class="cities" type="text" name="inquiry_cities" placeholder="○○区○○市　0-0-00" maxlength="100"></dd>
                  </dl>
                </li>
                <li class="p-top-form__content--list">
                  <dl>
                    <dt>建物名</dt>
                    <dd><input id="inquiry_building" class="building" type="text" name="inquiry_building" placeholder="○○○ビル　○階" maxlength="100"></dd>
                  </dl>
                </li>
              </ul>
              <div class="p-top-form__personal">
                <p class="p-top-form__personal--ttl">個人情報のお取り扱いについて</p>
                <div class="p-top-form__personalContent">
                  <div class="p-top-form__personalContent--inner">
                    <p class="p-top-form__personalContent--ttl">株式会社FAM（以下）「当社」は、販売活動を通じて得たお客様の個人情報を最重要資産の一つとして認識すると共に、以下の方針に基づき個人情報の適切な取り扱いと保護に努めることを宣言致します。</p>
                    <p class="p-top-form__personalContent--ttl">個人情報の保護に関する法令およびその他の規範を遵守し、個人情報を適正に取り扱います。</p>
                    <ul>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■個人情報の取得</dt>
                          <dd>個人情報の取得に際しては、利用目的を明確化するよう努力し、適法かつ公正な手段により行います。</dd>
                        </dl>
                      </li>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■個人情報の利用</dt>
                          <dd>取得した個人情報は、取得の際に示した利用目的もしくは、それと合理的な関連性のある範囲内で、業務の遂行上必要な限りにおいて利用します。</dd>
                        </dl>
                      </li>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■個人情報の共同利用</dt>
                          <dd>個人情報を第三者との間で共同利用し、または、個人情報の取り扱いを第三者に委託する場合には、共同利用の相手方および再三者に対し、個人情報の適正な利用を実施するための監督を行います。</dd>
                        </dl>
                      </li>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■個人情報の第三者提供</dt>
                          <dd>法令に定める場合、本サイトの運営委託会社を除き、個人情報を事前に本人の同意を得ることなく第三者に提供することはありません。</dd>
                        </dl>
                      </li>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■個人情報の管理</dt>
                          <dd>個人情報の正確性および最新性を保つよう努力し、適正な取り扱いと管理を実施するための体制を構築するとともに個人情報の紛失、改ざん、漏洩などを防止するため、必要かつ適正な情報セキュリティー対策を実施します。</dd>
                        </dl>
                      </li>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■個人情報の開示・訂正・利用停止・消去</dt>
                          <dd>個人情報に着いて、開示・訂正・利用停止・消去などの要求がある場合には、本人からの要求であることが確認できた場合に限り、法令に従って対応します。</dd>
                        </dl>
                      </li>
                      <li class="p-top-form__personalContent--list">
                        <dl>
                          <dt>■コンプライアンス・プログラムの策定</dt>
                          <dd>本個人情報保護方針を実施するため、コンプライアンス・プログラムを策定し、これを研修・教育を通じて社内に周知徹底させて実施するとともに、継続的な改善によって最良の状態を維持します。</dd>
                        </dl>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="p-top-form__personal--checkbox">
                <label>
                  <input type="checkbox" name="checkbox[]" class="checkbox-input">
                  <span class="checkbox-parts">同意する</span>
                </label>
              </div>

                <!--submitボタンの直前に記述 -->
                <input type="hidden" name="token" value="<?php echo h($_SESSION['token']); ?>">
              <p class="p-top-form__submitBtn--wrap">
                <input type="submit" value="確認画面へ" class="p-top-form__submitBtn">
              </p>
              </form>
            </div>
          </div>
        </div>



      </div>

      <footer>
<div class="l-footer__inner">
  <div>
    <a href="https://www.fam-t.co.jp/">運営会社</a>
    <a href="#p-top-form">代理店募集</a>
  </div>
  <p>&copy;2018 FAM  All rights reserved.</p>
</div>
</footer>

</div><!-- l-wrap -->
<!--[if lt IE 9]>
<script src="//api.html5media.info/1.1.8/html5media.min.js"></script>
<![endif]-->
<script src="/smile-call/assets/js/bundle.js"></script>
</body>
</html>

