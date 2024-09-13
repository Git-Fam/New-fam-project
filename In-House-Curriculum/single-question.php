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
        
        <!-- 左側 -->
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
                <li class="search">
                    <div class="search-content menu-item">
                        <input type="text" id="comment-search-input" placeholder="検索" class="search-input">
                        <button id="comment-search-button"></button>
                    </div>
                    
                </li>
            </ul>


            <div class="question-content">

            <div class="comment-search-result">
            <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            </div>

            </div>

        </div>

        <!-- 右側 -->
        <div class="C_chatbot">
            <div class="chatbot-content">
                <div class="top-message bot-message">
                    <div class="icon"></div>
                    <p class="textbox">
                        こんにちは！よく聞かれる内容についてお答えします！
                    </p>
                </div>
                <div class="q-and-a">
                    <?php
                    // カスタム投稿タイプ「チャットボット」を取得するためのクエリ
                    $args = array(
                        'post_type' => 'chatbot', // カスタム投稿タイプ「チャットボット」を指定
                        'posts_per_page' => -1    // すべての投稿を取得
                    );

                    $chatbot_query = new WP_Query($args);

                    if ($chatbot_query->have_posts()) :
                        echo '<ul id="q-and-a-list">';
                        while ($chatbot_query->have_posts()) : $chatbot_query->the_post();
                            // 各投稿のタイトルをリンクとして表示し、投稿IDをdata属性に設定
                            echo '<li class="up"><a href="#" class="chatbot-title" data-id="' . get_the_ID() . '">' . get_the_title() . '</a></li>';
                        endwhile;
                        echo '</ul>';
                    else :
                        echo '質問は見つかりませんでした。';
                    endif;

                    // クエリのリセット
                    wp_reset_postdata();
                    ?>
                </div>
                <div class="q-and-a-answer answer-message up">
                    <div class="bot-message">
                        <div class="icon"></div>
                        <p class="textbox answer"><!-- クリックされた投稿の内容がここに表示される --></p>
                    </div>  
                </div>

                <div class="search-word up">
                    <p class="word"></p>
                    <div class="icon"></div>
                </div>

                <div class="search-result q-and-a up"></div>

                <div class="search-result-answer answer-message  up">
                    <div class="bot-message">
                        <div class="icon"></div>
                        <p class="textbox search-answer"><!-- クリックされた投稿の内容がここに表示される --></p>
                    </div>  
                </div>


                <div class="search">
                    <input type="text" id="search-input" placeholder="質問を入力する">
                    <button id="search-button"></button>
                </div>
            </div>
        </div>

    </div>
    <div class="post-modal">
        <div class="letter">
            <div class="note-bg">
                <div class="img-icon"></div>
                <div class="comment-form-content">
                    <?php
                    // comments.phpがまだインクルードされていない場合はインクルードする
                    if (!function_exists('display_comment_form')) {
                        include get_template_directory() . '/comments.php'; // テーマディレクトリのcomments.phpをインクルード
                    }

                    // コメントフォームのみを表示
                    if (comments_open() || get_comments_number()) :
                        display_comment_form(); // コメントフォームのみを表示
                    endif;
                    ?>
                    <div class="C_back-btn">戻る</div>

                </div>
            </div>
        </div>
        <div class="success">
            <div class="success-content">
                <p class="TX">
                    質問を送りました<br>
                    承認後に反映されます。
                </p>
                <div class="img"></div>
                <div class="C_back-btn">戻る</div>
            </div>
        </div>
    </div>


</div>

<?php get_footer(); ?>
