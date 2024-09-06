<?php get_header(); ?>

<div class="question">
    <div class="question-main">
        <div class="question-main-TL">
            <p class="TL">質問広場</p>
        </div>

        <ul class="C_menu">
                <li class="post">
                    <div class="post-content">質問を作成する</div>
                </li>
                <li class="menu-item status">
                    <div class="status-content">質問の状況</div>
                </li>
                <li class="menu-item category">
                    <div class="category-content">
                        <p class="category-content-TX">カテゴリー選択</p>
                        <div class="select-content">
                            <ul class="select">
                                <li>
                                    <p class="TX">divパズル</p>
                                    <a href="<?php bloginfo('url'); ?>/question/div01">divパズル01</a>
                                    <a href="<?php bloginfo('url'); ?>/question/div02">divパズル02</a>
                                </li>
                                <li>
                                    <p class="TX">その他</p>
                                    <a href="<?php bloginfo('url'); ?>/question/その他の質問">その他の質問</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu-item search">
                    <div class="search-content">検索</div>
                </li>
            </ul>

        <div class="question-content">


            <p class="TX">カテゴリーを選択してください</p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
