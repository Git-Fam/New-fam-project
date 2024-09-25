<!DOCTYPE html>
<html lang="ja">

<head prefix="og: https://ogp.me/ns#">
    <?php
    include('./includes/functions.php');

    $dev = getDevPath();

    $title = ' | Q&A';
    $description = '';
    $url = '/qa.php';
    include('./includes/head.php');
    ?>

    <!-- ▼フォント -->
</head>

<body>
    <?php include('./includes/header.php'); ?>
    <div class="whopper">
        <?php
        $section = 'qa';
        include('./includes/kv.php');
        ?>

        <main>
            <div class="wrap">
                <div class="qa wrap-sp">
                    <section class="qa__prevalent">
                        <div class="qa__prevalent--top">
                            <div class="C_Title">
                                <div class="C_Water_drop">
                                    <div class="icon"></div>
                                    <div class="icon"></div>
                                    <div class="icon"></div>
                                </div>
                                <div class="C_Title--title">
                                    <h3 class="TL">よくあるご質問</h3>
                                </div>
                            </div>
                            <div class="qa__prevalent--top--text">
                                <p class="TX">
                                    当社のサービスについて、お客様からよくいただくご質問とご回答をまとめております。
                                </p>
                            </div>
                        </div>
                        <div class="qa__prevalent--links">
                            <div class="C_linkIn">
                                <a href="#hozon" class="C_linkIn--item hover-opa" id="link-hozon">
                                    <p class="TX">HOZON</p>
                                </a>
                                <a href="#seiton" class="C_linkIn--item hover-opa" id="link-seiton">
                                    <p class="TX">SEITON</p>
                                </a>
                                <a href="#medical" class="C_linkIn--item hover-opa" id="link-medical">
                                    <p class="TX">メディカルレスキュー</p>
                                </a>
                                <a href="#life" class="C_linkIn--item hover-opa" id="link-life">
                                    <p class="TX">ライフレスキュー</p>
                                </a>
                            </div>
                        </div>
                        <div class="qa__prevalent--content">

                            <div class="content--item" id="hozon">
                                <div class="item--title">
                                    <h4 class="TL">HOZON</h4>
                                </div>
                                <div class="item--container">
                                    <div class="C_qa">
                                        <ul class="C_qa-list">
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">登録できません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            以下をご確認ください。<br /><br />
                                                            <span class="bold">・アクティベーションコードが有効かどうかご確認ください。</span><br>
                                                            アクティベーションコードをご入力時に赤字の場合はそのアクティベーションコードは無効となっております。<br><br>
                                                            <span class="bold">・すでにご利用済みのメールアドレスを使用していないかご確認ください。</span><br>
                                                            もし、お客様がHOZONへのご登録が2回目以降の場合、すでにHOZONにご登録いただいているメールアドレスではご登録ができません。他のメールアドレス（SNSアカウント）をご利用ください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">ログインできません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            ご登録いただいた方法によって、解決方法が異なりますので以下の各項目をご確認ください。<br><br>
                                                            <span class="bold">①メールアドレスでログインできません。</span><br>
                                                            入力したメールアドレスまたはパスワードがご登録時と異なっている可能性があります。 <br>
                                                            「認証情報と一致するレコードがありません。」と表示された場合は、メールアドレスとパスワードが正しいかお確かめください。<br>
                                                            パスワードを忘れた場合は「パスワードを忘れた方はこちら」から新しいパスワードの設定をお願いいたします。<br><br>
                                                            <span class="bold">②SNSアカウント（Google、Yahoo!ID、LINE）でログインできません。</span><br>
                                                            選択したSNSアカウントでご登録されていない、または入力したIDもしくはパスワードが正しくない、または指定のSNSアカウントをすでに退会済みの可能性がございます。お客様SNSアカウントの情報をご確認の上、再度ログインをお試しください。<br><br>
                                                            SNSアカウントのIDまたはパスワードがご不明の場合は、SNSの運営会社様へお問い合わせください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">アクティベーションコードがわかりません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            マイページにログインするためのアクティベーションコードとURLについては、本サービス申込完了日の翌日にＥメールで発行されます。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">毎月の利用料金はいくらですか。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            料金の詳細およびお支払い方法はご契約時の書面をご確認ください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">解約方法を教えてください。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            解約については、カスタマーセンター「support@shop.pequod.jp」までお問合せください。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="content--item" id="seiton">
                                <div class="item--title">
                                    <h4 class="TL">SEITON</h4>
                                </div>
                                <div class="item--container">
                                    <div class="C_qa">
                                        <ul class="C_qa-list">
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">料金体系</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            以下をご確認ください。<br><br>
                                                            ▼月額保管費用とお預け入れ可能数<br>
                                                            ▷ 550円コース会員さま<br>
                                                            1ヶ月に2箱まで荷物をお預け入れすることができます。<br><br>
                                                            ▼荷物の預け入れ取り出し等にかかる費用<br>
                                                            ▷専用キット購入費用<br>
                                                            無料<br>

                                                            ▷入庫（お預け入れ）費用<br>
                                                            無料<br>

                                                            ▷出庫（お取り出し）費用<br>
                                                            1箱につき1,760円（配送料込み※全国一律）にて、ご指定の宛先（ご自宅以外も可）まで荷物をお届けいたします。<br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">お預入荷物の制限事項について</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            以下をご確認ください。<br /><br />
                                                            ▼専用ボックスサイズ<br>
                                                            120サイズ（縦38cmｘ横38cmx奥行38cm）となります<br>
                                                            <span class="red">※お預け入れには専用キットが必要です。個人でご用意いただいた箱はご利用いただけませんのでご注意ください。</span><br><br>

                                                            ▼重量制限<br>
                                                            1箱につき20kgまでとなります<br><br>

                                                            ▼BOX内のアイテム個数制限<br>
                                                            1箱につき10点までとなります。小物などを多数収納したい場合には、半透明の袋にまとめて梱包していただきますと、1点としてカウントされます。<br><br>

                                                            ▼梱包について<br>
                                                            郵送時の破損を避けるため、壊れやすいものは必ず緩衝材などでお客様自身による保護をお願いいたします。<br><br>

                                                            ▼配送業者とサービス提供可能エリア<br>
                                                            ヤマト運輸によるご配送となります。国内のヤマト集配可能エリアならどこからでもご利用いただけます。<br><br>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">お引き受けできないお荷物</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            以下をご確認ください。<br /><br />
                                                            
                                                                <span class="table"><span class="number">1</span><span class="list">現金、有価証券、通帳、切手、印紙、証書、重要書類、印鑑、クレジットカード、キャッシュカード類</span></span>
                                                                <span class="table"><span class="number">2</span><span class="list">貴金属、美術品、骨董品、宝石、工芸品、毛皮、着物等の高額品または貴重品</span></span>
                                                                <span class="table"><span class="number">3</span><span class="list">精密機器、ガラス製品、陶磁器、仏壇等の壊れやすい物品</span></span>
                                                                <span class="table"><span class="number">4</span><span class="list">磁気を発し、その他の保管品に影響を与える物品</span></span>
                                                                <span class="table"><span class="number">5</span><span class="list">灯油、ガソリン、ガスボンベ、マッチ、ライター、塗料等の可燃物</span></span>
                                                                <span class="table"><span class="number">6</span><span class="list">農薬、劇薬、火薬、毒物、化学薬品、放射性物質等の危険物または劇物</span></span>
                                                                <span class="table"><span class="number">7</span><span class="list">食品、動物、植物（種子、苗を含む）</span></span>
                                                                <span class="table"><span class="number">8</span><span class="list">液体物</span></span>
                                                                <span class="table"><span class="number">9</span><span class="list">異臭、悪臭を発するまたは発するおそれのある物品</span></span>
                                                                <span class="table"><span class="number">10</span><span class="list">廃棄物</span></span>
                                                                <span class="table"><span class="number">11</span><span class="list">法令により所持を禁止されている物品</span></span>
                                                                <span class="table"><span class="number">12</span><span class="list">公序良俗に反する物品</span></span><br>
                                                            
                                                            上記アイテムのお引き受けは致しかねます。万が一お送りいただきましても、内容を確認の上着払いにて返送いたします。<span class="red">その際の入出庫手数料や送料などは全てお客様のご負担となりますのでご注意ください。
                                                            ※お引き受け可能かどうかご不明の場合は、事前にメールにてお問い合わせください。</span>
                                                            
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">保証について</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            万が一、倉庫にお預け入れ中の寄託物に滅失またはき損による損害が生じた場合、寄託価額を上限とする寄託物の時価分の補償を受けることができます。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">その他注意事項</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            交通事情や天候・災害などにより遅配などが起こる場合がございます。遅配による損害はいかなる場合でも補償されませんのでご了承ください。<br>
                                                            入庫（お預け入れ）された際に必ず検品を行います。元々壊れやすいアイテムは規約上お引き受け対象外となっておりますので、その際破損をしていても補償はございませんのでご了承ください。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    </div>
                            </div>

                            <div class="content--item" id="medical">
                                <div class="item--title">
                                    <h4 class="TL">メディカルレスキュー</h4>
                                </div>
                                <div class="item--container">
                                    <div class="C_qa">
                                        <ul class="C_qa-list">
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">ログインできません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            ご登録いただいた方法によって、解決方法が異なりますので以下の各項目をご確認ください。<br /><br />
                                                            <span class="bold"> ①メールアドレスでログインできません。</span><br>
                                                            入力したメールアドレスまたはパスワードがご登録時と異なっている可能性があります。<br>
                                                            「認証情報と一致するレコードがありません。」と表示された場合は、メールアドレスとパスワードが正しいかお確かめください。<br>
                                                            パスワードを忘れた場合は「パスワードを忘れた方はこちら」から新しいパスワードの設定をお願いいたします。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">アクティベーションコードがわかりません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            マイページにログインするためのアクティベーションコードとURLについては、本サービス申込完了日の翌日にＥメールで発行されます。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">毎月の利用料金はいくらですか。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            料金の詳細およびお支払い方法はご契約時の書面をご確認ください。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">解約方法を教えてください。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            解約については、カスタマーセンター「support@shop.pequod.jp」までお問合せください。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    </div>
                            </div>

                            <div class="content--item" id="life">
                                <div class="item--title">
                                    <h4 class="TL">ライフレスキュー</h4>
                                </div>
                                <div class="item--container">
                                    <div class="C_qa">
                                        <ul class="C_qa-list">
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">登録できません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            以下をご確認ください。<br /><br />
                                                            <span class="bold">・アクティベーションコードが有効かどうかご確認ください。</span><br>
                                                            アクティベーションコードをご入力時に赤字の場合はそのアクティベーションコードは無効となっております。<br><br>
                                                            <span class="bold">・すでにご利用済みのメールアドレスを使用していないかご確認ください。</span><br>
                                                            もし、お客様が「ライフレスキュー24」へのご登録が2回目以降の場合、すでにご登録いただいているメールアドレスではご登録ができません。他のメールアドレス（SNSアカウント）をご利用ください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">ログインできません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            ご登録いただいた方法によって、解決方法が異なりますので以下の各項目をご確認ください。<br /><br />
                                                            <span class="bold"> ①メールアドレスでログインできません。</span><br>
                                                            入力したメールアドレスまたはパスワードがご登録時と異なっている可能性があります。<br>
                                                            「認証情報と一致するレコードがありません。」と表示された場合は、メールアドレスとパスワードが正しいかお確かめください。<br>
                                                            パスワードを忘れた場合は「パスワードを忘れた方はこちら」から新しいパスワードの設定をお願いいたします。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">アクティベーションコードがわかりません。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            マイページにログインするためのアクティベーションコードとURLについては、本サービス申込完了日の翌日にＥメールで発行されます。                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">毎月の利用料金はいくらですか。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            料金の詳細およびお支払い方法はご契約時の書面をご確認ください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item">
                                                <div class="tab-TL question">
                                                    <div class="icon">Q</div>
                                                    <p class="TX">解約方法を教えてください。</p>
                                                </div>
                                                <div class="tab-TL answer">
                                                    <div class="answer-inner">
                                                        <p class="TX">
                                                            解約については、カスタマーセンター「support@shop.pequod.jp」までお問合せください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </main>

        <?php include('./includes/footer.php'); ?>
    </div>
    <?php include('./includes/jq.php'); ?>
</body>

</html>