<?php get_header(); ?>

<div class="entry singin">
    <div class="entry--letter"></div>
    <div class="entry--sheet">
        <div class="entry--sheet--title">
            <h2 class="TL">アカウント登録</h2>
        </div>
        <div class="entry--sheet--inputs">
            <?php echo do_shortcode('[swpm_registration_form]'); ?>
        </div>
    </div>
</div>


<script>
    jQuery(document).ready(function($) {
        // 都道府県リスト
        var prefectures = [
            '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
            '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
            '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県',
            '岐阜県', '静岡県', '愛知県', '三重県',
            '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
            '鳥取県', '島根県', '岡山県', '広島県', '山口県',
            '徳島県', '香川県', '愛媛県', '高知県',
            '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
        ];
        var options = '<option value="">選択してください</option>';
        prefectures.forEach(function(pref) {
            options += '<option value="' + pref + '">' + pref + '</option>';
        });
        var addressStateField = `
    <div class="swpm-form-row swpm-address-state-row">
        <div  class="swpm-form-label-wrap swpm-form-email-label-wrap">
            <label for="address_state">都道府県</label>
      </div>
      <div class="swpm-form-input-wrap swpm-form-email-input-wrap">
        <select id="address_state" name="address_state" required>\n${options}\n</select>
      </div>
    </div>
  `;
        // メール欄の後に挿入（適宜セレクタを調整してください）
        $('input[name="email"]').closest('.swpm-form-row').after(addressStateField);
    });
</script>

<?php get_footer(); ?>