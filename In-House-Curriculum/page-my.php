<?php
// 現在ログインしているユーザーのIDを取得
$user_id = get_current_user_id();

// ユーザーのメタデータの値を取得。デフォルト値は0。
// Div
$div01_value = get_user_meta($user_id, 'div01', true) ?: '0';
$div02_value = get_user_meta($user_id, 'div02', true) ?: '0';
$div03_value = get_user_meta($user_id, 'div03', true) ?: '0';
$div04_value = get_user_meta($user_id, 'div04', true) ?: '0';
$div05_value = get_user_meta($user_id, 'div05', true) ?: '0';
$div06_value = get_user_meta($user_id, 'div06', true) ?: '0';
$div07_value = get_user_meta($user_id, 'div07', true) ?: '0';
$responsive_value = get_user_meta($user_id, 'responsive', true) ?: '0';

// JQ
$JQ01_value = get_user_meta($user_id, 'JQ01', true) ?: '0';
$JQ02_value = get_user_meta($user_id, 'JQ02', true) ?: '0';
$JQ03_value = get_user_meta($user_id, 'JQ03', true) ?: '0';
$JQ04_value = get_user_meta($user_id, 'JQ04', true) ?: '0';
$JQ05_value = get_user_meta($user_id, 'JQ05', true) ?: '0';
$JQ06_value = get_user_meta($user_id, 'JQ06', true) ?: '0';
$JQ07_value = get_user_meta($user_id, 'JQ07', true) ?: '0';
$JQ08_value = get_user_meta($user_id, 'JQ08', true) ?: '0';
$JQ09_value = get_user_meta($user_id, 'JQ09', true) ?: '0';
$JQ10_value = get_user_meta($user_id, 'JQ10', true) ?: '0';
$JQLast_value = get_user_meta($user_id, 'JQLast', true) ?: '0';

// LP
$LP01_value = get_user_meta($user_id, 'LP01', true) ?: '0';

// Sass
$Sass01_value = get_user_meta($user_id, 'Sass01', true) ?: '0';

// Form
$Form01_value = get_user_meta($user_id, 'Form01', true) ?: '0';

// FAM
$FAM01_value = get_user_meta($user_id, 'FAM01', true) ?: '0';

// test
$test01_value = get_user_meta($user_id, 'test01', true) ?: '0';

// JS
$JS01_value = get_user_meta($user_id, 'JS01', true) ?: '0';

// WP
$WP01_value = get_user_meta($user_id, 'WP01', true) ?: '0';

// SEO
$SEO01_value = get_user_meta($user_id, 'SEO01', true) ?: '0';


?>

