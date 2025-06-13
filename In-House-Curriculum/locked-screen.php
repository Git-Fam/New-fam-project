<?php
get_header();
?>



<!-- <main style="display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:70vh;">
    <div style="background:#fff8f6; border:2px solid #ffafaf; padding:3em 2em; border-radius:1.2em; max-width:400px; text-align:center;">
        <svg width="60" height="60" viewBox="0 0 24 24" style="margin-bottom:1em;"><path fill="#d90000" d="M12 2a5 5 0 0 0-5 5v4a1 1 0 0 0 2 0V7a3 3 0 0 1 6 0v4a1 1 0 0 0 2 0V7a5 5 0 0 0-5-5Zm6 10h-1v-2a7 7 0 0 0-14 0v2h-1a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2ZM6 10V7a6 6 0 1 1 12 0v3H6Zm-2 2h16v8H4v-8Z"/></svg>
        <h1 style="color:#d90000;">アクセスできません</h1>
        <p>前の記事を100％まで完了してください。</p>
        <a href="<?php echo esc_url(get_permalink($prev_post_id)); ?>" style="display:inline-block; margin-top:1.5em; padding:0.7em 2em; background:#0073aa; color:#fff; border-radius:5px; text-decoration:none;">前の記事に戻る</a>
    </div>
</main> -->

<!-- <div class="bg-white border-2 border-red-300 rounded-2xl shadow-xl p-8 max-w-md mx-auto text-center">
  <div class="mb-4">
    <svg class="mx-auto" width="48" height="48" ...>（鍵アイコンSVGなど）</svg>
  </div>
  <h1 class="text-red-600 text-2xl font-bold mb-2">進捗ロック中</h1>
  <p class="mb-6 text-gray-600">前の記事の進捗を100％にすると、このページが開放されます。</p>
  <a href="前の記事のURL" class="inline-block px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">前の記事へ</a>
</div>
 -->


 <div class="lock-bg">
  <div class="lock-board">
    <div class="lock-title">LOCKED</div>
    <div class="lock-message">
      このページはまだ見られません<br>
      前の記事の進捗バーを100％にすると、<br>
      このページが解放されるよ！
      <div class="lock-bubble">まだロック中…</div>
    </div>
    <div class="lock-bear">
      <!-- シンプルなくま。画像に変える場合はimgタグでOK！ -->
      <div class="bear-face">
        <div class="bear-ear left"></div>
        <div class="bear-ear right"></div>
        <div class="bear-eye left"></div>
        <div class="bear-eye right"></div>
        <div class="bear-mouth"></div>
        <div class="bear-cheek left"></div>
        <div class="bear-cheek right"></div>
      </div>
    </div>
    <a href="<?php echo esc_url(get_permalink($prev_post_id)); ?>" style="display:inline-block; margin-top:1.5em; padding:0.7em 2em; background:#0073aa; color:#fff; border-radius:5px; text-decoration:none;">前の記事に戻る</a>

  </div>
</div>

<style>
.lock-bg {
  min-height: 100vh;
  background: linear-gradient(180deg, #c3e8fa 0%, #e5f6de 100%);
  display: flex;
  justify-content: center;
  align-items: center;
}
.lock-board {
  background: #34724b;
  border: 6px solid #bb8857;
  border-radius: 20px;
  box-shadow: 0 6px 30px #b8c8af80;
  padding: 2.5em 2.5em 2.2em 2.5em;
  text-align: center;
  min-width: 340px;
  max-width: 98vw;
  position: relative;
}
.lock-title {
  font-family: 'Montserrat', 'Arial Rounded MT Bold', Arial, sans-serif;
  font-size: 2.1em;
  font-weight: bold;
  color: #fff3b0;
  margin-bottom: 0.5em;
  letter-spacing: 0.04em;
  text-shadow: 0 2px 0 #265031, 0 0 2px #fff;
}
.lock-message {
  color: #fffbe2;
  font-size: 1.12em;
  line-height: 1.6;
  margin-bottom: 1em;
  font-family: 'Kosugi Maru', 'Rounded Mplus 1c', 'Yu Gothic', sans-serif;
}
.lock-bubble {
  display: inline-block;
  margin: 1em auto 0 auto;
  padding: 0.3em 1em;
  background: #fff;
  border-radius: 12px;
  color: #666;
  font-size: 0.99em;
  box-shadow: 0 1px 4px #0002;
  position: relative;
}
.lock-bubble::before {
  content: "";
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  top: 100%;
  width: 20px;
  height: 16px;
  background: transparent;
  border-left: 10px solid transparent;
  border-right: 10px solid transparent;
  border-top: 12px solid #fff;
}
.lock-bear {
  margin: 1em 0 1.6em 0;
  display: flex;
  justify-content: center;
}
.bear-face {
  position: relative;
  width: 82px;
  height: 72px;
  background: #fffde8;
  border-radius: 48px 48px 42px 42px / 45px 45px 37px 37px;
  box-shadow: 0 1px 4px #0001;
}
.bear-ear {
  position: absolute;
  top: -18px;
  width: 28px;
  height: 28px;
  background: #fffde8;
  border-radius: 50%;
  border: 3px solid #bb8857;
  z-index: 1;
}
.bear-ear.left  { left: -13px; }
.bear-ear.right { right: -13px; }
.bear-eye {
  position: absolute;
  top: 31px;
  width: 8px;
  height: 8px;
  background: #554f4b;
  border-radius: 50%;
}
.bear-eye.left { left: 23px; }
.bear-eye.right { right: 23px; }
.bear-mouth {
  position: absolute;
  top: 45px;
  left: 50%;
  width: 17px;
  height: 13px;
  border-radius: 0 0 13px 13px / 0 0 14px 14px;
  border-bottom: 2px solid #554f4b;
  transform: translateX(-50%);
}
.bear-cheek {
  position: absolute;
  top: 47px;
  width: 10px;
  height: 10px;
  background: #ffe1b4;
  border-radius: 50%;
  opacity: 0.82;
}
.bear-cheek.left  { left: 13px; }
.bear-cheek.right { right: 13px; }
.lock-btn {
  display: inline-block;
  background: linear-gradient(180deg, #ffa82d 0%, #ffb960 100%);
  color: #fff;
  font-weight: bold;
  font-size: 1.12em;
  border-radius: 100px;
  padding: 0.8em 2.5em;
  text-decoration: none;
  margin-top: 0.2em;
  box-shadow: 0 2px 8px #ffb44f2a;
  transition: background 0.15s;
  letter-spacing: 0.06em;
  border: none;
}
.lock-btn:hover {
  background: #ff9100;
}
@media (max-width: 600px) {
  .lock-board { padding: 1.1em 0.3em; min-width: 0; }
  .bear-face { width: 64px; height: 54px; }
}
</style>


<?php
get_footer();
?>