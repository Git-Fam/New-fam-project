<?php

$mode        = 'mode-blue bg-gray';
$title       = "株式会社ConnectEarthが運営するインターネット光回線サービスギガ光";
$description = "株式会社ConnectEarthが運営するインターネット光回線サービスギガ光。安心充実したサポートで、高速で快適なインターネットライフをご提供します。";
$keywords    = "ギガ光,光回線,高速インターネット,格安インターネット,高速無線LAN,";
$header_style = '';

include "../inc/header.php";
include "../inc/nav.php";
?>

<div class="page-header-container page-header-container--service">
    <div class="container-fluid">
        <img src="../img/text/text-scroll-down-white.svg" alt="Scroll down" class="text-vertical">

        <div class="page-header page-header-lg">
            <h2 class="title title-lg">
                SERVICE

                <small>
                    取扱商品
                </small>
            </h2>

            <img src="../img/text/text-grow-support-white.svg" alt="ConnectEarth" width="108" class="text-img" />
        </div>
    </div>
</div>

<div class="section-single-service-container">
    <section class="single-section-service">
        <h3 class="text-img-vertical text-left">
            <img src="../img/text/text-grow-support-vertical.svg" alt="ConnectEarth" width="13" />
        </h3>

        <div class="row">
            <!-- <div class="col-sm-4 px-lg-5">
                <a href="giga-hikari" class="service-link-card service-link-card--green">
                    <img src="../img/logo-giga-hikari.svg" alt="" class="service-link-card__image">
                    <p class="service-link-card__text">ギガ光ページへ</p>
                </a>
                <h4 class="service-name service-name--green">ギガ光とは</h4>
                <p class="service-text service-text--green">下り最大2Gbpsの高速インターネット<br>無制限のWiFi +ウィルス対策も標準装備</p>
            </div> -->
            <!-- <div class="col-sm-4 px-lg-5">
                <a href="otoku-denki" class="service-link-card service-link-card--orange">
                    <img src="../img/logo-otoku-denki.svg" alt="" class="service-link-card__image">
                    <p class="service-link-card__text">おとくに電気プランページへ</p>
                </a>
                <h4 class="service-name service-name--orange">おとくに電気プランとは</h4>
                <p class="service-text service-text--orange">日々の生活に欠かせない電気料金を最大5%割引<br>電気の品質 変わらず 毎月おとく</p>
            </div> -->
            <!-- col-sm-4排除 -->
            <div class="px-lg-5">
                <a href="/service/hayatoku-wifi/" class="service-link-card service-link-card--blue">
                    <img src="../img/logo-otokuni-mobile.svg" alt="" class="service-link-card__image">
                    <p class="service-link-card__text">はやトクWi-Fiページへ</p>
                </a>
                <h4 class="service-name service-name--blue">はやトクWi-Fiとは</h4>
                <p class="service-text service-text--blue">工事不要！持ち運び可能なWiFiルーター<br>利用頻度に合わせたおトクなサービス</p>
            </div>
            <!-- <div class="px-lg-5 pt-lg-3">
                <div class="simple-service-link">
                    <h4 class="service-name service-name--dark-blue">医療サポートパック</h4>
                    <p class="service-text">医師・保健師・看護師等による健康・医療・介護・育児・メンタルヘルスの電話相談、夜間・休日の医療機関情報の情報提供・介護などシルバー情報の情報提供が受けられるサービスとなります。</p>
                    <a href="/service/medical-support-pack/" class="btn btn-dark-blue btn-block arrow-right">
                        お問い合わせ
                    </a>
                </div>

            </div> -->
        </div>
    </section>
</div>

<div class="section-contact-block-container">
    <section class="section-contact-block">
        <div class="container-fluid">
            <div class="content">
                <h4 class="title-section">
                    <span>CONTACT</span>
                    <small>お問い合わせ</small>
                </h4>
                <p class="text visible-lg visible-md">ConnectEarthに関する各種お問い合わせ・ご要望は<br>こちらのフォームをご利用ください。</p>
            </div>
            <a href="/contact/" class="link">
                <p class="link-text">
                    <span>お問い合わせへ</span>
                </p>
            </a>
            <p class="text visible-sm visible-xs">ConnectEarthに関する各種お問い合わせ・ご要望はこちらのフォームをご利用ください。</p>
        </div>
    </section>
</div>



<?php
include "../inc/footer.php";
?>