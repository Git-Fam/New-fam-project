<!-- front -->
<?php if (is_front_page()): ?>
  <section class="KV">
    <div class="KV-inner">
        <div class="KV-curtain">
            <div class="img"></div>
        </div>
        <div class="KV-char">
            <div class="KV-char_left">
                <div class="img op-anime-left"></div>
            </div>
            <div class="KV-char_right">
                <div class="img op-anime-right"></div>
            </div>
        </div>
        <div class="KV-spot"></div>
        <div class="KV-mom">
            <div class="img"></div>
        </div>
        <div class="KV-note">
            <div class="img op-anime-note"></div>
        </div>
        <div class="KV-ttl">
            <h2 class="TL">
                <img
                    class="pc"
                    src="<?php echo get_template_directory_uri(); ?>/img/KV/KV-ttl-pc.svg"
                    alt="いのちの協奏曲をつむぐ。つむぎクリニック"
                />
                <img
                    class="sp"
                    src="<?php echo get_template_directory_uri(); ?>/img/KV/KV-ttl-sp.svg"
                    alt="いのちの協奏曲をつむぐ。つむぎクリニック"
                />
            </h2>
        </div>
    </div>
    <div class="KV-bg">
        <div class="KV-bg_top"></div>
        <div class="KV-bg_bottom"></div>
    </div>
</section>
<?php else: ?>

  <!-- about -->
  <?php if (is_page('about')): ?>
    <section class="KV KV-about">
        <div class="KV-inner">
            <div class="KV-curtain">
                <div class="img"></div>
            </div>
            <div class="KV-char">
                <div class="KV-char_left">
                    <div class="img"></div>
                </div>
                <div class="KV-char_right">
                    <div class="img"></div>
                </div>
            </div>
            <div class="KV-spot"></div>
            <div class="KV-mom">
                <div class="img"></div>
            </div>
            <div class="KV-note">
                <div class="img"></div>
            </div>
            <div class="KV-ttl">
                <h2 class="TL">
                    <img
                        class="pc"
                        src="<?php echo get_template_directory_uri(); ?>/img/KV/KV-about-ttl-pc.svg"
                        alt="いのちの協奏曲をつむぐ。つむぎクリニック"
                    />
                    <img
                        class="sp"
                        src="<?php echo get_template_directory_uri(); ?>/img/KV/KV-about-ttl-sp.svg"
                        alt="いのちの協奏曲をつむぐ。つむぎクリニック"
                    />
                </h2>
            </div>
        </div>
        <div class="KV-bg">
            <div class="KV-bg_top"></div>
            <div class="KV-bg_bottom">
                <div class="KV-bg_bottom-inner">
                    <div class="txt">
                        <p class="TX">
                            クリニックの主人公は<br class="sp" />医師ではありません。<br />
                            ステージのセンターに立つのは、<br />
                            お母さんと赤ちゃんと<br class="sp" />ご家族のみなさまです。<br />
                            医師や助産師や看護師は、<br />
                            そのまわりで寄り添いながら<br class="sp" />演奏する伴奏者です。<br />
                            あなたといっしょに<br class="sp" />奏でたいものがあります。<br />
                            それは『いのちの協奏曲』です。<br />
                            未来へつづく美しいメロディを、<br class="sp" />リズムを、ハーモニーを、<br />
                            みんなの合奏でつむぎましょう。
                        </p>
                    </div>
                    <div class="logo">
                        <img
                            src="<?php echo get_template_directory_uri(); ?>/img/KV/KV-about-logo.svg"
                            alt="いのちの協奏曲をつむぐ。つむぎクリニック"
                        />
                        <div class="note fade-note"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <?php endif; ?>

  <!-- gynecology -->
  <?php if (is_page('gynecology')): ?>
  <section class="KV-other">
      <div class="C_KV-title type-01">
          <div class="icon icon-01"></div>
          <h2 class="TL">婦人科</h2>
      </div>
      <div class="decoration deco-gynecology">
          <div class="note"></div>
          <div class="char">
              <div class="txt pc">
                  <p class="TX">
                      最新情報は<a
                          class="hover-opa"
                          href="https://www.instagram.com/tsumugi7810/"
                          target="_blank"
                          rel="noopener noreferrer"
                          >Instagram</a
                      >でも<br />お伝えしています。
                  </p>
              </div>
          </div>
      </div>
  </section>
  <?php endif; ?>


  <!-- obstetrics -->
  <?php if (is_page('obstetrics')): ?>
    <section class="KV-other">
    <div class="C_KV-title type-01">
        <div class="icon icon-02"></div>
        <h2 class="TL">産科</h2>
    </div>
    <div class="decoration deco-obstetrics">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
  <?php endif; ?>

  <!-- delivery -->
  <?php if (is_page('delivery')): ?>
    <section class="KV-other">
    <div class="C_KV-title type-01">
        <div class="icon icon-03"></div>
        <h2 class="TL TL-img">
            <img src="<?php echo get_template_directory_uri(); ?>/img/C_KV-title-img.svg" alt="無痛分娩について" />
        </h2>
    </div>
    <div class="decoration deco-delivery">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
  <?php endif; ?>

  <!-- guidance -->
  <?php if (is_page('guidance')): ?>
    <section class="KV-other">
    <div class="C_KV-title type-02">
        <div class="icon icon-04"></div>
        <h2 class="TL">入院案内</h2>
    </div>
    <div class="decoration deco-guidance">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
  <?php endif; ?>

  <!-- news -->
  <?php if (is_archive('news') || is_singular('post')): ?>
  <section class="KV-other">
    <div class="C_KV-title type-02">
        <div class="icon icon-05"></div>
        <h2 class="TL">お知らせ</h2>
    </div>
    <div class="decoration deco-news">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
<?php endif; ?>


  <!-- faq -->
  <?php if (is_page('faq')): ?>
<section class="KV-other">
    <div class="C_KV-title type-02">
        <div class="icon icon-06"></div>
        <h2 class="TL">よくある質問</h2>
    </div>
    <div class="decoration deco-faq">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
<?php endif; ?>


<!-- recruitment -->
<?php if (is_page('recruit')): ?>
<section class="KV-other">
    <div class="C_KV-title type-02">
        <div class="icon icon-07"></div>
        <h2 class="TL">採用情報</h2>
    </div>
    <div class="decoration deco-recruitment">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
<?php endif; ?>

<!-- contact -->
<?php if (is_page('contact')): ?>
<section class="KV-other">
    <div class="C_KV-title type-01">
        <div class="icon icon-08"></div>
        <h2 class="TL">お問い合わせ</h2>
    </div>
    <div class="decoration deco-contact">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
<?php endif; ?>


<!-- standard -->
<?php if (is_page('standard')): ?>
<section class="KV-other">
    <div class="C_KV-title type-01">
        <div class="icon icon-09"></div>
        <h2 class="TL">施設基準</h2>
    </div>
    <div class="decoration deco-standard">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
<?php endif; ?>


<!-- policy -->
<?php if (is_page('policy')): ?>
<section class="KV-other">
    <div class="C_KV-title type-01">
        <div class="icon icon-10"></div>
        <h2 class="TL TL-small">プライバシーポリシー</h2>
    </div>
    <div class="decoration deco-policy">
        <div class="note"></div>
        <div class="char"></div>
    </div>
</section>
<?php endif; ?>



<?php endif; ?>
