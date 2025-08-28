<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

get_header();
?>


<div class="control">
    <div class="control--wap">
        <div class="control--paper">

            <!-- バインダー金具    -->
            <div class="binder-clip"></div>
            <div class="control--wap--item">
                <div class="slack-bid">
                    <div class="ttl">
                        <p class="TX">Slackサポートお申し込み窓口</p>
                    </div>

                    <!-- 有料会員、管理者は表示。無料会員は非表示 -->
                    <?php echo do_shortcode('[contact-form-7 id="55a6ff9" title="Slack-bid"]'); ?>

                    <div class="pc sp">
                        <?php echo do_shortcode('[swpm_profile_form]'); ?>
                    </div>

                    <!-- 会員レベル表示 -->
                    <!-- クラス名swpm-form-input-wrap swpm-form-membership-level-input-wrapの値をpに表示 -->
                    <p id="membership-level-display" class="membership-level-text" style="margin: 10px 0; padding: 10px; background: #e8f5e8; border: 1px solid #4caf50; border-radius: 4px; color: #2e7d32; font-weight: bold;"></p>

                    <script>
                        // ページ読み込み完了後に実行
                        document.addEventListener('DOMContentLoaded', function() {
                            // 会員レベル情報を取得して表示
                            function updateMembershipLevel() {
                                // swpm-form-input-wrap swpm-form-membership-level-input-wrapクラスを持つ要素を探す
                                const membershipLevelElement = document.querySelector('.swpm-form-input-wrap.swpm-form-membership-level-input-wrap');

                                if (membershipLevelElement) {
                                    // 要素の中身を取得
                                    const membershipLevelText = membershipLevelElement.textContent.trim();

                                    if (membershipLevelText) {
                                        // 表示用のp要素を更新
                                        const displayElement = document.getElementById('membership-level-display');
                                        if (displayElement) {
                                            displayElement.textContent = '🎫 現在の会員レベル: ' + membershipLevelText;
                                        }

                                        // 会員レベルに応じたメッセージ表示制御
                                        updateMembershipMessages(membershipLevelText);
                                    } else {
                                        // テキストが空の場合は、子要素を確認
                                        const childElements = membershipLevelElement.children;
                                        if (childElements.length > 0) {
                                            const childText = childElements[0].textContent.trim();
                                            if (childText) {
                                                const displayElement = document.getElementById('membership-level-display');
                                                if (displayElement) {
                                                    displayElement.textContent = '🎫 現在の会員レベル: ' + childText;
                                                }
                                                // 会員レベルに応じたメッセージ表示制御
                                                updateMembershipMessages(childText);
                                            }
                                        }
                                    }
                                } else {
                                    // 要素が見つからない場合は、少し待ってから再試行
                                    setTimeout(updateMembershipLevel, 1000);
                                }
                            }

                            // 会員レベルに応じたメッセージ表示制御
                            function updateMembershipMessages(levelText) {
                                // 既存のメッセージ要素を削除
                                const existingMessages = document.querySelectorAll('.membership-message');
                                existingMessages.forEach(msg => msg.remove());

                                // 会員レベルに応じたメッセージを作成
                                let message = '';
                                let messageClass = '';

                                if (levelText === '管理者' || levelText === 'Administrator') {
                                    message = '有料会員しか見れません';
                                    messageClass = 'admin-message';
                                } else if (levelText === '無料会員' || levelText === 'Free Member' || levelText === '1') {
                                    message = '無料会員しか見れません';
                                    messageClass = 'free-member-message';
                                } else if (levelText === 'スタンダード会員' || levelText === 'Standard Member' || levelText === '2') {
                                    message = '有料会員しか見れません';
                                    messageClass = 'standard-member-message';
                                } else if (levelText === 'プレミアム会員' || levelText === 'Premium Member' || levelText === '3') {
                                    message = '有料会員しか見れません';
                                    messageClass = 'premium-member-message';
                                } else if (levelText === 'エンタープライズ会員' || levelText === 'Enterprise Member' || levelText === '4') {
                                    message = '有料会員しか見れません';
                                    messageClass = 'enterprise-member-message';
                                } else {
                                    // 不明な会員レベルの場合は、デフォルトで有料会員として扱う
                                    message = '有料会員しか見れません';
                                    messageClass = 'unknown-member-message';
                                }

                                // メッセージ要素を作成
                                const messageElement = document.createElement('div');
                                messageElement.className = 'membership-message ' + messageClass;
                                messageElement.style.cssText = 'margin: 10px 0; padding: 15px; border-radius: 8px; text-align: center; font-weight: bold;';

                                // 会員レベルに応じたスタイルを適用
                                if (messageClass.includes('admin') || messageClass.includes('standard') || messageClass.includes('premium') || messageClass.includes('enterprise') || messageClass.includes('unknown')) {
                                    // 有料会員・管理者用のスタイル（青系）
                                    messageElement.style.background = '#e3f2fd';
                                    messageElement.style.border = '1px solid #2196f3';
                                    messageElement.style.color = '#1565c0';
                                } else if (messageClass.includes('free')) {
                                    // 無料会員用のスタイル（オレンジ系）
                                    messageElement.style.background = '#fff3e0';
                                    messageElement.style.border = '1px solid #ff9800';
                                    messageElement.style.color = '#e65100';
                                }

                                messageElement.textContent = message;

                                // 会員レベル表示の下に挿入
                                const displayElement = document.getElementById('membership-level-display');
                                if (displayElement && displayElement.parentNode) {
                                    displayElement.parentNode.insertBefore(messageElement, displayElement.nextSibling);
                                }
                            }

                            // 初回実行
                            updateMembershipLevel();

                            // フォームが動的に更新される可能性があるため、定期的にチェック
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- 背景アニメーション用  -->


<ul class="circles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
</ul>



<?php get_footer(); ?>