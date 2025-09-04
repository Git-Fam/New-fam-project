<?php

function display_back_button()
{

?>
    <!-- ボタン -->
    <div class="display__sideButton">
        <button class="sideButton__button" type="button" onclick="restorePreviousState();">
            <div class="sideButton__text">
                <div class="icon icon-01"></div>
                <p class="TX">ひとつ戻す</p>
            </div>
        </button>
        <button class="sideButton__button" type="button">
            <a class="sideButton__text" href="<?php bloginfo('url'); ?>/avatar">
                <div class="icon icon-02"></div>
                <p class="TX">リセット</p>
            </a>
        </button>
    </div>

<?php
}
?>