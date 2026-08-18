$(document).ready(function () {
    // 質問広場 質問モーダルの開閉
    $(".post-content").on("click", function () {
        $(".post-modal").addClass("open");
    });
    $(".C_back-btn").on("click", function () {
        $(".post-modal").removeClass("open");
    });

    // 質問広場 コメントタイトル プレイスホルダー
    var $input = $("#comtitle, #sac_chat");
    var $commentFormTitle = $(".comment-form-title, #sac-form");

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

    // 質問広場 質問投稿時のカテゴリー選択
    const selectPostItems = $("#select-post li");
    const commentForm = $("#commentform");
    const categoryTextElement = $(".category-content-TX");
    const errorMessageElement = $(
        "<p class='error-message' style='color: red; display: none;'>カテゴリーを選択してください。</p>"
    );
    commentForm.prepend(errorMessageElement);

    let isCategorySelected = false;

    if (
        selectPostItems.length > 0 &&
        commentForm.length > 0 &&
        categoryTextElement.length > 0
    ) {
        selectPostItems.on("click", function () {
            const selectedPostId = $(this).data("value");
            const selectedPostTitle = $(this).text().trim();

            categoryTextElement.text(selectedPostTitle);
            const commentPostIdInput = commentForm.find(
                'input[name="comment_post_ID"]'
            );
            if (commentPostIdInput.length > 0) {
                commentPostIdInput.val(selectedPostId);
                isCategorySelected = true;
                errorMessageElement.hide();
            }
        });

        commentForm.off("submit").on("submit", function (event) {
            event.preventDefault(); // 一度だけpreventDefaultを呼び出します

            if (!isCategorySelected) {
                errorMessageElement.show();
                return false;
            }

            var formData = new FormData(this);
            $.ajax({
                url: commentForm.attr("action"),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function () {
                    $(".letter").hide();
                    $(".success").show();
                },
                error: function () {
                    alert("コメントの送信中にエラーが発生しました。");
                },
            });
        });
    }

    // チャットボット 各li要素に順番にupクラスを付与
    $("#q-and-a-list li").each(function (index) {
        $(this)
            .delay(index * 300)
            .queue(function (next) {
                $(this).addClass("show");
                next();
            });
    });

    // よくある質問クリック時の表示
    $(".chatbot-title").on("click", function (e) {
        e.preventDefault();
        var post_id = $(this).data("id");

        $.post(
            chatbot_ajax.ajax_url,
            { action: "get_chatbot_content", post_id: post_id },
            function (response) {
                $(".answer").html(response);
            }
        );

        $(".q-and-a-answer").addClass("show");
    });

    // チャットボットの検索処理
    function executeChatbotSearch() {
        var searchTerm = $("#search-input").val();

        $(".search-result").removeClass("show").empty();
        $(".search-result-answer").removeClass("show");
        $(".search-word").removeClass("show");
        $(".word").text(searchTerm);

        $(".search-word").addClass("show");

        $.post(
            chatbot_ajax.ajax_url,
            { action: "search_chatbot_posts", search: searchTerm },
            function (response) {
                $(".search-result").html(response).addClass("show");
                $(".search-result .chatbot-title")
                    .off("click")
                    .on("click", function (e) {
                        e.preventDefault();
                        var post_id = $(this).data("id");

                        $.post(
                            chatbot_ajax.ajax_url,
                            { action: "get_chatbot_content", post_id: post_id },
                            function (response) {
                                $(".search-answer").html(response);
                            }
                        );

                        $(".search-result-answer").addClass("show");
                    });
            }
        );
    }

    $("#search-button").on("click", executeChatbotSearch);
    $("#search-input").on("keyup", function (event) {
        if (event.keyCode === 13) {
            executeChatbotSearch();
        }
    });

    // チャットボット スクロール処理
    var chatbotContent = $(".chatbot-content");
    var shouldScrollToBottom = true;

    if (chatbotContent.length > 0) {
        function scrollToBottom() {
            chatbotContent.animate(
                { scrollTop: chatbotContent[0].scrollHeight },
                1000
            );
        }

        // 初期ロード時にスクロール
        // scrollToBottom();

        $(document).on("click", "#q-and-a-list li", function () {
            scrollToBottom();
        });

        // MutationObserver を使用して、DOMの変化を監視
        var observer = new MutationObserver(function (mutationsList) {
            // DOMに新しいノードが追加された時のみ
            mutationsList.forEach(function (mutation) {
                if (mutation.type === "childList" && shouldScrollToBottom) {
                    setTimeout(scrollToBottom, 500);
                }
            });
        });

        // 監視設定
        observer.observe(chatbotContent[0], { childList: true, subtree: true });

        // ユーザーがスクロール操作をしたかどうかを検知
        chatbotContent.on("scroll", function () {
            var scrollPosition =
                chatbotContent[0].scrollTop + chatbotContent.outerHeight();
            var scrollHeight = chatbotContent[0].scrollHeight;
            shouldScrollToBottom = scrollPosition >= scrollHeight - 10;
        });
    }

    // コメント検索処理
    function executeCommentSearch() {
        var searchTerm = $("#comment-search-input").val();

        $.post(
            chatbot_ajax.ajax_url,
            { action: "search_comments", search: searchTerm },
            function (response) {
                $(".comment-search-result").html(response);
            }
        );
    }

    $("#comment-search-button").on("click", executeCommentSearch);
    $("#comment-search-input").on("keyup", function (event) {
        if (event.keyCode === 13) {
            executeCommentSearch();
        }
    });

    // 質問のアーカイブ処理
    var isArchivePage = $(".archive-question").length > 0;
    if (isArchivePage) {
        $.post(
            chatbot_ajax.ajax_url,
            { action: "get_all_comments" },
            function (response) {
                $(".comment-search-result").html(response);
            }
        );
    }
});

