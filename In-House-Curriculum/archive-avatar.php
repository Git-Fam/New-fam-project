<?php

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();

// 共通の保存処理関数をインクルード
include_once get_template_directory() . '/function/cooperator/common-avatar-save.php';
include_once get_template_directory() . '/function/cooperator/avatar-id-get.php';

$user_id = get_current_user_id();
$success = false;
$error_message = '';

// ユーザーの所持アイテム情報を取得
$owned_avatars = json_decode(get_user_meta($user_id, 'owned_avatars', true), true) ?: [];
$owned_items = json_decode(get_user_meta($user_id, 'owned_items', true), true) ?: [];
$selected_items = json_decode(get_user_meta($user_id, 'selected_items', true), true) ?: [];
$selected_avatar = get_user_meta($user_id, 'selected_avatar', true) ?: 'normal-7547';

// POSTリクエストの処理
if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('avatar_update', 'avatar_nonce')) {
    $success = true;

    // 選択中のアバターを保存
    if (isset($_POST['selected_avatar'])) {
        $selected_avatar = sanitize_text_field($_POST['selected_avatar']);
        if (!empty($selected_avatar)) {
            update_user_meta($user_id, 'selected_avatar', $selected_avatar);
        }
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'selected_items-') === 0) {
            if (!save_user_item($user_id, $key, $value)) {
                $success = false;
                $error_message = 'アイテムの保存に失敗しました。';
                break;
            }
        }
    }
}
?>

<?php if ($success): ?>
    <script>
        alert('アバターの変更を保存しました！');
        window.location.href = '<?php echo esc_js(add_query_arg('updated', '1', wp_get_referer())); ?>';
    </script>
<?php endif; ?>

