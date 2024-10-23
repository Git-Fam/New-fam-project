<?php
        // クエリパラメータから記事IDを取得
        $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
        if ($post_id) :
        $queried_post = get_post($post_id);

        if ($queried_post) :
    ?>
    <?php
        endif;
        endif;
?>

<?php
get_header();
?>
<div class="cover-wrapper">
    <div class="cover">

        <div class="cover-header">
            <p class="TL">カリキュラム選択　〉HTML　〉<?php echo esc_html($queried_post->post_title); ?></p>
            <div class="btn" id="cover-btn"></div>
        </div>

        <div class="tab-wrap" id="tab-wrap">
            <div class="archive--contents--tab">
                <?php
                    $categories = get_categories(array('parent' => 0)); // 最上位のカテゴリーのみを取得する
                    foreach ($categories as $category):
                    // カテゴリーに対応する画像ファイル名を想定しています。実際には適切に設定してください。
                    $image_file_name = $category->slug . '.png';
                    ?>
                    <div class="archive--item">
                        <a href="<?php echo $category->slug; ?>" class="archive--item--link">
                            <img class="archive--item--img" src="<?php echo get_template_directory_uri(); ?>/img/<?php echo $image_file_name ?>" alt="">
                        </a>
                        <div class="archive--item--title">
                            <p class="TX"><?php echo $category->name; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <a href="<?php echo site_url('/chat'); ?>" class="chara-link koinubox">
            <div class="koinu"></div>
            <p class="link">チャット...</p>
        </a>
        <div class="tree tree01"></div>
        <a href="<?php echo site_url('/question'); ?>" class="chara-link goatbox">
            <div class="goat"></div>
            <p class="link">質問する？</p>
        </a>
        <div class="tree tree02"></div>
        <div class="cover-content">
            <div class="intermediate-page" id="cover-curriculum">
                <!-- 記事タイトル -->
                <div class="TL-wrap">
                    <p class="post-TL"><?php echo esc_html($queried_post->post_title); ?></p>
                    <?php
                        if ($post_id) :
                        $queried_post = get_post($post_id);

                        if ($queried_post) :
                    ?>
                    <?php
                        else:
                            echo '<p class="post-TL error">記事が見つかりませんでした。</p>';
                        endif;
                        else:
                            echo '<p class="post-TL error">カリキュラムを選択して下さい</p>';
                        endif;
                    ?>
                </div>

                <!-- サムネイル -->
                    <div class="post-thumbnail">
                        <a href="<?php echo get_permalink($queried_post); ?>">
                        <?php 
                            if ($queried_post) : 
                                // サムネイルが設定されているかチェック
                                if (has_post_thumbnail($queried_post)) {
                                    // サムネイルがある場合は表示
                                    echo '<img class="img" src="' . esc_url(get_the_post_thumbnail_url($queried_post)) . '" alt="">';
                                } else {
                                    // サムネイルがない場合はデフォルト画像を表示
                                    echo '<img class="img" src="' . esc_url(get_template_directory_uri() . '/img/no-img.png') . '" alt="No Image Available">';
                                }
                            else :
                                echo '<p>記事が取得できませんでした。</p>';
                            endif; 
                        ?>

                        </a>
                    </div>

                <!-- 記事本文へのリンク -->
                <a href="<?php echo get_permalink($queried_post); ?>" class="start-btn">はじめる</a>
            </div>
            <div class="shironeko-wrap">
                <div class="shironeko pyon"></div>
                <div class="shadow"></div>
            </div>
        </div>
        <div class="back-wrap">
            <div class="back"></div>
            <a href="javascript:window.close()" class="TX">戻る</a>
        </div>

        <?php 
        if ($queried_post):
            // 次の投稿を取得
            $next_post = get_next_post();
            if ($next_post):
                $next_post_id = $next_post->ID; // 次の記事のIDを取得
        ?>
                <!-- 次の記事のリンクを作成し、URLにIDをパラメータとして付与 -->
                <a href="<?php echo esc_url( site_url('/cover/?post_id=' . $next_post_id) ); ?>" class="next">
                    <p class="next-link">次に進む</p>
                </a>
        <?php
            else:
                echo '<p>次の記事はありません。</p>';
            endif;

        else:
            echo '<p>記事が選択されていません。</p>';
        endif;
        ?>
    <div class="grass grass01"></div>
    <div class="grass grass02"></div>
</div>
<?php
get_footer();
?>