<?php get_header(); ?>
<!-- page-my -->
<div class="my">
    <div class="my--inner">
        <div class="my--title">
            <div class="my--title--title">
                <h2 class="TL">マイページ</h2>
            </div>
            <div class="my--title--name">
                <p class="TX">
                    <!-- ユーザーネーム -->
                    <?php
                    $current_user = wp_get_current_user();
                    echo $current_user->user_login;
                    ?>
                </p>
            </div>
            <div class="C_character">
                <dotlottie-player src="https://lottie.host/e60cec2b-65a9-4722-99fa-d9218781a66b/TBEXhkebbF.json" background="transparent" speed="1" style="width: 100%; height: 100%;" loop autoplay></dotlottie-player>
            </div>
        </div>

        <div class="my--info">
            <div class="bbs">
                <div class="chicken">
                    <div class="chicken--serif">
                        <p class="TX">新着のお知らせがあるよ！</p>
                    </div>
                    <div class="chicken--bird">
                        <iframe src="https://lottie.host/embed/421d3b3d-d381-49ba-b751-5d7dc96c02c8/XLrfuoTBb0.json"></iframe>
                    </div>
                </div>
                <div class="bbs--content">
                    <div class="title">
                        <h2 class="TL">お知らせ</h2>
                    </div>
                    <ul class="sentence">
                        <?php
                        $news_query = new WP_Query(array(
                            'post_type' => 'news',
                            'posts_per_page' => 5, // 表示する投稿数
                        ));
                        if ($news_query->have_posts()) :
                            while ($news_query->have_posts()) : $news_query->the_post();
                        ?>
                                <li>
                                    <p class="time"><?php echo get_the_date('Y.m.d'); ?></p>
                                    <p class="text"><?php the_title(); ?></p>
                                </li>
                            <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            ?>
                            <li>
                                <p class="text">お知らせはありません。</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <div class="spy">
                <div class="mole">
                    <iframe src="https://lottie.host/embed/b4994f66-3673-48c5-a9f8-a2dc72b38c6e/eWk4vLyDMj.json"></iframe>
                </div>
                <div class="spy--text">
                    <div class="spy--text--serif">
                        <p class="TX">今週の表彰者が発表されたよ！</p>
                    </div>
                    <div class="spy--text--column">
                        <a href="<?php bloginfo('url'); ?>/column" target="_blank" rel="noopener noreferrer">コラムを見に行く ▶</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="info_button sp">
            <p class="TX">
                お知らせ
            </p>
        </div>

        <div class="my--content">
            <div class="pageClip">
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
                <div class="item"></div>
            </div>
            <div class="my--content--container">
                <div class="my--content--page page--1"></div>
                <div class="my--content--page page--2"></div>
                <div class="my--content--page page--3"></div>
                <div class="tab tab--1 active">
                    <div class="tabGray"></div>
                    <p class="TX">
                        <span class="TX-span">進</span>
                        <span class="TX-span">捗</span>
                        <span class="TX-span">更</span>
                        <span class="TX-span">新</span>
                    </p>
                </div>
                <div class="tab tab--2">
                    <div class="tabGray"></div>
                    <p class="TX">
                        <span class="TX-span">会</span>
                        <span class="TX-span">員</span>
                        <span class="TX-span">情</span>
                        <span class="TX-span">報</span>
                    </p>
                </div>
                <div class="gorilla"></div>

                <div class="tab--content">
                    <!-- 進捗更新 -->
                    <div class="tab--content--progress active">
                        <!-- ログイン中のみ表示 -->
                        <?php if (is_user_logged_in()): ?>
                            <!--                                     <form class="progress" action="/registered" method="post"> -->
                            <form class="progress" action="/test-hp-2/registered" method="post">

                                <div class="progress--content">

                                    <!-- HTML -->
                                    <div class="item active">
                                        <div class="progress--title">
                                            <h3 class="TL">HTML</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div04_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div05_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div06_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>DIVパズル07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($div07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="div07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($div07_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>responsive</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($responsive_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="responsive" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($responsive_value); ?>" />
                                            </div>

                                        </div>
                                    </div>

                                    <!-- JQuery -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">JQuery</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery01</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ01_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery02</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ02_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ02" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ02_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery03</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ03_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ03" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ03_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery04</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ04_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ04" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ04_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery05</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ05_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ05" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ05_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery06</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ06_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ06" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ06_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery07</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ07_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ07" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ07_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery08</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ08_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ08" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ08_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery09</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ09_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ09" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ09_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery10</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQ10_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQ10" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQ10_value); ?>" />
                                            </div>

                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JQuery最終課題</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JQLast_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JQLast" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JQLast_value); ?>" />
                                            </div>

                                        </div>
                                    </div>

                                    <!-- LP -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">LP</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>LP</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($LP01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="LP01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($LP01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sass -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Sass</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Sass</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Sass01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Sass01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Sass01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Form</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Form</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($Form01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="Form01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($Form01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- FAM -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">FAM</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>FAM</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($FAM01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="FAM01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($FAM01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- test -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">test</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>test</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($test01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="test01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($test01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- JavaScript -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">JavaScript</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>JavaScript</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($JS01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="JS01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($JS01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Word Press -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">Word Press</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>Word Press</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($WP01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="WP01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($WP01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SEO -->
                                    <div class="item">
                                        <div class="progress--title">
                                            <h3 class="TL">SEO</h3>
                                        </div>
                                        <div class="progress--update">
                                            <div class="update--item">
                                                <div class="update--item--title">
                                                    <p class="TX"><span class="deco"></span>SEO</p>
                                                    <p class="count"><output class="count" id="value"><?php echo esc_attr($SEO01_value); ?></output>%</p>
                                                </div>
                                                <input class="progressBar" id="pi_input" name="SEO01" type="range" min="0" max="100" step="1" value="<?php echo esc_attr($SEO01_value); ?>" />
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress--TOC">
                                    <ul class="progress--TOC--ul">
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX active">・HTML</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・jQuery</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・LP</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Sass</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Form</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・FAM</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・test</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・JavaScript</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・Word Press</p>
                                        </li>
                                        <li class="progress--TOC--ul--li">
                                            <p class="TX">・SEO</p>
                                        </li>
                                    </ul>
                                </div>

                                <div class="progress--submit">
                                    <input type="submit" value="更新">
                                </div>

                            </form>
                        <?php endif; ?>
                        <!-- ログインしていない時に表示する文字 -->
                        <?php if (!is_user_logged_in()): ?>
                            <p class="TX">ログインしていません。</p>
                        <?php endif; ?>
                    </div>
                    <!-- 会員情報 -->
                    <div class="tab--content--membership">
                        <?php echo do_shortcode('[swpm_profile_form]'); ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- ログイン中のみ表示 -->
        <?php if (is_user_logged_in()): ?>
            <a class="curriculum--btn" href="<?php bloginfo('url'); ?>/curriculum" target="_blank" rel="noopener noreferrer">
                <p class="TX">カリキュラム<br>一覧</p>
            </a>
        <?php endif; ?>

    </div>
</div>

<?php get_footer(); ?>