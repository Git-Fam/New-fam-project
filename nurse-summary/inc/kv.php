<!-- front -->
<?php if (is_front_page()) : ?>
    <div class="KV-home">
        <div class="KV-home--container">
            <div class="contents loadUp">
                <div class="title">
                    <h1 class="TL">看護師転職サイト</h1>
                </div>
                <div class="sub-title">
                    <h2 class="TL">人気ランキング</h2>
                </div>
                <div class="text">
                    <p class="TX">現役ナースが選んだ<br class="sp"><span class="TX__size">人気</span><span
                            class="TX__span">No.1</span>はどこ<span class="TX__mark">？</span></p>
                </div>
            </div>
            <div class="deco">
                <div class="deco--left loadscale">
                    <div class="img"></div>
                </div>
                <div class="deco--right">
                    <div class="text loadPop">
                        <p class="TX">保健師・助産師の<br>転職にも対応！</p>
                    </div>
                    <div class="img loadscale"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- comparison -->
<?php if (is_page('comparison')) : ?>
    <div class="KV-comparison">
        <div class="KV-comparison--container">
            <div class="contents loadUp">
                <div class="title">
                    <h1 class="TL">看護師転職サイト</h1>
                </div>
                <div class="sub-title">
                    <h2 class="TL">主要<img class="TL__size" src="<?php echo get_template_directory_uri(); ?>/img/KV-15.png" alt="15">社&nbsp;<span
                            class="TL__point">比</span><span class="TL__point">較</span>表</h2>
                </div>
                <div class="text">
                    <p class="TX">2024年最新情報</p>
                </div>
            </div>
            <div class="deco">
                <div class="deco--left loadscale">
                    <div class="img"></div>
                </div>
                <div class="deco--right ">
                    <div class="text loadPop">
                        <p class="TX">ハローワーク<br>求人にも対応！</p>
                    </div>
                    <div class="img loadscale"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
