<?php get_header(); ?>



<?php
// 保存処理
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $user_id = get_current_user_id();
//     $selected_items = [];
//     $owned_items = [];

//     foreach ($_POST as $key => $value) {

//         // キャラクターの保存処理
//         if (strpos($key, 'selected_items-character-character') === 0) {
//             $selected_character = sanitize_text_field($value);
//             update_user_meta($user_id, 'selected_character', $selected_character);
//             // 持っているキャラクターを蓄積保存
//             $existing_owned_characters = get_user_meta($user_id, 'owned_characters', true);
//             if ($existing_owned_characters) {
//                 $existing_owned_characters = json_decode($existing_owned_characters, true);
//             } else {
//                 $existing_owned_characters = [];
//             }
//             if (!is_array($existing_owned_characters)) {
//                 $existing_owned_characters = [];
//             }
//             if (!in_array($selected_character, $existing_owned_characters)) {
//                 $existing_owned_characters[] = $selected_character;
//             }
//             update_user_meta($user_id, 'owned_characters', json_encode($existing_owned_characters));
//         }

//         // 帽子の保存処理
//         if (strpos($key, 'selected_items-item-hat') === 0) {
//             $selected_hat = sanitize_text_field($value);
//             update_user_meta($user_id, 'selected_hat', $selected_hat);
//             // 持っている帽子を蓄積保存
//             $existing_owned_hats = get_user_meta($user_id, 'owned_hats', true);
//             if ($existing_owned_hats) {
//                 $existing_owned_hats = json_decode($existing_owned_hats, true);
//             } else {
//                 $existing_owned_hats = [];
//             }
//             if (!is_array($existing_owned_hats)) {
//                 $existing_owned_hats = [];
//             }
//             if (!in_array($selected_hat, $existing_owned_hats)) {
//                 $existing_owned_hats[] = $selected_hat;
//             }
//             update_user_meta($user_id, 'owned_hats', json_encode($existing_owned_hats));
//         }

//         // メガネの保存処理
//         if (strpos($key, 'selected_items-item-glasses') === 0) {
//             $selected_glasses = sanitize_text_field($value);
//             update_user_meta($user_id, 'selected_glasses', $selected_glasses);
//             // 持っているメガネを蓄積保存
//             $existing_owned_glasses = get_user_meta($user_id, 'owned_glasses', true);
//             if ($existing_owned_glasses) {
//                 $existing_owned_glasses = json_decode($existing_owned_glasses, true);
//             } else {
//                 $existing_owned_glasses = [];
//             }
//             if (!is_array($existing_owned_glasses)) {
//                 $existing_owned_glasses = [];
//             }
//             if (!in_array($selected_glasses, $existing_owned_glasses)) {
//                 $existing_owned_glasses[] = $selected_glasses;
//             }
//             update_user_meta($user_id, 'owned_glasses', json_encode($existing_owned_glasses));
//         }
//     }
// }

// 共通の保存処理関数をインクルード
include_once './function/cooperator/common-avatar-save.php';
include_once './function/cooperator/avatar-id-get.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = get_current_user_id();

    foreach ($_POST as $key => $value) {
        save_user_item($user_id, $key, $value);
    }
}



?>





