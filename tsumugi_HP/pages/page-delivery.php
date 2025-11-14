<?php
/*
Template Name: delivery
Template Post Type: page
Template Path: pages/
*/
?>

<?php get_template_part('./inc/head'); ?>
<?php get_template_part('./inc/header'); ?>

<div class="delivery-page">
    <section class="sec_delivery_contents">
        <div class="C_delivery_contents">
            <div class="delivery_contents-btn">
                <ul>
                    <li>
                        <a class="hover-opa" href="#delivery_contents-01">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-btn-01.svg" alt="メリット" />
                        </a>
                    </li>
                    <li>
                        <a class="hover-opa" href="#delivery_contents-02">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-btn-02.svg" alt="リスクと注意点" />
                        </a>
                    </li>

                    <li>
                        <a class="hover-opa" href="#delivery_contents-03">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-btn-03.svg" alt="私たちの考え" />
                        </a>
                    </li>

                    <li>
                        <a class="hover-opa" href="#delivery_contents-04">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-btn-04.svg" alt="推奨される場合" />
                        </a>
                    </li>

                    <li>
                        <a class="hover-opa" href="#delivery_contents-05">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-btn-05.svg" alt="担当医について" />
                        </a>
                    </li>
                </ul>
            </div>
            <div class="delivery_contents">
                <div class="item" id="delivery_contents-01">
                    <div class="item-inner">
                        <h3 class="TL">
                            <img
                                class="pc"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-01-pc.svg"
                                alt="無痛分娩のメリット"
                            />
                            <img
                                class="sp"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-01-sp.svg"
                                alt="無痛分娩のメリット"
                            />
                        </h3>
                        <div class="img">
                            <img
                                class="pc"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-img-01-pc.webp"
                                alt="陣痛の痛みを軽減できる/妊娠中から不安・恐怖が和らぐ/リラックスしてお産に臨める/産後の体の負担も減らせる"
                            />
                            <img
                                class="sp"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-img-01-sp.webp"
                                alt="陣痛の痛みを軽減できる/妊娠中から不安・恐怖が和らぐ/リラックスしてお産に臨める/産後の体の負担も減らせる"
                            />
                        </div>
                        <div class="txt">
                            <p class="TX">
                                当院では妊産婦様の希望に応じ、分娩方法の<span>選択肢のひとつ</span>として無痛分娩（硬膜外麻酔分娩）を選択することができます。「産みの苦しみ」という言葉が象徴するように、これまでは赤ちゃんを産むために、「陣痛」という極限的痛みに耐え抜かなければなりませんでした。しかし、無痛分娩の普及によって、この<span>痛みは緩和</span>され（平均７-８割の軽減とされています）、その事によるメリットは<span>分娩そのもののみならず産前、そして産後</span>にも非常に大きいものであることがわかってきました。<br />
                                <br />
                                このメリットは陣痛が始まってからのみではなく、「無痛分娩という選択肢がある」という思いが、<span>妊娠期間中から痛みに対する不安や恐れを緩和</span>し精神的安定を提供することにより、リラックスした準備期間を過ごせているということがわかってきました。<br />
                                <br />
                                また分娩進行中にも過度の<span>「力み」から解放</span>され、全身がリラックスして産後も筋骨格に対する余分な後遺症的負担が軽減しているという報告もあります。
                            </p>
                        </div>
                    </div>
                    <div class="char"></div>
                </div>

                <div class="item" id="delivery_contents-02">
                    <div class="item-inner">
                        <h3 class="TL">
                            <img
                                class="pc"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-02-pc.svg"
                                alt="無痛分娩のリクスと注意点"
                            />
                            <img
                                class="sp"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-02-sp.svg"
                                alt="無痛分娩のリクスと注意点"
                            />
                        </h3>
                        <div class="img">
                            <img
                                class="pc"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-img-02-pc.webp"
                                alt="誤投与時の重い副作用のリスク/陣痛の微弱化による分娩の延長/赤ちゃんの回旋異常増加の可能性/追加処置が必要になる可能性"
                            />
                            <img
                                class="sp"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-img-02-sp.webp"
                                alt="誤投与時の重い副作用のリスク/陣痛の微弱化による分娩の延長/赤ちゃんの回旋異常増加の可能性/追加処置が必要になる可能性"
                            />
                        </div>
                        <div class="txt">
                            <p class="TX">
                                <span>硬膜外麻酔という医療介入は諸刃の剣</span
                                >であり、重大な副作用が生じる場合があります。硬膜外麻酔のチューブが血管の中や脊髄くも膜腔に迷入してしまい、このことから局所麻酔中毒や<span>全脊髄麻酔へ発展してしまう場合がある</span>ことも知っておかなければならないでしょう（チューブの迷入そのものが問題なのではなくそれときづかれないまま麻酔薬が注入されることが問題となっています）。<br />
                                <br />
                                また陣痛が絶対的（客観的）に微弱化することにより、分娩所要時間が延長したり、赤ちゃんの回旋異常が生じる頻度が増え、これらを是正するための<span>更なる医療介入</span>として「分娩促進剤（プロスタグランジンF2αまたはオキシトシン製剤）」を用いた陣痛の強化が必要となる場合もあります。
                            </p>
                        </div>
                    </div>
                    <div class="char">
                        <div class="note"></div>
                    </div>
                </div>

                <div class="item" id="delivery_contents-03">
                    <div class="item-inner">
                        <h3 class="TL">
                            <img
                                class="pc"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-03-pc.svg"
                                alt="私たちの考え"
                            />
                            <img
                                class="sp"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-03-sp.svg"
                                alt="私たちの考え"
                            />
                        </h3>
                        <div class="txt">
                            <p class="TX">
                                当クリニックでの無痛分娩を希望される妊産婦様により深く「硬膜外麻酔無痛分娩」を理解していただき「主体的選択」をしていただくための説明書を準備しております。痛みから解放されたとしても、連綿と命をつむいできた分娩機転にはなんの変化もありません。産むのはあなたご自身です。<span>「無痛分娩だからこそ」</span>、日々の食事習慣や体の動かし方、それに備えた<span>「体づくり」</span>が最も大切だと私たちは考えています。
                            </p>
                        </div>
                    </div>
                    <div class="char"></div>
                </div>

                <div class="item" id="delivery_contents-04">
                    <div class="item-inner">
                        <h3 class="TL">
                            <img
                                class="pc"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-04-pc.svg"
                                alt="推奨される場合"
                            />
                            <img
                                class="sp"
                                src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_contents-ttl-04-sp.svg"
                                alt="推奨される場合"
                            />
                        </h3>
                        <div class="txt">
                            <p class="TX">
                                無痛分娩の導入に関しては、妊産婦様のご希望によるもののみならず、遷延分娩、妊娠高血圧症候群、精神疾患や心疾患を有する妊産婦様に対する<span>医学的適応</span>により選択される場合があります。<br />
                                ※現段階の医療制度では、医学的適応があっても保険適応はございません
                            </p>
                        </div>
                    </div>
                    <div class="char">
                        <div class="note"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sec_delivery_doctor">
        <div class="C_sec_ttl">
            <div class="icon icon-14"></div>
            <h3 class="TL">担当医について</h3>
        </div>
        <div class="C_delivery_doctor" id="delivery_contents-05">
            <h4 class="TL">
                <img class="pc" src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_doctor-name-pc.svg" alt="院長　野村 一人" />
                <img class="sp" src="<?php echo get_template_directory_uri(); ?>/img/delivery/delivery_doctor-name-sp.svg" alt="院長　野村 一人" />
            </h4>
            <div class="txt">
                <p class="TX">
                    院長の野村一人医師は金沢大学医学部附属病院(1997年当時。現
                    金沢大学附属病院)の<span>麻酔科で実地研修を修了</span>しており、術中全身麻酔下等における安全な全身循環管理についても十分な知識並びに技術に習熟いたしております。
                </p>
            </div>
        </div>
    </section>
    <div class="sec-decoration">
        <div class="img img-01 pc">
            <div class="char"></div>
        </div>
        <div class="img img-02">
			<div class="char"></div>
        </div>
    </div>
</div>

<?php get_template_part('./inc/footer'); ?>
