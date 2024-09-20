<section class="KV">
    <div class="KV__bg">
        <?php if ($section == 'top' || !isset($section)): ?>
            <!-- top -->
            <div class="KV__bg__img top__img"></div>
        <?php endif; ?>
        <?php if ($section == 'qa'): ?>
            <!-- qa -->
            <div class="KV__bg__img qa__img"></div>
        <?php endif; ?>
        <?php if ($section == 'privacy'): ?>
            <!-- privacy -->
            <div class="KV__bg__img privacy__img"></div>
        <?php endif; ?>
        <?php if ($section == 'company'): ?>
            <!-- company -->
            <div class="KV__bg__img company__img"></div>
        <?php endif; ?>
    </div>
    <div class="KV__title">
        <?php if ($section == 'top' || !isset($section)): ?>
            <!-- top -->
            <div class="KV__title__wrap">
                <p class="TX">Additional Services</p>
                <h2 class="TL">付帯サービス</h2>
            </div>
        <?php endif; ?>
        <?php if ($section == 'qa'): ?>
            <!-- qa -->
            <div class="KV__title__wrap">
                <p class="TX">Questions and Answers</p>
                <h2 class="TL">Q&A</h2>
            </div>
        <?php endif; ?>
        <?php if ($section == 'privacy'): ?>
            <!-- privacy -->
            <div class="KV__title__wrap">
                <p class="TX">PrivacyPolicy</p>
                <h2 class="TL">プライバシーポリシー</h2>
            </div>
        <?php endif; ?>
        <?php if ($section == 'company'): ?>
            <!-- company -->
            <div class="KV__title__wrap">
                <p class="TX">Company Profile</p>
                <h2 class="TL">会社概要</h2>
            </div>
        <?php endif; ?>
    </div>
</section>