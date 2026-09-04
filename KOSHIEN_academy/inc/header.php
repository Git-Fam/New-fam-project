<header class="header header-translate<?php if (is_single()): ?> header-single<?php endif; ?>">
    <div class="header-inner">
        <a class="logo hover-opa" href="<?php echo home_url(); ?>">
            <h1 class="TL">
                <img class="def" src="<?php echo get_template_directory_uri(); ?>/img/header/logo-w.svg">
                <img class="scl" src="<?php echo get_template_directory_uri(); ?>/img/header/logo.svg" alt="甲子園学院">
            </h1>
        </a>
        <div class="burger hover-opa">
            <div class="ope">
                <img class="def" src="<?php echo get_template_directory_uri(); ?>/img/header/header-ope-w.svg">
                <img class="scl" src="<?php echo get_template_directory_uri(); ?>/img/header/header-ope.svg">
            </div>
            <div class="clo">
                <img class="def" src="<?php echo get_template_directory_uri(); ?>/img/header/header-clo-w.svg">
                <img class="scl" src="<?php echo get_template_directory_uri(); ?>/img/header/header-clo.svg">
            </div>
        </div>
    </div>
    <div class="header-nav">
        <nav class="nav">
            <div class="nav-pict-links">
                <ul>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/vision'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-pict-links-01-pc.webp" alt="甲子園学院 99年ビジョンプロジェクト">
                            <p class="TX">甲子園学院 99年ビジョンプロジェクト</p>
                        </a>
                        <ul class="sub-links">
                            <li><a class="hover-opa" href="<?php echo home_url('/vision/#brand-slogan'); ?>">
                                    <p class="TX">BRAND SLOGAN</p>
                                </a></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/vision/#mission'); ?>">
                                    <p class="TX">MISSION</p>
                                </a></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/vision/#vision'); ?>">
                                    <p class="TX">VISION</p>
                                </a></li>
                            <li class="break"></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/vision/#value'); ?>">
                                    <p class="TX">VALUE</p>
                                </a></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/vision/#9tsu'); ?>">
                                    <p class="TX">9つの心</p>
                                </a></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/vision/#logo-mark'); ?>">
                                    <p class="TX">LOGO MARK CONCEPT</p>
                                </a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/about'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-pict-links-02-pc.webp" alt="甲子園学院について">
                            <p class="TX">甲子園学院について</p>
                        </a>
                        <ul class="sub-links">
                            <li><a class="hover-opa" href="<?php echo home_url('/about/#sec-spirit'); ?>">
                                    <p class="TX">建学の精神</p>
                                </a></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/about/#sec-history'); ?>">
                                    <p class="TX">沿革</p>
                                </a></li>
                            <li><a class="hover-opa" href="<?php echo home_url('/about/#sec-circle'); ?>">
                                    <p class="TX">機関誌「園の輪」</p>
                                </a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/special'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-pict-links-03-pc.webp" alt="卒業生・教職員インタビュー">
                            <p class="TX">卒業生・教職員インタビュー</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/message'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-pict-links-04-pc.webp" alt="理事長メッセージ">
                            <p class="TX">理事長メッセージ</p>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="nav-txt-links">
                <ul>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/news'); ?>">
                            <p class="TX">お知らせ</p>
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/info'); ?>">
                            <p class="TX">公開情報</p>
                        </a>
                        <?php
                        // infoページのカスタムフィールドを取得
                        $info_page = get_page_by_path('info');
                        $free_item = SCF::get('info_item', $info_page->ID);
                        ?>

                        <ul class="sub-links">
                            <?php if (!empty($free_item) && is_array($free_item)) : ?>
                                <?php foreach ($free_item as $fields) : ?>
                                    <?php if (!empty($fields['pdf_check'])) : ?>
                                        <?php $pdf_url = is_numeric($fields['pdf_file']) ? wp_get_attachment_url($fields['pdf_file']) : $fields['pdf_file']; ?>
                                        <li>
                                            <a class="hover-opa" href="<?php echo esc_url($pdf_url); ?>" target="_blank" rel="noopener noreferrer">
                                                <p class="TX"><?php echo esc_html($fields['pdf_ttl']); ?></p>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li>
                        <a class="hover-opa" href="<?php echo home_url('/donation'); ?>">
                            <p class="TX">教育振興基金への寄付のお願い</p>
                        </a>
                    </li>
                    <li class="inline-list">
                        <a class="hover-opa" href="<?php echo home_url('/art'); ?>">
                            <p class="TX">美術資料館</p>
                        </a>
                        <a class="hover-opa" href="<?php echo home_url('/access'); ?>">
                            <p class="TX access-sp">アクセス</p>
                        </a>
                    </li>
                </ul>

                <div class="nav-txt-links--recruit">
                    <a class="hover-opa" href="<?php echo home_url('/recruit'); ?>">
                        <picture>
                            <source srcset="<?php echo get_template_directory_uri(); ?>/img/header/header-recruit-pc.webp" media="(min-width: 768px)" type="image/svg+xml">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/header-recruit-sp.webp" alt="採用情報">
                        </picture>
                    </a>
                    <p class="TX sp">採用情報</p>
                </div>

                <div class="nav-txt-links--contact">
                    <a class="nav-txt-links--contact--link hover-opa" href="<?php echo home_url('/contact'); ?>">
                        <p class="TX">お問い合わせ</p>
                    </a>
                    <div class="nav-txt-links--contact--info">
                        <p class="TX">
                            〒663-8107<br>
                            兵庫県西宮市瓦林町4-25 Tel 0798-67-2100
                        </p>
                    </div>
                </div>
            </div>
        </nav>
        <div class="header-school-links">
            <nav class="header-school-links__nav">
                <ul class="header-school-links__list">
                    <li class="header-school-links__item">
                        <a class="header-school-links__anchor hover-opa" href="https://www.koshien.ac.jp/" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/school-name-h01.webp" alt="甲子園大学">
                        </a>
                    </li>
                    <li class="header-school-links__item">
                        <a class="header-school-links__anchor hover-opa" href="https://www.koshien-c.ac.jp/" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/school-name-h02.webp" alt="甲子園短期大学">
                        </a>
                    </li>
                    <li class="header-school-links__item">
                        <a class="header-school-links__anchor hover-opa" href="https://www.koshiengakuin-h.ed.jp/" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/school-name-h03.webp" alt="甲子園学院中学校・高等学校">
                        </a>
                    </li>
                    <li class="header-school-links__item">
                        <a class="header-school-links__anchor hover-opa" href="https://www.koshiengakuin-e.ed.jp/" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/school-name-h04.webp" alt="甲子園学院小学校">
                        </a>
                    </li>
                    <li class="header-school-links__item">
                        <a class="header-school-links__anchor hover-opa" href="https://www.koshiengakuin-k.ed.jp/" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/header/school-name-h05.webp" alt="甲子園学院幼稚園">
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="header-school-links__policy">
                <a class="hover-opa" href="<?php echo home_url('/policy'); ?>">
                    <p class="TX">個人情報保護方針</p>
                </a>
            </div>
        </div>
    </div>
</header>

<div class="whopper">