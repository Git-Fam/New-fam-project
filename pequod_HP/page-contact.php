<?php get_header(); ?>
<div class="page-contact">
    <section class="Contact_Title">
        <div class="C_ContactTitle">
            <div class="C_TL type02 light">
                <p class="C_TL_deco">
                    <span class="js-g01">c</span>
                    <span class="js-g01">o</span>
                    <span class="js-g01">n</span>
                    <span class="js-g01">t</span>
                    <span class="js-g01">a</span>
                    <span class="js-g01">c</span>
                    <span class="js-g01">t</span>
                    <span class="js-g01">&nbsp;</span>
                    <span class="js-g01">f</span>
                    <span class="js-g01">o</span>
                    <span class="js-g01">r</span>
                    <span class="js-g01">m</span>
                </p>
                <h3 class="C_TL_main">
                    <span class="js-g01">お</span>
                    <span class="js-g01">問</span>
                    <span class="js-g01">合</span>
                    <span class="js-g01">せ</span>
                    <span class="js-g01">フ</span>
                    <span class="js-g01">ォ</span>
                    <span class="js-g01">ー</span>
                    <span class="js-g01">ム</span>
                </h3>
            </div>
            <div class="content">
                <div class="content--text">
                    <p class="TX">
                        この度はpequodにご興味を持ってくださいまして、誠にありがとうございます。<br>
                        ご不明点・ご相談は、お気軽にお問い合わせください。<br>
                        ご返信は3営業日以内を目途にさせて頂きます。
                    </p>
                </div>
                <div class="content--text">
                    <p class="TX">
                        ※alwaterのお問い合わせにつきましては、当サイトからは受付しておりません。<br>
                        下記公式サイトまでお問い合わせいただきますよう、お願い致します。
                    </p>
                    <a class="hover-opa" href="https://alwater.jp/" target="_blank" rel="noopener noreferrer">https://alwater.jp/</a>
                </div>
            </div>
        </div>
    </section>
    <section class="Contact_Tab">
        <div class="C_ContactTab">
            <div class="C_ContactTab__Buttons">
                <div class="BTN active">
                    <p class="TX">お問い合わせ</p>
                </div>
                <div class="BTN">
                    <p class="TX">エントリーフォーム</p>
                </div>
            </div>
            <div class="C_ContactTab__former">
                <!-- 問い合わせ -->
                <div class="former active">
                    <div class="C_Form">
                        <?php
                        // echo do_shortcode('[contact-form-7 id="7ed9ac7" title="Contact"]');
                        ?>
                        <form class="form" action="contact-confirm">
                            <ul class="lists">
                                <!-- 問い合わせ内容 -->
                                <li>
                                    <div class="title">
                                        <p class="label">内容を選択してください</p>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <div class="content--radios">
                                            <div class="content--radios--inner">
                                                <input class="radio" type="radio" id="inquiryType01" name="inquiryType" value="general">
                                                <label class="TX" for="inquiryType01">お問い合わせ</label>
                                            </div>
                                            <div class="content--radios--inner">
                                                <input class="radio" type="radio" id="inquiryType02" name="inquiryType" value="agency">
                                                <label class="TX" for="inquiryType02">代理店お問い合わせ</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- 会社名 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="companyName">会社名</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs err" type="text" id="companyName" name="companyName" placeholder="〇〇株式会社">
                                        <p class="err-message">必須項目です。入力してください。</p>
                                    </div>
                                </li>
                                <!-- 名前 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="name">お名前</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="text" id="name" name="name" placeholder="田中　太郎">
                                    </div>
                                </li>
                                <!-- フリガナ -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="furigana">フリガナ</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="text" id="furigana" name="furigana" placeholder="タナカ　タロウ">
                                    </div>
                                </li>
                                <!-- 住所 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="postal-code1">住所</label>
                                    </div>
                                    <div class="content">
                                        <div class="content--address">
                                            <div class="content--address--number">
                                                <div class="first-number">
                                                    <p class="TX">〒</p>
                                                    <input class="inputs" type="text" id="postal-code1" name="postal-code1" placeholder="000">
                                                </div>
                                                <div class="first-number">
                                                    <p class="TX">-</p>
                                                    <input class="inputs" type="text" id="postal-code2" name="postal-code2" placeholder="0000">
                                                </div>
                                            </div>
                                            <div class="content--address--sentence">
                                                <input class="inputs" type="text" id="address" name="address" placeholder="〇〇県××市△△丁目0-0 〇〇ビル101">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- 連絡可能電話番号 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="phone">連絡可能電話番号</label>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="tel" id="phone" name="phone" placeholder="000-0000-0000">
                                    </div>
                                </li>
                                <!-- メールアドレス -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="email">メールアドレス</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="email" id="email" name="email" placeholder="info@abcdef.jp">
                                    </div>
                                </li>
                                <!-- お問い合わせ内容 -->
                                <li class="textarea_list">
                                    <div class="title">
                                        <label class="label" for="inquiry">お問い合わせ内容</label>
                                    </div>
                                    <div class="content">
                                        <textarea class="inputs textarea" name="inquiry" id="inquiry" placeholder="お問い合わせ内容の記入"></textarea>
                                    </div>
                                </li>
                                <!-- プライバシーポリシー -->
                                <li class="last_list">
                                    <div class="Confirm">
                                        <div class="Agreement_area">
                                            <div class="Agreement">
                                                <input class="checkbox" type="checkbox" id="Agreement" name="Agreement">
                                                <label class="TX" for="Agreement">「個人情報の取扱いについて」同意する</label>
                                            </div>
                                        </div>
                                        <div class="Btn_area">
                                            <button class="C_SubmitBtn">
                                                <p class="TX">確認</p>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
                <!-- エントリー -->
                <div class="former">
                    <div class="C_Form">
                        <?php
                        // echo do_shortcode('[contact-form-7 id="7ed9ac7" title="Contact"]');
                        ?>
                        <form class="form" action="contact-entry-confirm">
                            <ul class="lists">
                                <!-- 名前 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="name">お名前</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="text" id="name" name="name" placeholder="田中　太郎">
                                    </div>
                                </li>
                                <!-- フリガナ -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="furigana">フリガナ</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="text" id="furigana" name="furigana" placeholder="タナカ　タロウ">
                                    </div>
                                </li>
                                <!-- 生年月日 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="birthYear">生年月日</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <div class="content--birthDate">
                                            <div class="date">
                                                <input class="inputs" type="number" id="birthYear" name="birthYear" min="1900" max="2024" placeholder="1990">
                                                <p class="TX">年</p>
                                            </div>
                                            <div class="date">
                                                <input class="inputs" type="number" id="birthMonth" name="birthMonth" min="1" max="12" placeholder="1">
                                                <p class="TX">月</p>
                                            </div>
                                            <div class="date">
                                                <input class="inputs" type="number" id="birthDay" name="birthDay" min="1" max="31" placeholder="1">
                                                <p class="TX">日</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- 性別 -->
                                <li>
                                    <div class="title">
                                        <p class="label">性別</p>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <div class="content--radios">
                                            <div class="content--radios--inner">
                                                <input class="radio" type="radio" id="gender-male" name="gender" value="male">
                                                <label class="TX" for="gender-male">男性</label>
                                            </div>
                                            <div class="content--radios--inner">
                                                <input class="radio" type="radio" id="gender-female" name="gender" value="female">
                                                <label class="TX" for="gender-female">女性</label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- 連絡可能電話番号 -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="phone">連絡可能電話番号</label>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="tel" id="phone" name="phone" placeholder="000-0000-0000">
                                    </div>
                                </li>
                                <!-- メールアドレス -->
                                <li>
                                    <div class="title">
                                        <label class="label" for="email">メールアドレス</label>
                                        <p class="required">必須</p>
                                    </div>
                                    <div class="content">
                                        <input class="inputs" type="email" id="email" name="email" placeholder="info@abcdef.jp">
                                    </div>
                                </li>
                                <!-- ご質問 -->
                                <li class="textarea_list">
                                    <div class="title">
                                        <label class="label" for="inquiry">ご質問</label>
                                    </div>
                                    <div class="content">
                                        <textarea class="inputs textarea" name="inquiry" id="inquiry" placeholder="ご質問内容の記入"></textarea>
                                    </div>
                                </li>
                                <!-- プライバシーポリシー -->
                                <li class="last_list">
                                    <div class="Confirm">
                                        <div class="Agreement_area">
                                            <div class="Agreement">
                                                <input class="checkbox" type="checkbox" id="Agreement" name="Agreement">
                                                <label class="TX" for="Agreement">「個人情報の取扱いについて」同意する</label>
                                            </div>
                                        </div>
                                        <div class="Btn_area">
                                            <button class="C_SubmitBtn">
                                                <p class="TX">確認</p>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>