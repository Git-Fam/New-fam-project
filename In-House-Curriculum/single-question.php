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

        <ul class="question-main-menu">
            <li>
                <div class="post">質問を作成する</div>
            </li>
            <li>
                <div class="status">質問の状況</div>
            </li>
            <li>
                <select class="category" name="select" onChange="location.href=value;">
                    <option value="">カテゴリー選択</option>
                    <option value="<?php bloginfo('url'); ?>/question/div01">divパズル01</option>
                    <option value="<?php bloginfo('url'); ?>/question/div02">divパズル02</option>
                    <option value="<?php bloginfo('url'); ?>/question/その他の質問">その他の質問</option>
                </select>
            </li>
            <li>
                <div class="search">検索</div>
            </li>
        </ul>

        <div class="question-content">


            <div class="comment">
                <?php
                // コメントフォームを表示
                comments_template();
                ?>
            </div>


        </div>
    </div>
</div>

<?php get_footer(); ?>