<form action="" method="POST">
    <?php wp_nonce_field('avatar_update', 'avatar_nonce'); ?>

    <!-- 選択中のアバターを保存するためのhidden input -->
    <input type="hidden" id="selected_avatar_input" name="selected_avatar" value="<?php echo esc_attr($selected_avatar); ?>">

    <?php if (isset($_GET['updated'])): ?>
        <div class="notice notice-success">
            <p>アバターの変更を保存しました。</p>
        </div>
    <?php endif; ?>

    <?php if (!empty($error_message)): ?>
        <div class="notice notice-error">
            <p><?php echo esc_html($error_message); ?></p>
        </div>
    <?php endif; ?>

    <div class="change-clothes">
        <!-- ディスプレイ -->
        <div class="change-clothes__display">
            <header class="display__header">
                <a class="return__button hover-opa" href="<?php echo esc_url(home_url('/my')); ?>"
                    onclick="return confirm('<?php echo esc_js('本当に戻りますか？変更があった場合、情報は失われます。'); ?>');">
                    <div class="icon icon-01"></div>
                </a>

                <div class="self__area">
                    <!-- 所持金 -->
                    <div class="possession__area">
                        <div class="possession__item">
                            <div class="icon icon-01"></div>
                            <p class="TX">
                                <?php echo esc_html(get_user_meta($user_id, 'user_coins', true) ?: 0); ?>
                            </p>
                        </div>
                        <div class="possession__item">
                            <div class="icon icon-02"></div>
                            <p class="TX">
                                <?php echo esc_html(get_user_meta($user_id, 'user_point', true) ?: 0); ?>
                            </p>
                        </div>
                    </div>

                    <!-- 保存ボタン -->
                    <button class="saving__button" type="submit" onclick="return confirm('<?php echo esc_js('変更を保存しますか？'); ?>');">
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
                        <p class="TX">まだ持っていないよ！</p>
                    </div>
                    <div class="item__info">
                        <div class="item__img__frame">
                            <img class="item__img" src="" alt="">
                        </div>
                        <div class="item__cost">
                            <div class="icon"></div>
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
                var ajaxurl = "<?php echo esc_js(admin_url('admin-ajax.php')); ?>";
                var user_id = "<?php echo esc_js(get_current_user_id()); ?>";
            </script>

            <?php display_back_button(); ?>
        </div>

        <!-- コントロール -->
        <div class="change-clothes__control">

            <div class="control__category">

                <!-- 投稿（アバターかアイテムか...） -->
                <div class="category__list">
                    <ul class="category__list__items">
                        <!-- 着せ替えの種類を増やす場合はliを増やす -->
                        <!-- アバター -->
                        <li class="active">
                            <div class="category__item">
                                <div class="icon" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/avatar-top-icon/avatar.webp);"></div>
                            </div>
                        </li>
                        <!-- アイテム -->
                        <li>
                            <div class="category__item">
                                <div class="icon" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/avatar-top-icon/item.webp);"></div>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- アバター、アイテムそれぞれのカテゴリー -->
                <div class="tag__list">
                    <!-- 着せ替えの種類を増やす場合は.tag__list__areaを増やす -->
                    <!-- アバターのカテゴリー -->
                    <div class="tag__list__area active">
                        <ul class="tag__list__items">
                            <?php
                            $avatar_categories = get_terms(array(
                                'taxonomy' => 'avatar-cat',
                                'hide_empty' => false,
                            ));
                            if (is_array($avatar_categories) && !empty($avatar_categories)) {
                                foreach ($avatar_categories as $category) {
                                    // $categoryがオブジェクトか配列かを判定
                                    $category_slug = '';
                                    if (is_object($category) && isset($category->slug)) {
                                        $category_slug = $category->slug;
                                    } elseif (is_array($category) && isset($category['slug'])) {
                                        $category_slug = $category['slug'];
                                    } else {
                                        continue; // スラッグが取得できない場合はスキップ
                                    }

                                    $image_url = get_template_directory_uri() . '/img/avatar-top-icon/avatar-' . esc_attr($category_slug) . '.webp';
                                    echo '<li>';
                                    echo '<div class="tag__item" style="background-image: url(' . esc_url($image_url) . ');"></div>';
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>

                    <!-- アイテムのカテゴリー -->
                    <div class="tag__list__area">
                        <ul class="tag__list__items">
                            <?php
                            $item_categories = get_terms(array(
                                'taxonomy' => 'item-cat',
                                'hide_empty' => false,
                            ));
                            if (is_array($item_categories) && !empty($item_categories)) {
                                foreach ($item_categories as $category) {
                                    // $categoryがオブジェクトか配列かを判定
                                    $category_slug = '';
                                    if (is_object($category) && isset($category->slug)) {
                                        $category_slug = $category->slug;
                                    } elseif (is_array($category) && isset($category['slug'])) {
                                        $category_slug = $category['slug'];
                                    } else {
                                        continue; // スラッグが取得できない場合はスキップ
                                    }

                                    $image_url = get_template_directory_uri() . '/img/avatar-top-icon/item-' . esc_attr($category_slug) . '.webp';
                                    echo '<li>';
                                    echo '<div class="tag__item" style="background-image: url(' . esc_url($image_url) . ');"></div>';
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- アバター、アイテムたち -->
            <div class="control__item">
                <div class="control__item__inner">
                    <!-- アバター -->
                    <div class="control__list__wrap active">
                        <?php
                        $avatar_categories = get_terms(array(
                            'taxonomy' => 'avatar-cat',
                            'hide_empty' => false,
                        ));
                        if (is_array($avatar_categories) && !empty($avatar_categories)) {
                            foreach ($avatar_categories as $category_index => $category) {
                                // $categoryがオブジェクトか配列かを判定
                                $category_slug = '';
                                if (is_object($category) && isset($category->slug)) {
                                    $category_slug = $category->slug;
                                } elseif (is_array($category) && isset($category['slug'])) {
                                    $category_slug = $category['slug'];
                                } else {
                                    continue; // スラッグが取得できない場合はスキップ
                                }

                                $category_active_class = $category_index === 0 ? 'active' : '';
                                echo '<div class="control__category-tag__list ' . $category_active_class . '">';
                                echo '<ul>';

                                // カテゴリーに直接紐づく投稿を取得
                                $posts = get_posts(array(
                                    'post_type' => 'avatar',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'avatar-cat',
                                            'field' => 'slug',
                                            'terms' => $category_slug,
                                        )
                                    )
                                ));

                                foreach ($posts as $post) {
                                    $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
                                    $input_value = esc_attr($category_slug . '-' . $post->ID);
                                    $is_selected_item = ($input_value === $selected_avatar) ? 'checked' : '';

                                    // 所持アバターの判定
                                    $is_owned = in_array($input_value, $owned_avatars) ? 'active' : '';

                                    $price = get_post_meta($post->ID, '_avatar_price', true);
                                    $payment_type = get_post_meta($post->ID, '_avatar_radio_payment', true);
                                    $aspect_ratio = get_post_meta($post->ID, '_avatar_aspect_ratio', true);
                                    $avatar_style = get_post_meta($post->ID, '_avatar_style', true);
                                    $avatar_item_styles = get_post_meta($post->ID, '_avatar_item_styles', true);

                                    echo '<li>';
                                    echo '<div class="price" style="display: none;">' . $price . '</div>';
                                    echo '<div class="payment_type" style="display: none;">' . $payment_type . '</div>';
                                    echo '<div class="aspect-ratio" style="display: none;">' . esc_attr($aspect_ratio) . '</div>';
                                    echo '<div class="avatar-style" style="display: none;">' . esc_attr($avatar_style) . '</div>';
                                    echo '<div class="avatar-item-styles" style="display: none;">' . esc_attr(json_encode($avatar_item_styles)) . '</div>';
                                    echo '<input class="category-tag__item--wrap" type="radio" name="selected_items-' . esc_attr($category_slug) . '" value="' . $input_value . '" ' . $is_selected_item . ' onclick="toggleRadio(this)">';
                                    echo '<div class="category-tag__item">';
                                    if ($thumbnail_url) {
                                        echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($post->post_title) . '">';
                                    } else {
                                        echo 'No image available';
                                    }
                                    echo '</div>';
                                    echo '<div class="nothing-item ' . $is_owned . '"></div>';
                                    echo '</li>';
                                }

                                echo '</ul>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>

                    <!-- アイテム -->
                    <div class="control__list__wrap">
                        <?php
                        $item_categories = get_terms(array(
                            'taxonomy' => 'item-cat',
                            'hide_empty' => false,
                        ));
                        if (is_array($item_categories) && !empty($item_categories)) {
                            foreach ($item_categories as $category_index => $category) {
                                // $categoryがオブジェクトか配列かを判定
                                $category_slug = '';
                                if (is_object($category) && isset($category->slug)) {
                                    $category_slug = $category->slug;
                                } elseif (is_array($category) && isset($category['slug'])) {
                                    $category_slug = $category['slug'];
                                } else {
                                    continue; // スラッグが取得できない場合はスキップ
                                }

                                $category_active_class = $category_index === 0 ? 'active' : '';
                                echo '<div class="control__category-tag__list ' . $category_active_class . '">';
                                echo '<ul>';

                                // カテゴリーに直接紐づく投稿を取得
                                $posts = get_posts(array(
                                    'post_type' => 'item',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'item-cat',
                                            'field' => 'slug',
                                            'terms' => $category_slug,
                                        )
                                    )
                                ));

                                foreach ($posts as $post) {
                                    $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');
                                    $input_value = esc_attr($category_slug . '-' . $post->ID);
                                    $is_selected_item = in_array($input_value, $selected_items) ? 'checked' : '';

                                    // 所持アイテムの判定（カテゴリー別）
                                    $is_owned = false;
                                    if (isset($owned_items[$category_slug])) {
                                        $is_owned = in_array($input_value, $owned_items[$category_slug]) ? 'active' : '';
                                    }

                                    $price = get_post_meta($post->ID, '_item_price', true);
                                    $payment_type = get_post_meta($post->ID, '_item_radio_payment', true);
                                    $aspect_ratio = get_post_meta($post->ID, '_item_aspect_ratio', true);
                                    $item_style = get_post_meta($post->ID, '_item_style', true);

                                    echo '<li>';
                                    echo '<div class="price" style="display: none;">' . $price . '</div>';
                                    echo '<div class="payment_type" style="display: none;">' . $payment_type . '</div>';
                                    echo '<div class="aspect-ratio" style="display: none;">' . esc_attr($aspect_ratio) . '</div>';
                                    echo '<div class="item-style" style="display: none;">' . esc_attr($item_style) . '</div>';
                                    echo '<input class="category-tag__item--wrap" type="radio" name="selected_items-' . esc_attr($category_slug) . '" value="' . $input_value . '" ' . $is_selected_item . ' onclick="toggleRadio(this)">';
                                    echo '<div class="category-tag__item">';
                                    if ($thumbnail_url) {
                                        echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr($post->post_title) . '">';
                                    } else {
                                        echo 'No image available';
                                    }
                                    echo '</div>';
                                    echo '<div class="nothing-item ' . $is_owned . '"></div>';
                                    echo '</li>';
                                }

                                echo '</ul>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>


    </div>
</form>

<script>
    function toggleRadio(radio) {
        if (radio.previousChecked) {
            radio.checked = false;
            radio.previousChecked = false;
            // 選択解除時にセリフエリアを非表示
            document.querySelector('.display__character__serif').classList.add('none');
        } else {
            // 同じname属性の他のラジオボタンのpreviousCheckedをリセット
            var name = radio.name;
            var radios = document.querySelectorAll('input[name="' + name + '"]');
            radios.forEach(function(r) {
                r.previousChecked = false;
            });
            radio.previousChecked = true;
        }
    }
</script>

<?php get_footer(); ?>