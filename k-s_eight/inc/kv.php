<!-- front -->
<?php if (is_front_page()) : ?>
    <div class="KV KV__front">
        <div class="KV__front--title">
            <h2 class="TL"><span>建物に、</span><br><span>新たな価値を</span></h2>
            <p class="TX">
                <span>時代に合わせた改修工事で、</span><br
                    class="sp"><span>住まいやオフィスを次のステージへ</span><br><span>どんなご要望にも柔軟に対応し、</span><br><span>未来を見据えた空間づくりを実現します。</span>
            </p>
        </div>
    </div>
<?php else : ?>

    <!-- service -->
    <?php if (is_page('service')) : ?>
        <div class="KV KV__cover KV__service">
            <div class="KV__all--title">
                <h2 class="TL">Service</h2>
                <div class="text">
                    <div class="text-bar"></div>
                    <p class="TX">信頼と実績に基づいた施工サービス</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- works -->
    <?php if (is_page('works')) : ?>
        <div class="KV KV__cover KV__works">
            <div class="KV__all--title">
                <h2 class="TL">Works</h2>
                <div class="text">
                    <div class="text-bar"></div>
                    <p class="TX">施工事例</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- contact, contact-confirm, contact-complete -->
    <?php if (is_page('contact') || is_page('contact-confirm') || is_page('contact-complete')) : ?>
        <div class="KV KV__cover KV__contact">
            <div class="KV__all--title">
                <h2 class="TL">Contact</h2>
                <div class="text">
                    <div class="text-bar"></div>
                    <p class="TX">お問い合わせ</p>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>