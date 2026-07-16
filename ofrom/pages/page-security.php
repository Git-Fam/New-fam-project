<?php
/*
Template Name: security
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<!-- 独自 -->
<div class="security_kv">
  <div class="bg">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/img/security/security_kv-sp.webp" media="(max-width: 767px)">
      <img src="<?php echo get_template_directory_uri(); ?>/img/security/security_kv.webp">
    </picture>
  </div>
  <div class="sent_wrap">
    <h2 class="TL">
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/img/security/security_ttl-sp.svg" media="(max-width: 767px)">
        <img src="<?php echo get_template_directory_uri(); ?>/img/security/security_ttl.svg" alt="SECURITY POLICY / 情報セキュリティー基本方針">
      </picture>
    </h2>
  </div>
</div>
<main class="page_main_contents">
  <div class="page_security">

    <section id="security_sec_01" class="security_type_section">
      <div class="all_sec_inner">
        <div class="top_sent">
          <p class="TX">
            オフロム株式会社（以下、当社）は、当社の情報資産を事故・災害・犯罪などの脅威から守り、<br>
            お客様ならびに社会の信頼に応えるべく、以下の方針に基づき全社で情報セキュリティに取り組みます。
          </p>
        </div>

        <ul class="security_list">
          <li class="security_item">
            <div class="ttl">
              <h3 class="TL">1,経営者の責任</h3>
            </div>
            <div class="txt">
              <p class="TX">
                当社は、経営者主導で組織的かつ継続的に情報セキュリティの改善・向上に努めます。
              </p>
            </div>
          </li>
          <li class="security_item">
            <div class="ttl">
              <h3 class="TL">2,社内体制の整備</h3>
            </div>
            <div class="txt">
              <p class="TX">
                当社は、情報セキュリティの維持及び改善のために組織を設置し、<br class="pc">情報セキュリティ対策を社内の正式な規則として定めます。
              </p>
            </div>
          </li>
          <li class="security_item">
            <div class="ttl">
              <h3 class="TL">3,従業員の取組み</h3>
            </div>
            <div class="txt">
              <p class="TX">
                当社の従業員は、情報セキュリティのために必要とされる知識、技術を習得し、<br class="pc">情報セキュリティへの取り組みを確かなものにします。
              </p>
            </div>
          </li>
          <li class="security_item">
            <div class="ttl">
              <h3 class="TL">4,法令及び契約上の要求事項の遵守</h3>
            </div>
            <div class="txt">
              <p class="TX">
                当社は、情報セキュリティに関わる法令、規制、規範、契約上の義務を遵守するとともに、<br class="pc">お客様の期待に応えます。
              </p>
            </div>
          </li>
          <li class="security_item">
            <div class="ttl">
              <h3 class="TL">5,違反及び事故への対応</h3>
            </div>
            <div class="txt">
              <p class="TX">
                当社は、情報セキュリティに関わる法令違反、契約違反及び事故が発生した場合には適切に対処し、<br class="pc">再発防止に努めます。
              </p>
            </div>
          </li>
          <li class="security_item">
            <div class="txt">
              <p class="TX">
                制定日：2025年7月1日<br>
                オフロム株式会社<br>
                代表取締役社長　笈田寿宏
              </p>
            </div>
          </li>
        </ul>
      </div>
    </section>


  </div>
</main>
<!-- 独自 end -->

<?php get_template_part('./inc/footer'); ?>