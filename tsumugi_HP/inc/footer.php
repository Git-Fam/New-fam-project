<?php wp_footer(); ?>
</main>

<footer class="footer">
    <div class="footer-inner">
        <div class="footer-content">
            <div class="info">
                <div class="logo">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/main-logo.svg" alt="つむぎクリニック" />
                </div>
                <div class="address">
                    <p class="TX">〒921-8832　<br class="sp" />石川県野々市市藤平田1丁目265番</p>
                    <a class="TX hover-opa" href="tel:0762487810"> TEL：076-248-7810 </a>
                </div>
                <div class="working">
                    <img
                        src="<?php echo get_template_directory_uri(); ?>/img/footer-working.webp"
                        alt="8:45~12:00 (月,火,水,木,金) /14:00~17:15 (月,火,水,金) / 8:45~16:00 (土)"
                    />
                </div>
            </div>
            <div class="map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6412.872861325604!2d136.605966!3d36.519464!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5ff835f212a938d1%3A0xf4058abc225b53a7!2z44CSOTIxLTg4MzIg55-z5bed55yM6YeO44CF5biC5biC6Jek5bmz55Sw77yR5LiB55uu77yS77yW77yV!5e0!3m2!1sja!2sjp!4v1762693649892!5m2!1sja!2sjp"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </div>
        <nav class="footer-nav">
            <div class="footer-nav-menu">
                <ul class="lists">
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>">
                            <div class="icon"></div>
                            <p class="TX">TOPページ</p>
                        </a>
                        <ul>
                            <li>
                                <a class="hover-opa" href="<?php echo home_url(); ?>#medical_care_guidance">
                                    <p class="TX">診療案内</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="<?php echo home_url(); ?>#medical_care_schedule">
                                    <p class="TX">診療日程</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="<?php echo home_url(); ?>#medical_care_reserve">
                                    <p class="TX">ご予約</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="<?php echo home_url(); ?>#medical_care_first-users">
                                    <p class="TX">はじめての方</p>
                                </a>
                            </li>
                            <li>
                                <a class="hover-opa" href="<?php echo home_url(); ?>#medical_care_access">
                                    <p class="TX">アクセス</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="lists">
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/about">
                            <div class="icon"></div>
                            <p class="TX">つむぎクリニックについて</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/guidance">
                            <div class="icon"></div>
                            <p class="TX">入院案内</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/faq">
                            <div class="icon"></div>
                            <p class="TX">よくある質問</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/news">
                            <div class="icon"></div>
                            <p class="TX">お知らせ</p>
                        </a>
                    </li>
                </ul>
                <ul class="lists">
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/recruit">
                            <div class="icon"></div>
                            <p class="TX">採用情報</p>
                        </a>  
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/contact">
                            <div class="icon"></div>
                            <p class="TX">お問い合わせ</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/policy">
                            <div class="icon"></div>
                            <p class="TX">プライバシーポリシー</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url(); ?>/standard">
                            <div class="icon"></div>
                            <p class="TX">施設基準</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="footer-nav-sns">
                <ul>
                    <li>
                        <a
                            class="hover-opa"
                            href="https://www.instagram.com/tsumugi7810/"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img src="<?php echo get_template_directory_uri(); ?>/img/insta-icon.svg" alt="Instagram" />
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="http://" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/line-icon.svg" alt="LINE" />
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="footer-txt">
            <p class="TX">© TSUMUGI CLINIC Co. Ltd. All Rights Reserved.</p>
            <div class="img fade-note"></div>
        </div>
    </div>
    <a class="top-back-btn hover-opa" href="#"></a>
    <a
        class="reserve-btn hover-opa"
        href="https://yoyaku.atlink.jp/tsumugiclinic/login?t=1762677858"
        target="_blank"
        rel="noopener noreferrer"
    >
        <img src="<?php echo get_template_directory_uri(); ?>/img/reserve-tracking.webp" alt="ご予約はこちら♩" />
    </a>
</footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/joint.js"></script>
</body>

</html>