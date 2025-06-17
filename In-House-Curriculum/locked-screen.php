<?php
get_header();
?>




 <div class="lock">
  <div class="lock-board">
    <div class="lock-wrap">
      <div class="lock-inner">
        <div class="lock-title">まだ見れないよ！</div>
          <div class="lock-message">
            前のセクションの完了ボタンを<br class="sp">クリックすると見れるようになるよ。<br>
            クイズがあるセクションは<br class="sp">クイズに合格するとボタンが表示されるよ！
          </div>
        <a class="lock-link" href="<?php echo esc_url(get_permalink($prev_post_id)); ?>">前の記事に戻る</a>
        <div class="lock-chara"></div>
      </div>
    </div>
  </div>
</div>



<?php
get_footer();
?>