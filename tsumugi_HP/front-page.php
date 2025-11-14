<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<main>
<div class="top-page">
    <section class="sec_top_about">
        <div class="C_sec_ttl">
            <div class="icon icon-01"></div>
            <h3 class="TL">つむぎクリニックに<br class="sp" />ついて</h3>
        </div>
        <div class="C_top_about">
            <div class="C_top_about-inner">
                <div class="ttl">
                    <img
                        class="pc"
                        src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_about-title-pc.svg"
                        alt="わらしたちは、あなたの伴奏者"
                    />
                    <img
                        class="sp"
                        src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_about-title-sp.svg"
                        alt="わらしたちは、あなたの伴奏者"
                    />
                </div>
                <div class="txt">
                    <p class="TX">
                        私たちが大切にしている想い・考えをみなさまに少しだけお話させていただきます。
                    </p>
                </div>
                <div class="btn">
                    <a class="C_btn hover-opa" href="<?php echo home_url(); ?>/about">
                        <div class="C_btn-inner">
                            <p class="TX en">MORE</p>
                            <div class="img"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="decoration">
                <div class="deco char"></div>
                <div class="deco note fade-note"></div>
            </div>
        </div>
    </section>

    <section class="sec_top_guidance white-sec-jaggy" id="medical_care_guidance">
        <div class="C_sec_ttl">
            <div class="icon icon-02"></div>
            <h3 class="TL">診療案内</h3>
        </div>
        <div class="sec_txt">
            <p class="TX">
                妊娠・出産・育児は命がけの大イベント。<br class="pc" />
                つむぎクリニックは女性の〈こころ〉と〈からだ〉に寄り添い、あなたの「命をつむぐ」力を支えます。
            </p>
        </div>
        <div class="C_top_guidance">
            <div class="C_top_guidance-inner">
                <div class="item">
                    <div class="item-inner">
                        <div class="ttl">
                            <div class="C-title-v02">
                                <div class="icon icon-01"></div>
                                <h4 class="TL">産科</h4>
                            </div>
                        </div>
                        <div class="txt">
                            <p class="TX">
                                妊娠がわかった日から出産・産後まで、心と体の両面を支えるケアを大切にしています。お母さんとご家族に寄り添い、小さな〈いのち〉の誕生を見守ります。
                            </p>
                        </div>
                        <div class="btn">
                            <a class="C_btn type-02 hover-opa" href="<?php echo home_url(); ?>/obstetrics">
                                <div class="C_btn-inner">
                                    <p class="TX">詳細を見る</p>
                                    <div class="img"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="decoration">
                        <div class="char"></div>
                        <div class="note"></div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-inner">
                        <div class="ttl">
                            <div class="C-title-v02">
                                <div class="icon icon-02"></div>
                                <h4 class="TL">婦人科</h4>
                            </div>
                        </div>
                        <div class="txt">
                            <p class="TX">
                                子宮や卵巣の病気の検査・治療に力を入れています。妊娠を希望される方には、自然妊娠から人工授精まで一人ひとりに合った治療を一緒に考えます。
                            </p>
                        </div>
                        <div class="btn">
                            <a class="C_btn type-02 hover-opa" href="<?php echo home_url(); ?>/gynecology">
                                <div class="C_btn-inner">
                                    <p class="TX">詳細を見る</p>
                                    <div class="img"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="decoration">
                        <div class="char"></div>
                        <div class="note"></div>
                    </div>
                </div>

                <div class="item">
                    <div class="item-inner">
                        <div class="ttl">
                            <div class="C-title-v02">
                                <div class="icon icon-02"></div>
                                <h4 class="TL">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/C_KV-title-img.svg" alt="無痛分娩について" />
                                </h4>
                            </div>
                        </div>
                        <div class="txt">
                            <p class="TX">
                                痛みをただ取り除くためではなく、“より安心して前向きに出産へ臨むための選択肢”として、当院は無痛分娩を提供しています。妊娠中の不安をやわらげ、心身を整え、自分らしいお産に向けて主体的に準備できる医療でありたいと考えています。産む力と心の余裕を大切に、あなたの選択に寄り添います。
                            </p>
                        </div>
                        <div class="btn">
                            <a class="C_btn type-02 hover-opa" href="<?php echo home_url(); ?>/delivery">
                                <div class="C_btn-inner">
                                    <p class="TX">詳細を見る</p>
                                    <div class="img"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="decoration">
                        <div class="char"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sec-char">
            <div class="char-01 pc">
                <div class="char"></div>
                <div class="note fade-note"></div>
            </div>
            <div class="char-02 pc">
                <div class="char"></div>
                <div class="note fade-note"></div>
            </div>
            <div class="char-03 pc">
                <div class="char walker-char"></div>
            </div>
            <div class="char-04 sp">
                <div class="char"></div>
                <div class="note fade-note"></div>
            </div>
        </div>
    </section>

    <section class="sec_top_schedule" id="medical_care_schedule">
        <div class="C_sec_ttl">
            <div class="icon icon-03"></div>
            <h3 class="TL">診療日程</h3>
        </div>
        <div class="C_top_schedule">
            <div class="schedule-table">
                <div class="img-wrap">
                    <img
                        class="pc"
                        src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_schedule-table-pc.webp"
                        alt="8:45~12:00 (月,火,水,木,金) /14:00~17:15 (月,火,水,金) / 8:45~16:00 (土)"
                    />
                    <img
                        class="sp"
                        src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_schedule-table-sp.webp"
                        alt="8:45~12:00 (月,火,水,木,金) /14:00~17:15 (月,火,水,金) / 8:45~16:00 (土)"
                    />
                    <div class="char"></div>
                </div>
            </div>
            <div class="txt">
                <p class="TX">休診日 … 木曜午後 / 日曜 / 祝日</p>
            </div>
        </div>
        <div class="sec-char">
            <div class="char-01">
                <div class="char"></div>
                <div class="note fade-note"></div>
            </div>
        </div>
    </section>

    <section class="sec_top_reserve white-sec-jaggy" id="medical_care_reserve">
        <div class="C_sec_ttl">
            <div class="icon icon-04"></div>
            <h3 class="TL">ご予約</h3>
        </div>
        <div class="C_top_reserve">
            <div class="reserve-inner">
                <div class="txt">
                    <p class="TX">
                        WEBにてご予約を受け付けております。
                        <br class="sp" />
                        フォームよりご予約が可能です。
                        <br class="pc" />
                        24時間受付ておりますので、お気軽にご利用ください。
                        <br />
                        <span
                            >※里帰り分娩希望の方は予約前に事前にクリニックまでお電話をお願いします。</span
                        >
                    </p>
                </div>
                <div class="btn">
                    <a class="C_btn hover-opa" href="https://yoyaku.atlink.jp/tsumugiclinic/login?t=1762677858" target="_blank" rel="noopener noreferrer">
                        <div class="C_btn-inner">
                            <p class="TX">予約する</p>
                            <div class="img"></div>
                        </div>
                    </a>
                </div>
                <div class="tel-btn">
                    <div class="note"></div>
                    <a href="tel:0762487810">
                        <img class="pc" src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_tel-img-01-pc.webp" alt="0762487810" />
                        <img class="sp" src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_tel-img-01-sp.webp" alt="0762487810" />
                    </a>
                </div>
            </div>
            <div class="decoration">
                <div class="char"></div>
            </div>
        </div>
    </section>

    <section class="sec_top_first-users" id="medical_care_first-users">
        <div class="C_sec_ttl">
            <div class="icon icon-05"></div>
            <h3 class="TL">はじめての方</h3>
        </div>
        <div class="C_top_first-users">
            <div class="first-users-inner">
                <div class="txt">
                    <p class="TX">
                        ご予約完了後にWEB問診をお願いしています。<br class="pc" />
                        当クリニックにお越しする際は、「ご持参いただくもの」をご確認ください。
                    </p>
                </div>
                <div class="btn">
                    <a
                        class="C_btn hover-opa"
                        href="https://tsumugiclinic.jp/_wp/wp-content/themes/tsumugiclinic/assets/pdf/web_diagnose.pdf"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <div class="C_btn-inner">
                            <p class="TX">WEB問診について</p>
                            <div class="img"></div>
                        </div>
                    </a>
                </div>

                <div class="contents">
                    <div class="contents-ttl">
                        <h4 class="TL">ご持参いただくもの</h4>
                    </div>
                    <div class="contents-list-wrap">
                        <div class="contents-list">
                            <ul>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">健康保険証</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">基礎体温表</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">お薬手帳</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">月経周期や体調などを<br />メモしておいた手帳</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">筆記用具</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">生理用のナプキン</p>
                                </li>
                            </ul>
                        </div>

                        <div class="contents-list">
                            <div class="contents-list-txt">
                                <p class="TX">
                                    ※他の医療機関で診察を受けている方、<br
                                        class="sp"
                                    />里帰り出産の方は下記もご持参ください。
                                </p>
                            </div>
                            <ul>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">母子健康手帳</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">紹介状</p>
                                </li>
                                <li>
                                    <div class="icon">
                                        <div class="img"></div>
                                    </div>
                                    <p class="TX">検査データのコピー</p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="decoration">
                        <div class="deco char-01">
                            <div class="note fade-note"></div>
                        </div>
                        <div class="deco char-02 pc"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec_top_recruitment white-sec-jaggy">
        <div class="C_sec_ttl">
            <div class="icon icon-06"></div>
            <h3 class="TL">採用情報</h3>
        </div>
        <div class="C_top_recruitment">
            <div class="recruitment-inner">
                <div class="txt">
                    <p class="TX">
                        当クリニックで一緒に働く方を募集しております。<br class="pc" />
                        たくさんのご応募心よりお待ちしております。
                    </p>
                </div>
                <div class="btn">
                    <a class="C_btn hover-opa" href="<?php echo home_url(); ?>/recruit">
                        <div class="C_btn-inner">
                            <p class="TX">募集要項</p>
                            <div class="img"></div>
                        </div>
                    </a>
                </div>
                <div class="decoration">
                    <div class="characters">
                        <div class="char">
                            <div class="img"></div>
                            <div class="img"></div>
                            <div class="img"></div>
                        </div>
                        <div class="char">
                            <div class="img"></div>
                            <div class="img"></div>
                            <div class="img"></div>
                        </div>
                        <div class="char">
                            <div class="img"></div>
                            <div class="img"></div>
                            <div class="img"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec_top_news">
        <div class="C_sec_ttl">
            <div class="icon icon-07"></div>
            <h3 class="TL">お知らせ</h3>
        </div>
        <div class="C_top_news">
            <div class="news-contents">
                <div class="news-contents-inner">
                    <ul>
                        <?php
                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        ];
                        $news_query = new WP_Query($args);
                        if ($news_query->have_posts()):
                            while ($news_query->have_posts()):

                                $news_query->the_post();
                                $cat = get_the_category();
                                ?>
                        <li>
                            <div class="time">
                                <div class="icon"></div>
                                <p class="TX"><?php the_time('Y.m.d'); ?></p>
                            </div>
                            <div class="category">
                                <p class="TX"><?php echo $cat ? esc_html($cat[0]->name) : ''; ?></p>
                            </div>
                            <div class="ttl">
                                <h4 class="TL">
                                    <?php the_title(); ?>
                                </h4>
                            </div>
                            <a class="more-btn hover-opa" href="<?php the_permalink(); ?>">
                                <p class="TX">MORE</p>
                                <div class="img"></div>
                            </a>
                        </li>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </ul>
                </div>
                <div class="news-contents-bg">
                    <div class="bg-z bg-z-02"></div>
                    <div class="bg-z bg-z-01"></div>
                </div>
            </div>

            <div class="decoration">
                <div class="deco char-01"></div>
                <div class="deco char-02 pc"></div>
            </div>
        </div>
    </section>

    <section class="sec_top_access white-sec-jaggy" id="medical_care_access">
        <div class="C_sec_ttl">
            <div class="icon icon-08"></div>
            <h3 class="TL">アクセス</h3>
        </div>
        <div class="C_top_access">
            <div class="access-info">
                <p class="TX">〒921-8832　<br class="sp" />石川県野々市市藤平田1丁目265番</p>
                <a class="TX hover-opa" href="tel:+"> TEL：076-248-7810 </a>
            </div>
            <div class="access-contents-wrap">
                <div class="access-contents">
                    <div class="bg-z bg-z-02">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6412.872861325604!2d136.605966!3d36.519464!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5ff835f212a938d1%3A0xf4058abc225b53a7!2z44CSOTIxLTg4MzIg55-z5bed55yM6YeO44CF5biC5biC6Jek5bmz55Sw77yR5LiB55uu77yS77yW77yV!5e0!3m2!1sja!2sjp!4v1762874051825!5m2!1sja!2sjp"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                        ></iframe>
                    </div>
                    <div class="bg-z bg-z-01"></div>
                </div>

                <div class="decoration">
                    <div class="deco char-01 pc"></div>
                    <div class="deco char-02 walker-char"></div>
                </div>
            </div>
            <div class="access-link-wrap">
                <a
                    class="hover-opa"
                    href="https://www.google.com/maps/place/〒921-8832+石川県野々市市藤平田１丁目２６５/@36.519464,136.605966,16z/data=!4m6!3m5!1s0x5ff835f212a938d1:0xf4058abc225b53a7!8m2!3d36.5194635!4d136.6059655!16s%2Fg%2F11ggzc58f7?entry=ttu&g_ep=EgoyMDI1MTEwMi4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <p class="TX">Google map を開く</p>
                    <div class="arrow"></div>
                </a>
            </div>
        </div>
    </section>

    <section class="sec_top_contact">
        <div class="C_sec_ttl">
            <div class="icon icon-09"></div>
            <h3 class="TL">お問い合わせ</h3>
        </div>
        <div class="C_top_reserve C_top_contact">
            <div class="reserve-inner">
                <div class="txt">
                    <p class="TX">
                        診療予約、採用エントリー、<br class="sp" />当クリニックにご質問のある方は<br
                            class="sp"
                        />お気軽にお問い合わせください。
                    </p>
                </div>
                <div class="btn">
                    <a class="C_btn hover-opa" href="<?php echo home_url(); ?>/contact">
                        <div class="C_btn-inner">
                            <p class="TX">お問い合わせフォーム</p>
                            <div class="img"></div>
                        </div>
                    </a>
                </div>
                <div class="tel-btn">
                    <a href="tel:0762487810">
                        <img class="pc" src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_tel-img-02-pc.webp" alt="0762487810" />
                        <img class="sp" src="<?php echo get_template_directory_uri(); ?>/img/TOP/top_tel-img-02-sp.webp" alt="0762487810" />
                    </a>
                </div>
            </div>
            <div class="decoration">
                <div class="char"></div>
                <div class="char pc walker-char"></div>
            </div>
        </div>
    </section>
</div>

</main>

<?php get_template_part('./inc/footer'); ?>
