<!-- コメントセキュリティ
プロキシ経由のコメント投稿を禁止:
offにすればコメントできる -->


<!-- 
左側のメニューから「設定」→「ディスカッション」をクリックします。
「コメント表示条件」 のセクションで、次のオプションにチェックを入れます：
「管理者の承認前にコメントを表示しない」
これにチェックを入れることで、すべてのコメントは管理者の承認を受けるまで表示されません。
 -->

 <?php get_header(); ?>

<div class="question">
    <div class="question-main">
        <div class="question-main-TL">
            <p class="TL">質問広場</p>
        </div>

        <div class="question-main-post">


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

                <?php
                // コメントを表示
                comments_template();
                ?>

            </div>

        </div>

    </div>

    <div class="post-modal">
        <div class="letter">
            <div class="note-bg">
                <div class="C_menu">
                    <div class="menu-item category">
                    <div class="category-content">
                            <select id="post-selector" class="select">
                                <option value="" disabled selected>選択してください</option>
                                <option value="2247" data-url="<?php bloginfo('url'); ?>/question/div01">divパズル01</option>
                                <option value="2251" data-url="<?php bloginfo('url'); ?>/question/div02">divパズル02</option>
                                <option value="2253" data-url="<?php bloginfo('url'); ?>/question/その他の質問">その他の質問</option>
                            </select>
                    </div>
                </div>
                <div class="img-icon"></div>
                <div class="comment-form">
                    <?php comment_form(); ?> 
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>


<script>
    var postTitle = '<?php echo esc_js(get_the_title()); ?>'; // PHPで記事タイトルを取得してJavaScriptに渡す
</script>
