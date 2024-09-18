<?php get_header(); ?>

<form action="">
    <div class="change-clothes">
        <!-- ディスプレイ -->
        <div class="change-clothes__display">
            <header class="display__header">
                <a class="return__button hover-opa" href="#" onclick="if (confirm('変更があった場合、情報は失われます。本当に閉じますか？')) { window.close(); } return false;"></a>
                <div class="self__area">
                    <div class="possession__area">
                        <div class="possession__item">
                            <div class="icon icon-01"></div>
                            <p class="TX">200</p>
                        </div>
                        <div class="possession__item">
                            <div class="icon icon-02"></div>
                            <p class="TX">2000</p>
                        </div>
                    </div>
                    <button class="saving__button" type="submit" disabled>
                        <p class="TX">保存する</p>
                    </button>
                </div>
            </header>
            <div class="display__character"></div>
            <div class="display__character__ground"></div>

            <!-- キャラクターのセリフ -->
            <div class="display__character__serif none">
                <div class="serif__area">
                    <div class="item__serif">
                        <p class="TX">まだ持っていないアイテムだよ！</p>
                    </div>
                    <div class="item__info">
                        <div class="item__img__frame">
                            <div class="item__img"></div>
                        </div>
                        <div class="item__cost">
                            <div class="icon coin"></div>
                            <p class="TX">100000</p>
                        </div>
                    </div>
                    <div class="item__button">
                        <button class="buttons cancel" type="button">やめる</button>
                        <button class="buttons exchange" type="button">交換する</button>
                    </div>
                </div>
            </div>

            <!-- キャラクターの色変更 -->
            <div class="display__character__color none">
                <div class="color__area">
                    <div class="gradient__area">
                        <canvas id="color-display" class="gradient__item"></canvas>
                    </div>
                    <div class="picker__area">
                        <input id="selected-color" class="color__now" type="text" name="color" id="color"
                            value="rgb(247, 251, 248)">
                        <div class="color__bar__container">
                            <canvas id="color-bar" class="color__bar"></canvas>
                            <div id="color-bar-marker" class="color__bar__marker"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ボタン -->
            <div class="display__sideButton">
                <button class="sideButton__button" type="button">
                    <div class="sideButton__text">
                        <div class="icon icon-01"></div>
                        <p class="TX">ひとつ戻す</p>
                    </div>
                </button>
                <button class="sideButton__button" type="button">
                    <div class="sideButton__text">
                        <div class="icon icon-02"></div>
                        <p class="TX">リセット</p>
                    </div>
                </button>
            </div>

        </div>

        <!-- コントロール -->
        <div class="change-clothes__control">

            <div class="control__category">
                <!-- カテゴリー -->
                <div class="category__list">
                    <ul class="category__list__items">
                        <li class="active">
                            <div class="category__item">
                                <div class="icon"></div>
                            </div>
                        </li>
                        <li>
                            <div class="category__item">
                                <div class="icon"></div>
                            </div>
                        </li>
                        <li>
                            <div class="category__item">
                                <div class="icon"></div>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- タグ -->
                <div class="tag__list">
                    <div class="tag__list__area active">
                        <ul class="tag__list__items">
                            <li>
                                <div class="tag__item active"></div>
                            </li>
                            <li>
                                <div class="tag__item"></div>
                            </li>
                            <li>
                                <div class="tag__item"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="tag__list__area">
                        <ul class="tag__list__items">
                            <li>
                                <div class="tag__item active"></div>
                            </li>
                            <li>
                                <div class="tag__item"></div>
                            </li>
                            <li>
                                <div class="tag__item"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="tag__list__area">
                        <ul class="tag__list__items">
                            <li>
                                <div class="tag__item active"></div>
                            </li>
                            <li>
                                <div class="tag__item"></div>
                            </li>
                            <li>
                                <div class="tag__item"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="control__item">
                <div class="control__item__inner">
                    <!-- カテゴリー -->
                    <div class="control__list__wrap active">
                        <!-- タグ -->
                        <div class="control__category-tag__list active">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-1</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-1</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-1</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="control__category-tag__list">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-2</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-2</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-2</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="control__category-tag__list">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-3</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-3</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-1-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">1-3</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- カテゴリー -->
                    <div class="control__list__wrap">
                        <!-- タグ -->
                        <div class="control__category-tag__list active">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-1</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-1</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-1</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="control__category-tag__list">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-2</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-2</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-2</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="control__category-tag__list">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-3</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-3</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-2-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">2-3</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- カテゴリー -->
                    <div class="control__list__wrap">
                        <!-- タグ -->
                        <div class="control__category-tag__list active">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-1</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-1</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-1"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-1</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="control__category-tag__list">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-2</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-2</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-2"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-2</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="control__category-tag__list">
                            <ul>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-3</div>
                                    <div class="nothing-item active"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-3</div>
                                    <div class="nothing-item"></div>
                                </li>
                                <li>
                                    <input class="category-tag__item--wrap" type="radio" name="category-tag-3-3"
                                        onclick="toggleRadio(this)">
                                    <div class="category-tag__item">3-3</div>
                                    <div class="nothing-item"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function toggleRadio(radio) {
        if (radio.previousChecked) {
            radio.checked = false;
        }
        radio.previousChecked = radio.checked;
    }
</script>

<?php get_footer(); ?>