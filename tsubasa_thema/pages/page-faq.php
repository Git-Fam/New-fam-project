<?php
/*
Template Name: よくある質問
Template Post Type: page
Template Path: pages/
*/

?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="page-faq">
  <section class="C_kv">
    <div class="C_kv-board">
      <h2 class="TL">よくある質問</h2>
    </div>
    <div class="C_kv-char">
      <div class="char-06">
        <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_kv-char-06.webp" alt="">
      </div>
    </div>
  </section>

  <section class="faq-contents">

    <nav class="faq-contents-nav">
      <ul class="faq-contents-nav-list">
        <li class="item">
          <a href="#item-01" class="TX">当院について</a>
        </li>
        <li class="item">
          <a href="#item-02" class="TX">診療について</a>
        </li>
        <li class="item">
          <a href="#item-03" class="TX">手術について</a>
        </li>
      </ul>
    </nav>

    <div class="faq-contents-inr">
      <div class="faq-contents-inr-item" id="item-01">
        <div class="C_front-ttl">
          <div class="wing left-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
          <h3 class="TL">当院について</h3>
          <div class="wing right-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
        </div>
        <ul class="item-wrap">
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                駐車場はありますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                当院正面と裏面に無料駐車場がございます。空いているお好きな箇所にご自由にお停めください。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                領収書を紛失してしまいました。再発行はできますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                医療機関で発行される領収書は税の申告にも利用されるものであり、二重利用（不正請求）のリスクがあるため、領収書の再発行はできません（当院発行の領収書にも明記されています）。<br>
                代案として支払証明書を新たに作成して発行することは可能ですが、手数料を頂きますのでご了承ください。<br>
                領収書はくれぐれも紛失のないようにお気をつけください。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                おむつ替え・授乳スペースはありますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                おむつ交換台は患者用トイレ内に設置しております。交換したオムツはお持ち帰りください。ご希望の方はビニール袋をお渡しします。<br>
                授乳専用のスペースは設けておりませんが、ご希望の方はお申し出いただければ対応いたします。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                キッズスペースはありますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                ございます。お子さんが飽きないようにテレビでアニメDVDを流しております。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                ベビーカーのまま院内に入れますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                院内へは入れませんが、正面入り口横にベビーカー置き場がございます。ご自由にご利用ください。
              </p>
            </div>
          </li>
        </ul>
      </div>
      <div class="faq-contents-inr-item" id="item-02">
        <div class="C_front-ttl">
          <div class="wing left-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
          <h3 class="TL">診療について</h3>
          <div class="wing right-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
        </div>
        <ul class="item-wrap">
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                初診は、どのようにすればよいですか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                初診からWeb予約が可能です。Web予約をお取りの後、Web問診の入力にお進みください。発熱診療以外の方はご予約なしで直接来院していただいても診察させていただきますが、予約の方が優先的に診察となることをあらかじめご了承ください。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                ケガや熱傷も見てもらえますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                もちろんです。トゲを抜く、傷を縫合する(縫う)、熱傷の処置など診療時間中いつでも緊急対応します。ただし、診察後に重症の場合は病院をご紹介することもあります。もちろん、傷をきれいにすることにもこだわっています。
                かかりつけご登録の方は、LINE相談で受診の必要性を相談もしていただけます。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                何歳まで受診可能ですか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                当院に初めてかかる患者さんは、中学校卒業までの方を対象とさせていただいております。高校生以上の方は内科への受診をお願いいたします。<br>
                ただし、アレルギー疾患などで継続治療を行っている方は、本人が小児科を気にしていなければ何歳になって来ていただいても構いません。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                付き添いの親の診察も可能ですか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                平熱で基礎疾患の特にお持ちではない比較的元気な風邪程度の方の診療であれば可能ですが、その場合はお子さんの付き添いで来院された保護者の方のみとさせていただきます。当院は小児専門のクリニックですので成人の方のみの診察や祖父母の方の診察は内科への受診をお願いいたします。＊高校生以上の発熱の診療は当院では行っておりません。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                こどもを1人で受診させたいのですが可能ですか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                軽症と思って受診されても精密検査が必要となったり、行った治療や検査などについて後ほど保護者の方からお問い合わせいただくケースがございます。<br>
                したがって当院では原則として18歳未満の方については保護者の方と一緒のご来院をお願いしております。<br>
                どうしても同伴できない場合は、必ず電話連絡がつくようにしていただき院内備え付けの同意書をご記入の上、持参をお願いします。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                こどもは連れて行かずお薬のみ処方をしていただくことは可能ですか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                保険診療上、診察なしでの処方箋発行はできません。喘息の治療薬や皮膚の乾燥、アトピー性皮膚炎の軟膏、舌下免疫療法などの定期処方薬についても毎回患児本人の診察も必要となりますので、どうぞ宜しくお願いします。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                お薬は何日分まで処方できるのでしょうか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                通常の風邪や胃腸炎、発熱などの急性疾患は最長7日分まで、喘息・アトピー・便秘・乾燥肌などの慢性疾患は原則で最長<br>30日分までの処方とさせていただきます。なお昨今の医薬品の深刻な供給不足により、これより短い処方となることもございますのであらかじめご了承ください。
              </p>
            </div>
          </li>

        </ul>
      </div>
      <div class="faq-contents-inr-item" id="item-03">
        <div class="C_front-ttl">
          <div class="wing left-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
          <h3 class="TL">手術について</h3>
          <div class="wing right-wing">
            <img src="<?php echo get_template_directory_uri(); ?>/img/common/C_front-ttl-wing.svg" alt="">
          </div>
        </div>
        <ul class="item-wrap">
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                手術費用・入院期間は事前に分かりますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                入院費用概算については入院説明時にお調べすることができますのでお尋ねください。入院期間については病気の種類によって様々ですが、入院説明時におおよその期間をお伝えいたします。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                手術前はどんな検査をしますか？
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                病気の種類によって行う検査は様々です。一般的には血液検査・心電図検査・レントゲン検査があります。麻酔の種類によっては呼吸機能検査を行うこともあります。また、手術前に麻酔科の診察を受けていただく場合もございます。
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                こどもに手術のことを伝えるタイミングを迷っています。
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                お子さんの性格や発達の個人差にもよりますが、下記を目安にしてみて下さい。年齢にとらわれず、お子さんの不安や入院経験なども合わせて調節してください。<br>
                <br>
                ・2～3,4歳：1日もしくは2日前<br>
                ・4～7,8歳：3,4日前くらい<br>
                ・7,8歳～：一週間前くらい
              </p>
            </div>
          </li>
          <li class="item">
            <div class="item-q">
              <h4 class="TL">
                こどもが手術を怖がっているのですがどうしたら良いでしょうか。
              </h4>
            </div>
            <div class="item-a">
              <p class="TX">
                “心の準備”として絵本を利用する方法があります。ファンタジーの要素が強いお話は、“心の準備”には向いていないかもしれません。しかし、入院経験があって病院の様子をある程度わかっているような場合には、おもしろおかしく病院を見てみたり、自分の過去の経験を話すきっかけとなるかもしれません。下記おすすめの本をご紹介します。<br>
                <br>
                ・ガスパールびょういんへいく（ブロンズ新社）<br>
                ・うさこちゃんのにゅういん（福音館書店）<br>
                ・ひとまねこざるびょういんへいく（岩波書店）<br>
                ・ノンタンがんばるもん（偕成社）<br>
                ・さるのせんせいとへびのかんごふさん（ビリケン出版）
              </p>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </section>
</div>

<?php get_template_part('./inc/footer'); ?>