<form action="" method="POST">
    <div class="change-clothes">
        <!-- ディスプレイ -->
        <div class="change-clothes__display">
            <header class="display__header">

                <a class="return__button hover-opa" href="<?php bloginfo('url'); ?>/my" onclick="return confirm('本当に戻りますか？変更があった場合、情報は失われます。');">
                    <div class="icon icon-01"></div>
                </a>

                <div class="self__area">
                    <!-- 所持金 -->
                    <div class="possession__area">
                        <div class="possession__item">
                            <div class="icon icon-01"></div>
                            <p class="TX">
                                <?php
                                $user_id = get_current_user_id();
                                $user_coins = get_user_meta($user_id, 'user_coins', true) ?: 0;
                                echo esc_html($user_coins);
                                ?>
                            </p>
                        </div>
                        <div class="possession__item">
                            <div class="icon icon-02"></div>
                            <p class="TX">
                                <?php
                                $user_points = get_user_meta($user_id, 'user_point', true) ?: 0;
                                echo esc_html($user_points);
                                ?>
                            </p>
                        </div>
                    </div>

                    <!-- 保存ボタン -->
                    <button class="saving__button" type="submit" disable>
                        <p class="TX">保存する</p>
                    </button>
                </div>

            </header>

            <!-- display-character -->
            <div class="display_character-wap">
                <?php display_character(); ?>
            </div>

            <div class="display__character__ground"></div>

            <!-- キャラクターのセリフ -->
            <div class="display__character__serif none">
                <div class="serif__area">
                    <div class="item__serif">
                        <p class="TX">まだ持っていないアイテムだよ！</p>
                    </div>
                    <div class="item__info">
                        <div class="item__img__frame">
                            <img class="item__img" src="" alt="">
                        </div>
                        <div class="item__cost">
                            <div class="icon "></div>
                            <p class="TX"></p>
                        </div>
                    </div>
                    <div class="item__button">
                        <button class="buttons cancel" type="button">やめる</button>
                        <button class="buttons exchange" type="button">交換する</button>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                var user_id = "<?php echo get_current_user_id(); ?>";
            </script>

            <!-- キャラクターの色変更 -->
            <!-- <div class="display__character__color none">
                <div class="color__area">
                    <div class="gradient__area">
                        <canvas id="color-display" class="gradient__item"></canvas>
                    </div>
                    <div class="picker__area">
                        <input id="selected-color" class="color__now" type="text" name="color" id="color"
                            value="rgb(247, 251, 248)">
                        <div class="color__bar__container">
                            <canvas id="color-bar" class="color__bar"></canvas>
                            <div id="color-bar-marker" class="color__bar__marker"></div>
                        </div>
                    </div>
                </div>
            </div> -->

            <?php display_back_button();?>

        </div>

        <!-- コントロール -->
        <div class="change-clothes__control">

            <div class="control__category">

                <!-- カテゴリー -->
                <div class="category__list">
                    <ul class="category__list__items">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'avatar-cat',
                            'hide_empty' => false,
                        ));
                        foreach ($categories as $index => $category) {
                            $active_class = $index === 0 ? 'active' : '';
                            $png_url = get_template_directory_uri() . '/img/avatar-top-icon/' . esc_attr($category->slug) . '.png';
                            $svg_url = get_template_directory_uri() . '/img/avatar-top-icon/' . esc_attr($category->slug) . '.svg';
                            $image_url = file_exists(get_template_directory() . '/img/avatar-top-icon/' . esc_attr($category->slug) . '.png') ? $png_url : $svg_url;
                            echo '<li class="' . $active_class . '">';
                            echo '<div class="category__item">';
                            echo '<div class="icon" style="background-image: url(' . esc_url($image_url) . ');"></div>';
                            echo '</div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                </div>

                <!-- タグ -->
                <div class="tag__list">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'avatar-cat',
                        'hide_empty' => false,
                    ));
                    foreach ($categories as $index => $category) {
                        $active_class = $index === 0 ? 'active' : '';
                        echo '<div class="tag__list__area ' . $active_class . '">';
                        echo '<ul class="tag__list__items">';

                        // カテゴリーに紐付いたタグを取得
                        $tags = get_terms(array(
                            'taxonomy' => 'avatar-tag',
                            'hide_empty' => false,
                            'meta_query' => array(
                                array(
                                    'key' => 'category_slug',
                                    'value' => $category->slug,
                                    'compare' => '='
                                )
                            )
                        ));

                        foreach ($tags as $tag) {
                            $png_url = get_template_directory_uri() . '/img/avatar-top-icon/' . esc_attr($category->slug) . '-' . esc_attr($tag->slug) . '.png';
                            $svg_url = get_template_directory_uri() . '/img/avatar-top-icon/' . esc_attr($category->slug) . '-' . esc_attr($tag->slug) . '.svg';
                            $image_url = file_exists(get_template_directory() . '/img/avatar-top-icon/' . esc_attr($category->slug) . '-' . esc_attr($tag->slug) . '.png') ? $png_url : $svg_url;
                            echo '<li>';
                            echo '<div class="tag__item" style="background-image: url(' . esc_url($image_url) . ');"></div>';
                            echo '</li>';
                        }

                        echo '</ul>';
                        echo '</div>';
                    }
                    ?>
                </div>

            </div>

            <!-- itemたち -->
            <div class="control__item">
                <div class="control__item__inner">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'avatar-cat',
                        'hide_empty' => false,
                    ));
                    foreach ($categories as $category_index => $category) {
                        $category_active_class = $category_index === 0 ? 'active' : '';
                        echo '<div class="control__list__wrap ' . $category_active_class . '">';

                        // カテゴリーに紐づくタグを取得
                        $tags = get_terms(array(
                            'taxonomy' => 'avatar-tag',
                            'hide_empty' => false,
                            'meta_query' => array(
                                array(
                                    'key' => 'category_slug',
                                    'value' => $category->slug,
                                    'compare' => '='
                                )
                            )
                        ));

                        foreach ($tags as $tag_index => $tag) {
                            $tag_active_class = $tag_index === 0 ? 'active' : '';
                            echo '<div class="control__category-tag__list ' . $tag_active_class . '">';
                            echo '<ul>';

                            // タグに紐づく投稿を取得
                            $posts = get_posts(array(
                                'post_type' => 'avatar',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'avatar-tag',
                                        'field' => 'slug',
                                        'terms' => $tag->slug,
                                    )
                                )
                            ));

                            foreach ($posts as $post) {
                                $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
                                $input_value = esc_attr($category->slug . '-' . $tag->slug . '-' . $post->ID);
                                $is_selected_item = in_array($input_value, $selected_items) ? 'checked' : '';
                                $is_owned_character = in_array($input_value, $owned_characters) ? 'active' : '';
                                $is_owned_hat = in_array($input_value, $owned_hats) ? 'active' : '';
                                $is_owned_glasses = in_array($input_value, $owned_glasses) ? 'active' : '';
                                $price = get_post_meta($post->ID, '_avatar_price', true);
                                $payment_type = get_post_meta($post->ID, '_avatar_radio_payment', true);

                                echo '<li>';
                                echo '<div class="price" style="display: none;">' . $price . '</div>';
                                echo '<div class="payment_type" style="display: none;">' . $payment_type . '</div>';
                                echo '<input class="category-tag__item--wrap" type="radio" name="selected_items-' . esc_attr($category->slug) . '-' . esc_attr($tag->slug) . '" value="' . $input_value . '" ' . $is_selected_item . ' onclick="toggleRadio(this)">';
                                echo '<div class="category-tag__item">';
                                if ($thumbnail_url) {
                                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($post->post_title) . '">';
                                } else {
                                    echo 'No image available';
                                }
                                echo '</div>';
                                echo '<div class="nothing-item ' . $is_owned_character . ' ' . $is_owned_hat . ' ' . $is_owned_glasses . '"></div>';
                                echo '</li>';
                            }

                            echo '</ul>';
                            echo '</div>';
                        }

                        echo '</div>';
                    }
                    ?>
                </div>
            </div>

        </div>


    </div>
</form>


<script>
    function toggleRadio(radio) {
        if (radio.previousChecked) {
            radio.checked = false;
        }
        radio.previousChecked = radio.checked;
    }
</script>

<?php get_footer(); ?>