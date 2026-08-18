<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>


<div class="subscription">
    <div class="subscription-inner">
        <div class="subscription-content">
            <h1 class="plan-title">プラン一覧</h1>


       <!-- Proプラン -->
        <section class="plan plan1 pro-plan pro">
            <div class="plan-content">
                <h2>Proプラン <span class="recommend">おすすめ！</span></h2>
                <ul>
                    <li><span>月額 980円</span></li>
                    <li>★全クエスト/教材解放</li>
                    <li>★ランキング・コミュニティ参加可</li>
                    <li>★質問数 月15回まで</li>
                    <li><span class="no1">コスパNo.1！ 8割のユーザーが選択</span></li>
                </ul>
            </div>
            <div class="plan-button">
                <?php echo do_shortcode('[swpm_payment_button id="7920"]'); ?>
            </div>
        </section>

        <!-- Masterプラン（月額） -->
        <section class="plan plan2 master-plan-monthly master">
            <div class="plan-content">
                <h2>Masterプラン <span class="recommend">極めたいあなたへ！</span></h2>
                <ul>
                    <li><span>月額 50,000円</span></li>
                    <li>全クエスト/教材解放</li>
                    <li>★専属メンター 1on1</li>
                    <li>★質問回数無制限</li>
                    <li>★オンライン個別指導</li>
                    <li>★ランキング・コミュニティ参加可</li>
                    <li>★限定アバター・VIP称号</li>
                </ul>
            </div>
            <div class="plan-button">
                <?php echo do_shortcode('[swpm_payment_button id="7919"]'); ?>
            </div>
        </section>

        <!-- Masterプラン（一括年額） -->
        <section class="plan plan3 master-plan-yearly master">
            <div class="plan-content">
                <h2>Masterプラン/年 <span class="recommend">まとめてお得！</span></h2>
                <ul>
                    <li><span>一括 450,000円（50,000円×12か月）</span></li>
                    <li>★専属メンター 1on1</li>
                    <li>★質問回数無制限</li>
                    <li>★オンライン個別指導</li>
                    <li>★ランキング・コミュニティ参加可</li>
                    <li>★限定アバター・VIP称号</li>
                </ul>
            </div>
            <div class="plan-button">
                <?php echo do_shortcode('[swpm_payment_button id="7918"]'); ?>
            </div>
   
        </section>



        </div>
    </div>
</div>

<?php get_footer(); ?>
