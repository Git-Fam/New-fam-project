<?php
if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}
get_header();
?>


<div class="game-main">

    <div class="game-wrap">
        <div class="inner">
            <div class="game-container game-top">
                <div class="TL-box">
                    <p class="TL">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/game-START.svg" alt="START">
                    </p>
                    <div class="TX">
                        ミニゲーム。クイズや実装の研修が体験できるよ。<br>
                        今までに身についた知識のおさらいをしよう！<br>
                        あなたはどこまでできる？<br>
                    </div>
                </div>
                <div class="level">
                    <ul class="level-list">
                        <li class="beginner active">
                            <a href="<?php echo home_url('/game-tag/beginner/'); ?>" class="level-item">
                                <div class="item-bg">
                                    <div class="chara"></div>
                                </div>
                            </a>
                        </li>
                        <li class="intermediate">
                            <a href="<?php echo home_url('/game-tag/intermediate/'); ?>" class="level-item">
                                <div class="item-bg">
                                    <div class="chara"></div>
                                </div>
                            </a>
                        </li>
                        <li class="advanced">
                            <a href="<?php echo home_url('/game-tag/advanced/'); ?>" class="level-item">
                                <div class="item-bg">
                                    <div class="chara"></div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="lever"></div>
        <div class="btn"></div>
    </div>
</div>

<?php get_footer(); ?>