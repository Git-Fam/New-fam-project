<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}
get_header();
?>

<div class="main-menu">
    <div class="main-menu--BK"></div>

    <div class="total_title">
        <img class="TL" src="<?php echo get_template_directory_uri(); ?>/img/main-menu/main-menu_signboard_title.webp" alt="メインメニュー">
    </div>
    <div class="main-menu--inner">

        <!-- マップ -->
        <a class="menu__item__map" href="<?php echo home_url('/curriculum'); ?>">
            <div class="menu__item__map__title">
                <h2 class="TL" data-text="道のりMAP">道のりMAP</h2>
            </div>
            <div class="menu__item__map__img"></div>
            <div class="menu__item__map__text">
                <p class="TX">カリキュラムの一覧を見ることができるよ。ここからはじめよう！</p>
            </div>
        </a>
        <!-- ランキング -->
        <a class="menu__item__ranking" href="<?php echo home_url('/ranking'); ?>">
            <div class="menu__item__ranking__title">
                <h2 class="TL" data-text="ランキング">ランキング</h2>
            </div>
            <div class="menu__item__ranking__img"></div>
            <div class="menu__item__ranking__text">
                <p class="TX">ポイントやログイン日数などのランキングが見れるよ。</p>
            </div>
        </a>
        <!-- マイページ -->
        <a class="menu__item__mypage" href="<?php echo home_url('/my'); ?>">
            <div class="menu__item__mypage__title">
                <h2 class="TL" data-text="マイページ">マイページ</h2>
            </div>
            <div class="menu__item__mypage__img"></div>
            <div class="menu__item__mypage__text">
                <p class="TX">お知らせやアバターの着替え、<br class="sp">進捗管理などができるよ！<br>
                    登録情報の変更もマイページからおこなってね</p>
            </div>
        </a>
        <!-- コラム -->
        <a class="menu__item__column" href="<?php echo home_url('/column'); ?>">
            <div class="menu__item__column__title">
                <h2 class="TL" data-text="コラム">コラム</h2>
            </div>
            <div class="menu__item__column__img"></div>
            <div class="menu__item__column__text">
                <p class="TX">現役エンジニアやクリエイターのコラムが読めるよ！<br>
                    現場で活かせる豆知識やIT情報、表彰発表も！</p>
            </div>
        </a>

        <!-- チャット -->
        <a class="menu__item__chat" href="<?php echo home_url('/chat'); ?>">
            <div class="menu__item__chat__title">
                <h2 class="TL" data-text="チャット">チャット</h2>
            </div>
            <div class="menu__item__chat__text">
                <p class="TX">進捗の近い仲間同士での<br>
                    グループチャット！</p>
            </div>
        </a>
        <!-- 質問広場 -->
        <a class="menu__item__qa" href="<?php echo home_url('/question'); ?>">
            <div class="menu__item__qa__cover"></div>
            <div class="menu__item__qa__title">
                <h2 class="TL" data-text="質問広場">質問広場</h2>
            </div>
            <div class="menu__item__qa__text">
                <p class="TX">質問の投稿に現役エンジニア・クリエイターが回答するよ。わからないことがあれば聞いてみよう！</p>
                <div class="menu__item__qa__text__deco">
                    <div class="deco"></div>
                    <div class="deco"></div>
                </div>
            </div>
        </a>
        <!-- ミニゲーム -->
        <a class="menu__item__minigame" href="<?php echo home_url('/game'); ?>">
            <div class="menu__item__minigame__title">
                <h2 class="TL" data-text="ミニゲーム">ミニゲーム</h2>
            </div>
            <div class="menu__item__minigame__BK">
                <p class="TX">実力試しをしよう！</p>
            </div>
            <div class="menu__item__minigame__strap"></div>
        </a>
        <!-- ヘルプ -->
        <a class="menu__item__help" href="<?php echo home_url('/first'); ?>">
            <div class="menu__item__help__inner">
                <div class="menu__item__help__text">
                    <p class="TX" data-text="？">？</p>
                </div>
                <div class="menu__item__help__title">
                    <h2 class="TL" data-text="ヘルプページ">ヘルプページ</h2>
                </div>
            </div>
        </a>
        <!-- クローバ -->
        <div class="deco__clover">
            <div class="deco__clover__leaf"></div>
            <div class="deco__clover__tape"></div>
        </div>
    </div>

    <div class="main-menu--btn_area">
        <?php get_template_part('inc/enquete-btn'); ?>
    </div>
</div>

<?php get_footer(); ?>