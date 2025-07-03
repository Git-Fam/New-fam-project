<?php
/*
Template Name: Test Fitting
*/

get_header(); ?>

<div class="container">
  <h1>試着機能テスト</h1>

  <div class="fitting-test">
    <div class="character-display">
      <h2>キャラクター表示エリア</h2>
      <?php display_character(); ?>
    </div>

    <div class="fitting-controls">
      <h2>試着コントロール</h2>
      <p>アバターページでアイテムを選択すると、ここにリアルタイムで反映されます。</p>
      <a href="<?php echo get_permalink(get_page_by_path('avatar')); ?>" class="button">アバターページへ</a>
    </div>
  </div>
</div>

<style>
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
  }

  .fitting-test {
    display: flex;
    gap: 40px;
    margin-top: 30px;
  }

  .character-display {
    flex: 1;
    border: 2px solid #ddd;
    padding: 20px;
    border-radius: 10px;
  }

  .fitting-controls {
    flex: 1;
    border: 2px solid #ddd;
    padding: 20px;
    border-radius: 10px;
  }

  .display__character {
    position: relative;
    width: 300px;
    height: 400px;
    margin: 0 auto;
    border: 1px solid #ccc;
    background: #f9f9f9;
  }

  .display__character img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
  }

  .button {
    display: inline-block;
    padding: 10px 20px;
    background: #007cba;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 10px;
  }

  .button:hover {
    background: #005a87;
  }
</style>

<?php get_footer(); ?>