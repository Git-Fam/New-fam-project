<?php
/*
Template Name: Road JQ Template
*/
?>


<?php
get_header(); 

// 現在のユーザー名を取得
$current_user = wp_get_current_user();
$current_username = $current_user->display_name; // 現在のログインユーザーの表示名

// 現在のページのスラッグを取得
$current_slug = get_post_field( 'post_name', get_post() );

// 全ユーザーの進捗データを格納する配列
$all_users_progress = [];

// 全ユーザーを取得
$users = get_users();

foreach ($users as $user) {
    $user_id = $user->ID;
    $username = $user->display_name; // ユーザー名を取得

    // 各ユーザーの進捗データを取得
    $progress_data = [];

    // div01からdiv07のデータを取得
    for ($i = 1; $i <= 7; $i++) {
        $progress_data["div0{$i}"] = get_user_meta($user_id, "div0{$i}", true) ?: '0';
    }

    // responsiveのデータを取得
    $progress_data["responsive"] = get_user_meta($user_id, "responsive", true) ?: '0';

    $progress_data["JQ01"] = get_user_meta($user_id, "JQ01", true) ?: '0';


    // ページスラッグが'road-jq'の場合にのみJQデータを取得
    if (is_page('road-jq')) {
        for ($j = 1; $j <= 10; $j++) {
            $progress_data["JQ" . str_pad($j, 2, '0', STR_PAD_LEFT)] = get_user_meta($user_id, "JQ" . str_pad($j, 2, '0', STR_PAD_LEFT), true) ?: '0';
        }
    }

    // ユーザーごとの進捗データを配列に追加
    $all_users_progress[] = array(
        'user_id' => $user_id,
        'username' => $username,
        'progress' => $progress_data,
    );
}
?>

<div class="page-wappaer">
    <section id="page-road" class="page">
        <div class="inner">
            <div class="content">
                <div class="road">
                    <!-- キャラクターと進捗ポイントを追加 -->
                </div>
            </div>
            <!-- 動的リンクの表示 -->
            <div class="dynamic-link">
                <?php if ($current_slug == 'road'): ?>
                    <a href="<?php echo site_url('/road-jq'); ?>">jQueryの道</a>
                <?php elseif ($current_slug == 'road-jq'): ?>
                    <a href="<?php echo site_url('/road'); ?>">divパズルの道</a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>


<!-- データの受け渡し用スクリプト -->
<script>
    const allUsersProgress = <?php echo json_encode($all_users_progress); ?>;
    const currentUsername = <?php echo json_encode($current_username); ?>;
    const showJQSection = <?php echo is_page('road-jq') ? 'true' : 'false'; ?>; // ページによるJQ表示の切り替え
</script>

<?php get_footer(); ?>
