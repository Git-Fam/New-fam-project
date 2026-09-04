<?php
/*
Template Name: message
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>


<!-- 独自ページ --start -->
<div class="page-message">
  <div class="message--bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/message/message_kv-bg-pc.webp" media="(min-width: 768px)"
        type="image/svg+xml">
      <img src="<?php echo get_template_directory_uri(); ?>/img/message/message_kv-bg-sp.webp">
    </picture>
  </div>
  <section class="message_kv">
    <div class="message-inner">
      <h2 class="TL">
        <picture>
          <source srcset="<?php echo get_template_directory_uri(); ?>/img/message/message_kv-ttl-pc.svg" media="(min-width: 768px)"
            type="image/svg+xml">
          <img src="<?php echo get_template_directory_uri(); ?>/img/message/message_kv-ttl-sp.svg" alt="TOP MESSAGE 理事長メッセージ">
        </picture>
      </h2>
    </div>
  </section>

  <section class="message_sec">
    <div class="message-inner">
      <div class="txt anime-fade">
        <p class="TX">
          甲子園学院の歩みは80余年。<br class="pc">
          この長い歴史の中で学院はさまざまな変化と進化を遂げてまいりました。<br class="pc">
          昭和16年に甲子園高等女学校として産声を上げた本学院が、<br class="pc">
          現在の幼稚園から大学・大学院までを擁する総合学園に発展したことは、<br class="pc">
          最も大きな変化であり進化です。<br class="pc">
          しかし一方で、変えてはいけないものがあります。<br class="pc">
          それこそが「黽勉努力」「和衷協同」「至誠一貫」の<br class="pc">
          校訓三綱領に顕される建学の精神です。<br class="pc">
          この建学の精神を次の時代に伝えるべく、<br class="pc">
          本学院として「学ぶことは、心を磨くこと」という言葉を掲げました。<br class="pc">
          全ての源は「心」にあります。<br class="pc">
          久米長八校祖の時代より、学院は心を育てる教育を実践し、<br class="pc">
          多くの人材を輩出してきました。<br class="pc">
          学院を愛する心、仲間を慈しむ心、そして先人への感謝の心。<br class="pc">
          そのような心を大切にこれまで歩んでまいりましたが、<br class="pc">
          ここでその足跡を今一度確認し、<br class="pc">
          改めて心に刻みながら、来たる90年、100年に向かって<br class="pc">
          新しい一歩を踏み出していきたいと思っております。<br class="pc">
          これからの甲子園学院の歩みに、<br class="pc">
          皆様の一層のご支援とご協力をお願い申し上げ、ご挨拶といたします。
        </p>
        <p class="name">
          <span>学校法人 甲子園学院<br>理事長･学院長</span><br>
          久米 知子
        </p>
      </div>
    </div>
  </section>

</div>
<!-- 独自ページ --end -->

<?php get_template_part('./inc/footer'); ?>