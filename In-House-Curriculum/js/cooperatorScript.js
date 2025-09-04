jQuery(function () {
    $(".list-btn")
        .off("click")
        .on("click", function () {
            $(this).toggleClass("active");
            $(".post-list").toggleClass("active");
        });

    // クリック回数を保持する変数（グローバルスコープに定義）
    var clickCount = 0;

    $(".next-section")
        .off("click")
        .on("click", function () {
            // クリックが発生するたびにカウントをインクリメント
            clickCount++;

            var currentSection = $(".page-section.show");
            var nextSection = currentSection.next(".page-section");

            if (nextSection.length) {
                currentSection.removeClass("show");
                nextSection.addClass("show");
            }
        });

    // クリック回数を保持する変数
    var backClickCount = 0;

    // クリックイベントを複数回バインドしないようにoff()でリセット
    $(".back-section")
        .off("click")
        .on("click", function () {
            // クリック回数をカウント
            backClickCount++;

            // 現在の表示されているセクションを取得
            var currentSection = $(".page-section.show");
            var prevSection = currentSection.prev(".page-section");

            // 前のセクションが存在する場合、クラスを切り替える
            if (prevSection.length) {
                currentSection.removeClass("show");
                prevSection.addClass("show");
            }
        });

    // $(".archive--item--img").click(function () {
    //  var currentSection = $(".page-section.show");
    //  currentSection.removeClass("show");
    //  $(".page1").addClass("show");
    // });

    //道のり　SPchat
    $(".C_chat-content")
        .off("click")
        .on("click", function () {
            $(this).toggleClass("open");
        });

    //show付与
    $("#cover-btn,.timeline-jamp")
        .off("click")
        .on("click", function () {
            $("#tab-wrap,.timeline-modal,.chat-wrap").toggleClass("show");
        });

    $(".category-content")
        .off("click")
        .on("click", function () {
            $(this).find(".select-content").toggleClass("show");
        });

    $("#cover-curriculum").hover(function () {
        $(".pyon").toggleClass("hover");
    });

    //トップページスクロール

    $(".topPage").on("wheel", function (e) {
        if (Math.abs(e.originalEvent.deltaY) < Math.abs(e.originalEvent.deltaX))
            return;
        const maxScrollLeft = this.scrollWidth - this.clientWidth;
        if (
            (this.scrollLeft <= 0 && e.originalEvent.deltaY < 0) ||
            (this.scrollLeft >= maxScrollLeft && e.originalEvent.deltaY > 0)
        )
            return;

        e.preventDefault();
        this.scrollLeft += e.originalEvent.deltaY;
    });

    // top-mainchara要素を取得
    const characterElement = document.querySelector("#top-mainchara");

    // スクロール速度を制御するための変数
    let scrollX = 0;
    let scrollY = 0;
    let isScrolling = false;

    // 慣性スクロールの動きを作る関数
    function applyInertiaScroll() {
        if (!isScrolling) return;

        // characterElementがnullでないことを確認
        if (!characterElement) {
            return; // 要素が見つからない場合は処理を中断
        }

        // 慣性の減衰を両方向に適用
        scrollX *= 0.9; // 横方向の減衰
        scrollY *= 0.2; // 縦方向の減衰

        // 要素の位置を更新 (translateX, translateYを同時に適用)
        characterElement.style.transform = `translate(${scrollX}px, ${scrollY}px)`;

        // 両方向の移動が十分に小さくなるまで慣性を続ける
        if (Math.abs(scrollX) > 0.5 || Math.abs(scrollY) > 0.5) {
            requestAnimationFrame(applyInertiaScroll);
        } else {
            isScrolling = false;
        }
    }

    // ホイールスクロール時のイベントを監視
    window.addEventListener("wheel", (e) => {
        // ホイールのスクロール量を移動に変換
        scrollX += e.deltaX; // 横方向のスクロール
        scrollY += e.deltaY; // 縦方向のスクロール

        if (!isScrolling) {
            isScrolling = true;
            requestAnimationFrame(applyInertiaScroll); // 慣性スクロールを開始
        }
    });

    // チャットクラス名付与と最新6件表示
    // === チャット最新6件（グループ別/最新が下）: 他所へ影響しない安全版 ===
    (function ($) {
        "use strict";

        // 安全ガード: jQuery / userGroupData / コンテナ/描画先 が無ければ何もしない
        if (!$ || typeof window.userGroupData === "undefined") return;

        var GROUP = window.userGroupData.group || "";
        if (!GROUP) return;

        var $root = $("#simple-ajax-chat");
        var $latest = $("#latest-messages");
        if ($root.length === 0 || $latest.length === 0) return;

        var $sacMessages = $root.find("#sac-messages");
        if ($sacMessages.length === 0) return;

        // Username -> Group のキャッシュ（他所のDOMを変更しない）
        var groupCache = Object.create(null);

        // ユーザー名抽出: <span class="sac-chat-name">Xxx : </span> or <a>Xxx</a>
        function extractUsername($li) {
            var $name = $li.find(".sac-chat-name");
            if ($name.length === 0) return "";
            var txt = $name.text() || "";
            // "ユーザー名 :" 形式に対応
            var name = txt.split(":")[0].trim();
            if (!name && $name.find("a").length) {
                name = ($name.find("a").text() || "").trim();
            }
            return name;
        }

        // data-time を Date に（"YYYY-MM-DD,HH:mm:ss" -> "YYYY-MM-DDTHH:mm:ss"）
        function parseTime($li) {
            var raw = ($li.attr("data-time") || "").replace(",", "T");
            var d = new Date(raw);
            return isNaN(d.getTime()) ? null : d;
        }

        // Ajaxでユーザーのgroup取得（キャッシュあり）: 返り値は Promise<string>
        function getGroupByUsername(username) {
            if (!username) return Promise.resolve("");
            if (groupCache[username] !== undefined) {
                return Promise.resolve(groupCache[username]);
            }
            return new Promise(function (resolve) {
                $.ajax({
                    url: window.userGroupData.ajaxurl,
                    method: "POST",
                    data: {
                        action: "get_user_group_by_name",
                        username: username,
                    },
                })
                    .done(function (res) {
                        var g =
                            res && res.success && res.data && res.data.group
                                ? res.data.group
                                : "";
                        groupCache[username] = g;
                        resolve(g);
                    })
                    .fail(function () {
                        groupCache[username] = "";
                        resolve("");
                    });
            });
        }

        // 描画ロジック本体：オリジナルは変更せず、latest側にだけクローンを流し込む
        function renderLatest() {
            var $lis = $sacMessages.find("li.sac-chat-message");
            if ($lis.length === 0) {
                $latest.empty();
                return;
            }

            // 1) 全 li から username/time を読み出し
            var items = [];
            $lis.each(function () {
                var $li = $(this);
                var username = extractUsername($li);
                var time = parseTime($li); // Date|null
                if (!username || !time) return; // 不正データはスキップ
                items.push({ $li: $li, username: username, time: time });
            });

            if (items.length === 0) {
                $latest.empty();
                return;
            }

            // 2) まとめて group を取得（キャッシュ活用）
            var groupPromises = items.map(function (it) {
                return getGroupByUsername(it.username).then(function (g) {
                    it.group = g || "";
                    return it;
                });
            });

            Promise.all(groupPromises).then(function (resolved) {
                // 3) 対象グループのみ残す
                var filtered = resolved.filter(function (it) {
                    return it.group === GROUP;
                });

                if (filtered.length === 0) {
                    $latest.empty();
                    return;
                }

                // 4) 古→新（昇順）にソートし、末尾6件を採用（最新が下）
                filtered.sort(function (a, b) {
                    return a.time - b.time;
                });
                var last6 = filtered.slice(-6);

                // 5) クローンして描画（元DOMに一切手を入れない）
                var $frag = $(document.createDocumentFragment());
                last6.forEach(function (it) {
                    $frag.append(it.$li.clone(true, true));
                });

                $latest.empty().append($frag);
            });
        }

        // 初期描画
        renderLatest();

        // MutationObserverで新規メッセージ追加を検知（元DOMは変更しない）
        var sacNode = $sacMessages.get(0);
        if (sacNode) {
            var tick;
            var observer = new MutationObserver(function (mutations) {
                // 追加ノードがあるときだけ再描画（デバウンス）
                var hasAdded = mutations.some(function (m) {
                    return m.type === "childList" && m.addedNodes && m.addedNodes.length;
                });
                if (!hasAdded) return;
                clearTimeout(tick);
                tick = setTimeout(renderLatest, 150);
            });
            observer.observe(sacNode, { childList: true });
        }
    })(window.jQuery);

    // ボタンの文字変更
    var submitButton = document.getElementById("submitchat");
    if (submitButton) {
        submitButton.value = "送信";
    }

    // いいね機能
    // ページロード時にユーザーのいいね情報を取得して表示を更新
    updateLikeInfo();

    // いいねボタンのクリックイベントを設定
    $(".like-button")
        .off("click")
        .on("click", function () {
            var $button = $(this);
            var itemId = $button.data("item-id");

            // ボタンを無効化して多重クリックを防止
            $button.prop("disabled", true);

            $.ajax({
                url: myAjax.ajaxurl,
                type: "POST",
                data: {
                    action: "handle_like",
                    item_id: itemId,
                },
                success: function (response) {
                    console.log("AJAX Response:", response);

                    if (response.success) {
                        // 新しいカウントを取得して表示を更新
                        var new_count = response.data.new_count;
                        var like_count_today = response.data.like_count_today; // 今日のいいね数

                        // アイテムごとのいいね数を更新
                        $("#like-count-" + itemId).text(new_count);

                        // 他のすべてのlike-buttonからlikedクラスを削除
                        $button
                            .closest(".like-button-wrap")
                            .find(".like-button")
                            .removeClass("liked");

                        // クリックされたボタンにのみlikedクラスを追加
                        $button.addClass("liked");

                        // 全てのボタンを無効化
                        $button
                            .closest(".like-button-wrap")
                            .find(".like-button")
                            .prop("disabled", true);

                        // ページのいいね情報を更新
                        updateLikeInfo(like_count_today);
                    } else {
                        // エラーメッセージをアラートで表示
                        alert(response.data.message || "エラーメッセージがありません。");
                    }
                },
                complete: function () {
                    // ボタンを再び有効化する必要はないので、この行は不要です
                },
            });
            //.like-buttonにclickクラスを付与
            $(this).addClass("click");
        });

    // いいね情報を更新する関数
    function updateLikeInfo(like_count_today = null) {
        if (like_count_today === null) {
            // 初回ページロード時にいいね情報を取得
            like_count_today = userLikeInfo.like_count_today;
        }

        // いいねの回数を表示する要素を更新
        $(".reaction-counter").text(like_count_today + "/5");

        // 5回目のいいねの場合、コインカウンターにクラス 'get' を追加
        if (like_count_today == 5) {
            $(".coin-counter").addClass("get");
        }
    }

    // クラスAを持つ要素をクラスBで囲む
    // .sac-chat-name が既に .sac-chat-name-wrap で包まれているか確認
    $(".sac-chat-name").each(function () {
        if (!$(this).parent().hasClass("sac-chat-name-wrap")) {
            $(this).wrap('<p class="sac-chat-name-wrap"></p>');
        }
    });

    // .highlight-text が既に .text-wrap で包まれているか確認
    $(".highlight-text").each(function () {
        if (!$(this).parent().hasClass("text-wrap")) {
            $(this).wrap('<p class="text-wrap"></p>');
        }
    });
    // クラス名 'sac-chat-message' を持つすべてのリストアイテムに対して
    $(".sac-chat-message").each(function () {
        // このリストアイテム内のテキストノードを取得
        $(this)
            .contents()
            .filter(function () {
                // テキストノードかどうかをチェック（nodeType === 3）
                // trim()で空白を取り除き、非空白のテキストのみを対象に
                return this.nodeType === 3 && $.trim(this.nodeValue).length > 0;
            })
            .wrap('<span class="highlight-text"></span>'); // 選択したテキストノードを <span> でラップ
    });

    // 質問広場 コメントタイトル プレイスホルダー
    var $input = $("#sac_chat");
    var $commentFormTitle = $("#sac-form");

    togglePlaceholder($input.val()); // 初期チェック

    $input.on("input", function () {
        togglePlaceholder($(this).val());
    });

    function togglePlaceholder(value) {
        if (typeof value === "string" && value.trim() !== "") {
            $commentFormTitle.addClass("input-has-value");
        } else {
            $commentFormTitle.removeClass("input-has-value");
        }
    }

    jQuery(function ($) {
        var $input = $("#sac_chat");
        var $form = $("#sac-form");

        // まず、textareaのonkeypress属性を削除（これが超重要！！）
        $input.removeAttr("onkeypress");

        // フォームsubmitを全てブロック（Enterで送信させない）
        $form.on("submit", function (e) {
            e.preventDefault();
            return false;
        });

        // textareaではEnter/Shift+Enter共に何も送信させない（デフォで改行だけできる）
        $input.on("keydown", function (e) {
            if (e.keyCode === 13) {
                e.preventDefault(); //これ消すとtextareaでは改行ができる
                // 何もしない（送信は絶対にされない、改行だけできる）
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
        });
    });

    // === #sac-messages の各 li にアバターを付与（全体チャットのみ） ===
    jQuery(function ($) {
        "use strict";

        var $sac = $("#sac-messages");
        if ($sac.length === 0) return;
        if (
            typeof window.userGroupData === "undefined" ||
            !window.userGroupData.ajaxurl
        )
            return;

        // username -> character_html のキャッシュ（Mapで安全）
        var avatarHtmlCache = new Map();

        function extractUsername($li) {
            // 1) クラスから取得（例: sac-user-ryuu）
            var cls = $li.attr("class") || "";
            var m = cls.match(/(?:^|\s)sac-user-([^\s]+)/);
            if (m && m[1]) return m[1].trim();

            // 2) 表示名から取得（fallback）
            var $name = $li.find(".sac-chat-name");
            if ($name.length > 0) {
                var txt = $name.text() || "";
                var u = txt.split(":")[0].trim();
                if (!u && $name.find("a").length) {
                    u = ($name.find("a").text() || "").trim();
                }
                return u;
            }
            return "";
        }

        function setSingleAvatar($li, html) {
            // 既存の chat-avatar を全て除去してから1個だけ追加（最終防御）
            $li.children(".chat-avatar").remove();
            if (html) {
                $li.prepend($('<div class="chat-avatar"></div>').html(html));
            }
        }

        function injectAvatar($li) {
            // 同一LIの多重実行防止
            if ($li.data("avatar-lock") === true || $li.data("avatar-done") === true)
                return;

            var username = extractUsername($li);
            if (!username) return;

            // キャッシュにあれば即適用
            if (avatarHtmlCache.has(username)) {
                setSingleAvatar($li, avatarHtmlCache.get(username));
                $li.data("avatar-done", true);
                return;
            }

            // ロック
            $li.data("avatar-lock", true);

            $.ajax({
                url: window.userGroupData.ajaxurl,
                method: "POST",
                data: { action: "get_user_group_by_name", username: username },
            })
                .done(function (res) {
                    var html =
                        res && res.success && res.data && res.data.character_html
                            ? res.data.character_html
                            : "";

                    // キャッシュ
                    avatarHtmlCache.set(username, html);

                    // 常に1個だけに置き換え
                    setSingleAvatar($li, html);

                    // 完了マーク
                    $li.data("avatar-done", true);
                })
                .always(function () {
                    // ロック解除（再描画で再挑戦可。ただし done チェックで多重は防止）
                    $li.data("avatar-lock", false);
                });
        }

        function bootExisting() {
            $sac.find("li.sac-chat-message").each(function () {
                injectAvatar($(this));
            });
        }

        // 初期実行
        bootExisting();

        // 追加メッセージにも対応（子要素追加のみ監視）
        var node = $sac.get(0);
        if (node) {
            var observer = new MutationObserver(function (mutations) {
                var added = [];
                mutations.forEach(function (m) {
                    if (m.type === "childList" && m.addedNodes && m.addedNodes.length) {
                        added = added.concat(Array.prototype.slice.call(m.addedNodes));
                    }
                });
                if (added.length) {
                    $(added)
                        .filter("li.sac-chat-message")
                        .each(function () {
                            injectAvatar($(this));
                        });
                }
            });
            observer.observe(node, { childList: true });
        }
    });




    //ミニゲーム　レベル選択
    $(".level-list li,.cat-select").hover(function () {
        $(".level-list li,.cat-select").removeClass("active");
        $(this).addClass("active");
    });

    // ボタンの文字変更
    var currentURL = window.location.href;

    // URLに "gamepost" が含まれているか確認する
    if (currentURL.indexOf("gamepost") !== -1) {
        var submitButton = $("#submit");
        if (submitButton.length) {
            submitButton.val("送信"); // ボタンのテキストを変更
        }
    }

    $(".castle").on("click", function () {
        $(".castle-animal").addClass("show");
    });

    // 例: jQuery風
    const bird = document.querySelector(".sec3-anime-bird");
    if (bird) {
        bird.addEventListener("touchstart", () => bird.classList.add("active"));
        bird.addEventListener("touchend", () => bird.classList.remove("active"));
    }

    $(".road-action").on("click", function () {
        $(".action-modal").addClass("show");
    });
    $(".action-close").on("click", function () {
        $(".action-modal").removeClass("show");
    });

    //記事ページリンク
    //スクロールしたら.single--linkにshowクラス付与、ページの最下部からPCは500px、SPは300pxまでスクロールしたら.single--linkからshowクラス削除
    //さらにスクロールが止まって2秒経った時もshowクラスを削除
    $(function () {
        let removeShowTimeout = null;
        const $singleLink = $(".single--link");

        $(window).on("scroll", function () {
            var scrollTop = $(window).scrollTop();
            var windowHeight = $(window).height();
            var documentHeight = $(document).height();
            var scrollBottom = scrollTop + windowHeight;

            // デバイス判定（SPかどうか）
            var isSP = window.innerWidth <= 767;
            var removeThreshold = isSP ? 300 : 500;
            var isScrolledToBottom = scrollBottom >= documentHeight - removeThreshold;

            // --- まず「下部なら消す」 ---
            if (isScrolledToBottom) {
                $singleLink.removeClass("show");
                if (removeShowTimeout) clearTimeout(removeShowTimeout);
                return; // ここで終了
            }

            // --- スクロールしたらshowクラス付与 ---
            $singleLink.addClass("show");

            // --- スクロールが止まった3秒後に消す ---
            if (removeShowTimeout) clearTimeout(removeShowTimeout);
            removeShowTimeout = setTimeout(function () {
                $singleLink.removeClass("show");
            }, 3000);
        });

        // ページ読み込み時に初期化
        $(".single--link").removeClass("show");
    });
});

jQuery(function () {
    $(".list-btn")
        .off("click")
        .on("click", function () {
            $(this).toggleClass("active");
            $(".post-list").toggleClass("active");
        });

    // クリック回数を保持する変数（グローバルスコープに定義）
    var clickCount = 0;

    $(".next-section")
        .off("click")
        .on("click", function () {
            // クリックが発生するたびにカウントをインクリメント
            clickCount++;

            var currentSection = $(".page-section.show");
            var nextSection = currentSection.next(".page-section");

            if (nextSection.length) {
                currentSection.removeClass("show");
                nextSection.addClass("show");
            }
        });

    // クリック回数を保持する変数
    var backClickCount = 0;

    // クリックイベントを複数回バインドしないようにoff()でリセット
    $(".back-section")
        .off("click")
        .on("click", function () {
            // クリック回数をカウント
            backClickCount++;

            // 現在の表示されているセクションを取得
            var currentSection = $(".page-section.show");
            var prevSection = currentSection.prev(".page-section");

            // 前のセクションが存在する場合、クラスを切り替える
            if (prevSection.length) {
                currentSection.removeClass("show");
                prevSection.addClass("show");
            }
        });

    // $(".archive--item--img").click(function () {
    //  var currentSection = $(".page-section.show");
    //  currentSection.removeClass("show");
    //  $(".page1").addClass("show");
    // });

    //道のり　SPchat
    $(".C_chat-content")
        .off("click")
        .on("click", function () {
            $(this).toggleClass("open");
        });

    //show付与
    $("#cover-btn,.timeline-jamp")
        .off("click")
        .on("click", function () {
            $("#tab-wrap,.timeline-modal,.chat-wrap").toggleClass("show");
        });

    $(".category-content")
        .off("click")
        .on("click", function () {
            $(this).find(".select-content").toggleClass("show");
        });

    $("#cover-curriculum").hover(function () {
        $(".pyon").toggleClass("hover");
    });

    //トップページスクロール

    $(".topPage").on("wheel", function (e) {
        if (Math.abs(e.originalEvent.deltaY) < Math.abs(e.originalEvent.deltaX))
            return;
        const maxScrollLeft = this.scrollWidth - this.clientWidth;
        if (
            (this.scrollLeft <= 0 && e.originalEvent.deltaY < 0) ||
            (this.scrollLeft >= maxScrollLeft && e.originalEvent.deltaY > 0)
        )
            return;

        e.preventDefault();
        this.scrollLeft += e.originalEvent.deltaY;
    });

    // top-mainchara要素を取得
    const characterElement = document.querySelector("#top-mainchara");

    // スクロール速度を制御するための変数
    let scrollX = 0;
    let scrollY = 0;
    let isScrolling = false;

    // 慣性スクロールの動きを作る関数
    function applyInertiaScroll() {
        if (!isScrolling) return;

        // characterElementがnullでないことを確認
        if (!characterElement) {
            return; // 要素が見つからない場合は処理を中断
        }

        // 慣性の減衰を両方向に適用
        scrollX *= 0.9; // 横方向の減衰
        scrollY *= 0.2; // 縦方向の減衰

        // 要素の位置を更新 (translateX, translateYを同時に適用)
        characterElement.style.transform = `translate(${scrollX}px, ${scrollY}px)`;

        // 両方向の移動が十分に小さくなるまで慣性を続ける
        if (Math.abs(scrollX) > 0.5 || Math.abs(scrollY) > 0.5) {
            requestAnimationFrame(applyInertiaScroll);
        } else {
            isScrolling = false;
        }
    }

    // ホイールスクロール時のイベントを監視
    window.addEventListener("wheel", (e) => {
        // ホイールのスクロール量を移動に変換
        scrollX += e.deltaX; // 横方向のスクロール
        scrollY += e.deltaY; // 縦方向のスクロール

        if (!isScrolling) {
            isScrolling = true;
            requestAnimationFrame(applyInertiaScroll); // 慣性スクロールを開始
        }
    });

    // チャットクラス名付与と最新6件表示
    // === チャット最新6件（グループ別/最新が下）: 他所へ影響しない安全版 ===
    (function ($) {
        "use strict";

        // 安全ガード
        if (!$ || typeof window.userGroupData === "undefined") return;

        var GROUP = window.userGroupData.group || ""; // ← 最新6件用に使う。空でも .me は動く
        var $root = $("#simple-ajax-chat");
        var $latest = $("#latest-messages");
        if ($root.length === 0) return; // 全体チャットが無ければ何もしない

        var $sacMessages = $root.find("#sac-messages");
        if ($sacMessages.length === 0) return;

        // Username -> Group のキャッシュ
        var groupCache = Object.create(null);

        // ユーザー名抽出（sac-user-<login> を最優先）
        function extractUsername($li) {
            var cls = $li.attr("class") || "";
            var m = cls.match(/(?:^|\s)sac-user-([^\s]+)/);
            if (m && m[1]) return m[1].trim();

            var $name = $li.find(".sac-chat-name");
            if ($name.length === 0) return "";
            var txt = $name.text() || "";
            var name = txt.split(":")[0].trim();
            if (!name && $name.find("a").length) {
                name = ($name.find("a").text() || "").trim();
            }
            return name;
        }

        // data-time を Date に（"YYYY-MM-DD,HH:mm:ss" -> "YYYY-MM-DDTHH:mm:ss"）
        function parseTime($li) {
            var raw = ($li.attr("data-time") || "").replace(",", "T");
            var d = new Date(raw);
            return isNaN(d.getTime()) ? null : d;
        }

        // Ajax で group を取得（キャッシュあり）
        function getGroupByUsername(username) {
            if (!username) return Promise.resolve("");
            if (groupCache[username] !== undefined) {
                return Promise.resolve(groupCache[username]);
            }
            return new Promise(function (resolve) {
                $.ajax({
                    url: window.userGroupData.ajaxurl,
                    method: "POST",
                    data: {
                        action: "get_user_group_by_name",
                        username: username,
                    },
                })
                    .done(function (res) {
                        var g =
                            res && res.success && res.data && res.data.group
                                ? res.data.group
                                : "";
                        groupCache[username] = g;
                        resolve(g);
                    })
                    .fail(function () {
                        groupCache[username] = "";
                        resolve("");
                    });
            });
        }

        // ★ 全体チャット側だけ：自分の投稿に .me を付与（GROUPの有無に関係なく実行）
        function markMeMessages($scope) {
            var myLogin =
                (window.userGroupData && window.userGroupData.username) || "";
            if (!myLogin) return;
            var myLower = myLogin.trim().toLowerCase();

            var $lis = ($scope && $scope.length ? $scope : $sacMessages).find(
                "li.sac-chat-message"
            );

            $lis.each(function () {
                var $li = $(this);
                if ($li.hasClass("me")) return; // 二重付与防止
                var uname = extractUsername($li);
                if (!uname) return;

                var uLower = String(uname).trim().toLowerCase();
                if (uLower === myLower) {
                    $li.addClass("me");
                }
            });
        }

        // 最新6件（最新が下）：クローン時に .me と .chat-avatar を外す
        function renderLatest() {
            if ($latest.length === 0) return;
            if (!GROUP) {
                // グループ未設定なら最新6件はスキップ（.me は別で付く）
                $latest.empty();
                return;
            }

            var $lis = $sacMessages.find("li.sac-chat-message");
            if ($lis.length === 0) {
                $latest.empty();
                return;
            }

            var items = [];
            $lis.each(function () {
                var $li = $(this);
                var username = extractUsername($li);
                var time = parseTime($li);
                if (!username || !time) return;
                items.push({ $li: $li, username: username, time: time });
            });

            if (items.length === 0) {
                $latest.empty();
                return;
            }

            var groupPromises = items.map(function (it) {
                return getGroupByUsername(it.username).then(function (g) {
                    it.group = g || "";
                    return it;
                });
            });

            Promise.all(groupPromises).then(function (resolved) {
                var filtered = resolved.filter(function (it) {
                    return it.group === GROUP;
                });

                if (filtered.length === 0) {
                    $latest.empty();
                    return;
                }

                // 古→新（昇順）に並べて末尾6件
                filtered.sort(function (a, b) {
                    return a.time - b.time;
                });
                var last6 = filtered.slice(-6);

                // クローンするが、.me と .chat-avatar は削除してから表示
                var $frag = $(document.createDocumentFragment());
                last6.forEach(function (it) {
                    var $clone = it.$li.clone(true, true);
                    $clone.removeClass("me");
                    $clone.find(".chat-avatar").remove();
                    $frag.append($clone);
                });

                $latest.empty().append($frag);
            });
        }

        // 初期：全体に .me 付与 → 最新6件描画（GROUPが空でも .me は動く）
        markMeMessages($sacMessages);
        renderLatest();

        // 追加メッセージ監視（全体に .me、最新6件は再描画）
        var sacNode = $sacMessages.get(0);
        if (sacNode) {
            var tick;
            var observer = new MutationObserver(function (mutations) {
                var addedLis = $();
                mutations.forEach(function (m) {
                    if (m.type === "childList" && m.addedNodes && m.addedNodes.length) {
                        addedLis = addedLis.add(
                            $(m.addedNodes).filter("li.sac-chat-message")
                        );
                    }
                });
                if (addedLis.length) {
                    markMeMessages(addedLis); // ★ 全体側だけに .me
                    clearTimeout(tick);
                    tick = setTimeout(renderLatest, 150); // 最新6件も更新
                }
            });
            observer.observe(sacNode, { childList: true });
        }
    })(window.jQuery);

    // ボタンの文字変更
    var submitButton = document.getElementById("submitchat");
    if (submitButton) {
        submitButton.value = "送信";
    }

    // いいね機能
    // ページロード時にユーザーのいいね情報を取得して表示を更新
    updateLikeInfo();

    // いいねボタンのクリックイベントを設定
    $(".like-button")
        .off("click")
        .on("click", function () {
            var $button = $(this);
            var itemId = $button.data("item-id");

            // ボタンを無効化して多重クリックを防止
            $button.prop("disabled", true);

            $.ajax({
                url: myAjax.ajaxurl,
                type: "POST",
                data: {
                    action: "handle_like",
                    item_id: itemId,
                },
                success: function (response) {
                    console.log("AJAX Response:", response);

                    if (response.success) {
                        // 新しいカウントを取得して表示を更新
                        var new_count = response.data.new_count;
                        var like_count_today = response.data.like_count_today; // 今日のいいね数

                        // アイテムごとのいいね数を更新
                        $("#like-count-" + itemId).text(new_count);

                        // 他のすべてのlike-buttonからlikedクラスを削除
                        $button
                            .closest(".like-button-wrap")
                            .find(".like-button")
                            .removeClass("liked");

                        // クリックされたボタンにのみlikedクラスを追加
                        $button.addClass("liked");

                        // 全てのボタンを無効化
                        $button
                            .closest(".like-button-wrap")
                            .find(".like-button")
                            .prop("disabled", true);

                        // ページのいいね情報を更新
                        updateLikeInfo(like_count_today);
                    } else {
                        // エラーメッセージをアラートで表示
                        alert(response.data.message || "エラーメッセージがありません。");
                    }
                },
                complete: function () {
                    // ボタンを再び有効化する必要はないので、この行は不要です
                },
            });
            //.like-buttonにclickクラスを付与
            $(this).addClass("click");
        });

    // いいね情報を更新する関数
    function updateLikeInfo(like_count_today = null) {
        if (like_count_today === null) {
            // 初回ページロード時にいいね情報を取得
            like_count_today = userLikeInfo.like_count_today;
        }

        // いいねの回数を表示する要素を更新
        $(".reaction-counter").text(like_count_today + "/5");

        // 5回目のいいねの場合、コインカウンターにクラス 'get' を追加
        if (like_count_today == 5) {
            $(".coin-counter").addClass("get");
        }
    }

    // クラスAを持つ要素をクラスBで囲む
    // .sac-chat-name が既に .sac-chat-name-wrap で包まれているか確認
    $(".sac-chat-name").each(function () {
        if (!$(this).parent().hasClass("sac-chat-name-wrap")) {
            $(this).wrap('<p class="sac-chat-name-wrap"></p>');
        }
    });

    // .highlight-text が既に .text-wrap で包まれているか確認
    $(".highlight-text").each(function () {
        if (!$(this).parent().hasClass("text-wrap")) {
            $(this).wrap('<p class="text-wrap"></p>');
        }
    });
    // クラス名 'sac-chat-message' を持つすべてのリストアイテムに対して
    $(".sac-chat-message").each(function () {
        // このリストアイテム内のテキストノードを取得
        $(this)
            .contents()
            .filter(function () {
                // テキストノードかどうかをチェック（nodeType === 3）
                // trim()で空白を取り除き、非空白のテキストのみを対象に
                return this.nodeType === 3 && $.trim(this.nodeValue).length > 0;
            })
            .wrap('<span class="highlight-text"></span>'); // 選択したテキストノードを <span> でラップ
    });

    // 質問広場 コメントタイトル プレイスホルダー
    var $input = $("#sac_chat");
    var $commentFormTitle = $("#sac-form");

    togglePlaceholder($input.val()); // 初期チェック

    $input.on("input", function () {
        togglePlaceholder($(this).val());
    });

    function togglePlaceholder(value) {
        if (typeof value === "string" && value.trim() !== "") {
            $commentFormTitle.addClass("input-has-value");
        } else {
            $commentFormTitle.removeClass("input-has-value");
        }
    }

    jQuery(function ($) {
        var $input = $("#sac_chat");
        var $form = $("#sac-form");

        // まず、textareaのonkeypress属性を削除（これが超重要！！）
        $input.removeAttr("onkeypress");

        // フォームsubmitを全てブロック（Enterで送信させない）
        $form.on("submit", function (e) {
            e.preventDefault();
            return false;
        });

        // textareaではEnter/Shift+Enter共に何も送信させない（デフォで改行だけできる）
        $input.on("keydown", function (e) {
            if (e.keyCode === 13) {
                e.preventDefault(); //これ消すとtextareaでは改行ができる
                // 何もしない（送信は絶対にされない、改行だけできる）
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
        });
    });

    // === #sac-messages の各 li にアバターを付与（全体チャットのみ） ===
    jQuery(function ($) {
        "use strict";

        var $sac = $("#sac-messages");
        if ($sac.length === 0) return;
        if (
            typeof window.userGroupData === "undefined" ||
            !window.userGroupData.ajaxurl
        )
            return;

        // username -> character_html のキャッシュ（Mapで安全）
        var avatarHtmlCache = new Map();

        function extractUsername($li) {
            // 1) クラスから取得（例: sac-user-ryuu）
            var cls = $li.attr("class") || "";
            var m = cls.match(/(?:^|\s)sac-user-([^\s]+)/);
            if (m && m[1]) return m[1].trim();

            // 2) 表示名から取得（fallback）
            var $name = $li.find(".sac-chat-name");
            if ($name.length > 0) {
                var txt = $name.text() || "";
                var u = txt.split(":")[0].trim();
                if (!u && $name.find("a").length) {
                    u = ($name.find("a").text() || "").trim();
                }
                return u;
            }
            return "";
        }

        function setSingleAvatar($li, html) {
            // 既存の chat-avatar を全て除去してから1個だけ追加（最終防御）
            $li.children(".chat-avatar").remove();
            if (html) {
                $li.prepend($('<div class="chat-avatar"></div>').html(html));
            }
        }

        function injectAvatar($li) {
            // 同一LIの多重実行防止
            if ($li.data("avatar-lock") === true || $li.data("avatar-done") === true)
                return;

            var username = extractUsername($li);
            if (!username) return;

            // キャッシュにあれば即適用
            if (avatarHtmlCache.has(username)) {
                setSingleAvatar($li, avatarHtmlCache.get(username));
                $li.data("avatar-done", true);
                return;
            }

            // ロック
            $li.data("avatar-lock", true);

            $.ajax({
                url: window.userGroupData.ajaxurl,
                method: "POST",
                data: { action: "get_user_group_by_name", username: username },
            })
                .done(function (res) {
                    var html =
                        res && res.success && res.data && res.data.character_html
                            ? res.data.character_html
                            : "";

                    // キャッシュ
                    avatarHtmlCache.set(username, html);

                    // 常に1個だけに置き換え
                    setSingleAvatar($li, html);

                    // 完了マーク
                    $li.data("avatar-done", true);
                })
                .always(function () {
                    // ロック解除（再描画で再挑戦可。ただし done チェックで多重は防止）
                    $li.data("avatar-lock", false);
                });
        }

        function bootExisting() {
            $sac.find("li.sac-chat-message").each(function () {
                injectAvatar($(this));
            });
        }

        // 初期実行
        bootExisting();

        // 追加メッセージにも対応（子要素追加のみ監視）
        var node = $sac.get(0);
        if (node) {
            var observer = new MutationObserver(function (mutations) {
                var added = [];
                mutations.forEach(function (m) {
                    if (m.type === "childList" && m.addedNodes && m.addedNodes.length) {
                        added = added.concat(Array.prototype.slice.call(m.addedNodes));
                    }
                });
                if (added.length) {
                    $(added)
                        .filter("li.sac-chat-message")
                        .each(function () {
                            injectAvatar($(this));
                        });
                }
            });
            observer.observe(node, { childList: true });
        }
    });


});



