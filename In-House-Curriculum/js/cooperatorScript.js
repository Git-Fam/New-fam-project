$(function () {
	//show付与
	$(".category-content,#cover-btn").on("click", function () {
		$(".select-content,#tab-wrap").toggleClass("show");
	});

	$("#cover-curriculum").hover(function () {
		$(".pyon").toggleClass("hover");
	});

	// 適性診断　文字をタイピング風に表示
	function TextTypingAnime() {
		$(".C_test .TX-bg .TX").each(function () {
			var elemPos = $(this).offset().top - 50;
			var scroll = $(window).scrollTop();
			var windowHeight = $(window).height();
			var thisChild = "";
			if (scroll >= elemPos - windowHeight) {
				thisChild = $(this).children(); //spanタグを取得
				//spanタグの要素の１つ１つ処理を追加
				thisChild.each(function (i) {
					var time = 100;
					//時差で表示する為にdelayを指定しその時間後にfadeInで表示させる
					$(this)
						.delay(time * i)
						.fadeIn(time);
				});
			} else {
				thisChild = $(this).children();
				thisChild.each(function () {
					$(this).stop(); //delay処理を止める
					$(this).css("display", "none"); //spanタグ非表示
				});
			}
		});
	}
	$(window).on("load", function () {
		//spanタグを追加する
		var element = $(".C_test .TX-bg .TX-wrap .TX");
		element.each(function () {
			var text = $(this).html();
			var textbox = "";
			text.split("").forEach(function (t) {
				if (t !== " ") {
					textbox += "<span>" + t + "</span>";
				} else {
					textbox += t;
				}
			});
			$(this).html(textbox);
		});

		TextTypingAnime(); /* アニメーション用の関数を呼ぶ*/
	});

	// var items = ['1番目','2番目','3番目'];
	//   rand = items[Math.floor(Math.random()*items.length)];
	//   $('.random').text(rand);;

	rand = Math.floor(Math.random() * (100 + 1 - 80)) + 80;
	$(".random").text(rand);

	// チャットクラス名付与
	$(document).ready(function ($) {
		// メッセージリストを初期状態で非表示
		$("#sac-messages").css("visibility", "hidden");

		// 既存のメッセージと新しいメッセージにクラスを付与する共通関数
		function processMessages(nodes) {
			nodes.each(function () {
				var node = $(this);

				// メッセージから送信者のユーザー名を取得
				var usernameElement = node.find(".sac-chat-name");
				if (usernameElement.length > 0) {
					var username = usernameElement.text().split(":")[0].trim();

					// Ajaxでユーザー情報を取得
					$.ajax({
						url: userGroupData.ajaxurl,
						method: "POST",
						data: {
							action: "get_user_group_by_name",
							username: username,
						},
						success: function (response) {
							if (response.success) {
								node.addClass(response.data.group).addClass("group-processed");

								// 'me'クラスを付与するかどうかを確認
								if (response.data.is_current_user) {
									node.addClass("me");
								}

								// ユーザーのグループに一致するメッセージを表示
								if (node.hasClass(userGroupData.group)) {
									node.show();
								}
							}
						},
						error: function (xhr, status, error) {
							console.error("AJAX error:", error);
						},
					});
				}
			});
		}

		// リロード時に既存のメッセージにクラスを付与
		processMessages($("#sac-messages li"));

		// 新しいメッセージが追加されたときの処理
		var observer = new MutationObserver(function (mutationsList) {
			mutationsList.forEach(function (mutation) {
				if (mutation.type === "childList") {
					processMessages($(mutation.addedNodes).filter("li"));
				}
			});
		});
		observer.observe(document.getElementById("sac-messages"), {
			childList: true,
		});

		// すべての処理が完了した後にメッセージリスト全体を表示
		$("#sac-messages").css("visibility", "visible");

		// ユーザーグループクラスをメッセージリストに追加
		$("#sac-messages").addClass(userGroupData.group + "_user");

		// グループのクラス名が付与された後にそのクラスの最新2件のメッセージを抽出
		$(document).ajaxStop(function () {
			var messages = $("#sac-messages li." + userGroupData.group);

			if (messages.length > 0) {
				// ソート処理
				messages.sort(function (a, b) {
					return (
						new Date($(b).attr("data-time")) - new Date($(a).attr("data-time"))
					);
				});

				// 最新6件を抽出して表示
				var latestMessages = messages.slice(0, 6).clone();
				$("#latest-messages").empty().append(latestMessages);
			}
		});

		// 実行例
		displayLatestMessages("#another-page-latest-messages", "group_a");
	});

	// ボタンの文字変更
	var submitButton = document.getElementById("submitchat");
	if (submitButton) {
		submitButton.value = "送信";
	}

	// いいね機能
	jQuery(document).ready(function ($) {
		// ページロード時にユーザーのいいね情報を取得して表示を更新
		updateLikeInfo();

		// いいねボタンのクリックイベントを設定
		$(".like-button").on("click", function () {
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
				error: function (xhr, status, error) {
					console.error("AJAX error:", error);
					alert("AJAXリクエストに失敗しました: " + error);
				},
				complete: function () {
					// ボタンを再び有効化する必要はないので、この行は不要です
				},
			});
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
	});

	// クラスAを持つ要素をクラスBで囲む
	$(".sac-chat-name").wrap('<p class="sac-chat-name-wrap"></p>');
	// $(".highlight-text").wrap('<p class="text-wrap"></p>');

	jQuery(document).ready(function ($) {
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
	});

	// ランキングの切り替え
	$("#toggle-ranking-btn").on("click", function () {
		$(
			"#point-ranking, #login-days-ranking, #point-info, #login-days-info"
		).toggleClass("hidden");
		$(this).text($("#point-ranking").hasClass("hidden") ? "Point" : "Login");
	});

	$(document).ready(function () {
		if (
			typeof allUsersProgress !== "undefined" &&
			allUsersProgress.length > 0
		) {
			// ログインしているユーザーの進捗に基づいて .clear クラスを付与
			allUsersProgress.forEach((user) => {
				const userProgress = user.progress;
				const username = user.username;

				// 現在のユーザー名と一致する場合のみ .clear クラスを付与
				if ($.trim(username) === $.trim(currentUsername)) {
					console.log(
						"クリアしたセクションに対して.clearを付与するユーザー:",
						username
					);

					// ユーザーの進捗をループして、クリアしたセクションに対して処理
					$.each(userProgress, (key, value) => {
						const progressValue = parseInt(value) || 0;

						// 進捗値が100の場合、セクションをクリアしたと見なす
						if (progressValue === 100) {
							$("." + key + " .goal").addClass("clear"); // クリアしたセクションにのみ.clearを付与
						} else if (progressValue === 0) {
							// 進捗がないセクションに .not を付与
							$("." + key + " .goal").addClass("not");
						} else {
							$("." + key + " .goal").removeClass("clear not");
						}
					});
				}
			});

			// 各ユーザーの進捗に基づいてキャラクターを表示
			allUsersProgress.forEach((user) => {
				const userProgress = user.progress;
				const username = user.username;
				console.log("表示中のユーザー名:", username); // 表示するユーザー名の確認

				let shouldDisplayCharacter = true; // キャラクターを表示するかどうかのフラグ

				// JQセクションを表示する場合のみ、JQ01の進捗値をチェック
				if (showJQSection) {
					const jq01Value = parseInt(userProgress["JQ01"]) || 0;

					// JQ01の進捗が0の場合は非表示にする
					if (jq01Value === 0) {
						console.log(
							"JQ01の進捗が0のため、非表示にするユーザー名:",
							username
						);
						shouldDisplayCharacter = false; // キャラクターを表示しない
					}
				}

				if (!shouldDisplayCharacter) {
					return; // キャラクターを表示しない場合は処理を終了
				}

				let lastCheckpointClass = "",
					lastProgressValue = 0;

				$.each(userProgress, (key, value) => {
					const progressValue = parseInt(value) || 0;
					if (progressValue > 0 && progressValue <= 100) {
						lastCheckpointClass = key;
						lastProgressValue = progressValue;
					}
				});

				if (lastCheckpointClass) {
					const $checkpointElement = $("." + lastCheckpointClass);
					if ($checkpointElement.length) {
						// character-box 要素を動的に生成
						const $characterBox = $("<div>")
							.addClass("character-box")
							.css({
								position: "absolute",
								left: lastProgressValue + "%", // 進捗に応じたleftの値
							});

						const $nameElement = $("<p>").addClass("name").text(username);

						// 現在のユーザー名と一致する場合は文字色を赤に設定し、.meクラスを追加
						if ($.trim(username) === $.trim(currentUsername)) {
							console.log("赤くするユーザー名:", username); // 赤くするユーザー名の確認
							$nameElement.css("color", "red");
							$characterBox.addClass("me");
						}

						// character-box に要素を追加し、DOMに追加
						$characterBox
							.append($nameElement)
							.append($("<div>").addClass("character"))
							.appendTo($checkpointElement);
					}
				}
			});
		} else {
			console.error("全ユーザーの進捗データが読み込まれていません。");
		}
	});

	//質問広場　質問モーダル
	$(".post-content").on("click", function () {
		$(".post-modal").addClass("open");
	});
	$(".C_back-btn").on("click", function () {
		$(".post-modal").removeClass("open");
	});

	//質問広場　コメントタイトル　プレイスホルダー
	jQuery(document).ready(function ($) {
		// 質問広場 コメントタイトル プレイスホルダー
		var $input = $("#comtitle, #sac_chat");
		var $commentFormTitle = $(".comment-form-title, #sac-form");

		// 初期チェック - inputがすでに入力されている場合
		togglePlaceholder($input.val());

		// inputの内容を監視
		$input.on("input", function () {
			togglePlaceholder($(this).val());
		});

		function togglePlaceholder(value) {
			if (value.trim() !== "") {
				$commentFormTitle.addClass("input-has-value");
			} else {
				$commentFormTitle.removeClass("input-has-value");
			}
		}
	});

	//質問広場　質問投稿時カテゴリー選択
	jQuery(document).ready(function ($) {
		const selectPostItems = $("#select-post li");
		const commentForm = $("#commentform");
		const categoryTextElement = $(".category-content-TX");
		const errorMessageElement = $(
			"<p class='error-message' style='color: red; display: none;'>カテゴリーを選択してください。</p>"
		);

		// エラーメッセージをフォームに追加
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

			commentForm.on("submit", function (event) {
				// カテゴリーが選択されていない場合
				if (!isCategorySelected) {
					event.preventDefault(); // フォームの送信をキャンセル
					errorMessageElement.show(); // エラーメッセージを表示
					return false; // 完全に送信を防ぐ
				}

				// カテゴリーが選択されている場合
				event.preventDefault(); // デフォルトのフォーム送信を防止

				// Ajaxでコメントを送信
				var formData = new FormData(this);
				$.ajax({
					url: commentForm.attr("action"), // フォームの送信先URL
					type: "POST",
					data: formData,
					processData: false,
					contentType: false,
					success: function (response) {
						// 送信成功時にモーダルの内容を変更
						$(".letter").hide(); // .letterを非表示にする
						$(".success").show(); // .successを表示する
					},
					error: function () {
						// エラーハンドリング（必要に応じて追加）
						alert(
							"コメントの送信中にエラーが発生しました。もう一度お試しください。"
						);
					},
				});
			});
		} else {
			console.error("必要な要素が見つかりませんでした。");
		}
	});

	// チャットボット
	// よくある質問をクリックしたら、その内容が表示される

	jQuery(document).ready(function ($) {
		// よくある質問のタイトルクリックイベント
		$(".chatbot-title").on("click", function (e) {
			e.preventDefault(); // リンクのデフォルト動作を防ぐ

			var post_id = $(this).data("id"); // クリックされたリンクの投稿IDを取得

			$.post(
				chatbot_ajax.ajax_url,
				{
					action: "get_chatbot_content", // AJAXアクションフック
					post_id: post_id,
				},
				function (response) {
					$(".answer").html(response); // 取得した内容を.answerに表示
				}
			);
			$(".q-and-a-answer").addClass("show");
		});

		// chatbot検索
		jQuery(document).ready(function ($) {
			// 検索ボタンのクリックイベント
			$("#search-button").on("click", function () {
				executeSearch(); // 検索を実行
			});

			// エンターキーでの検索イベント
			$("#search-input").on("keyup", function (event) {
				if (event.keyCode === 13) {
					// エンターキーが押されたとき
					executeSearch(); // 検索を実行
				}
			});

			// 検索処理を関数に分離
			function executeSearch() {
				var searchTerm = $("#search-input").val(); // 検索キーワードを取得

				$(".search-result").removeClass("show").empty(); // 検索結果をクリアして非表示
				$(".search-result-answer").removeClass("show"); // 検索内容を非表示にする
				$(".search-word").removeClass("show"); // 検索ワードの表示をリセット
				// 検索ワードを.wordに表示
				$(".word").text(searchTerm);

				// 検索ワード全体の表示を有効にする
				$(".search-word").addClass("show");

				// AJAXで検索リクエストを送信
				$.post(
					chatbot_ajax.ajax_url,
					{
						action: "search_chatbot_posts", // 検索用のAJAXアクションフック
						search: searchTerm,
					},
					function (response) {
						$(".search-result").html(response); // 取得した検索結果を.search-resultに表示
						$(".search-result").addClass("show");

						// 検索結果内のタイトルクリックイベントを再度バインド
						$(".search-result .chatbot-title").on("click", function (e) {
							e.preventDefault(); // リンクのデフォルト動作を防ぐ

							var post_id = $(this).data("id"); // クリックされたリンクの投稿IDを取得

							$.post(
								chatbot_ajax.ajax_url,
								{
									action: "get_chatbot_content", // AJAXアクションフック
									post_id: post_id,
								},
								function (response) {
									$(".search-answer").html(response); // 取得した内容を.answerに表示
								}
							);
							$(".search-result-answer").addClass("show");
						});
					}
				);
			}
		});
	});

	// 各li要素に順番にupクラスを付与
	$("#q-and-a-list li").each(function (index) {
		$(this)
			.delay(index * 300)
			.queue(function (next) {
				$(this).addClass("show"); // upクラスを追加
			});
	});

	//常に一番下にスクロールした状態
	jQuery(document).ready(function ($) {
		// スクロール可能な要素を取得
		var chatbotContent = $(".chatbot-content");
		var shouldScrollToBottom = true; // 自動スクロールのフラグ

		// 要素をゆっくりと一番下までスクロール
		function scrollToBottom() {
			chatbotContent.animate(
				{ scrollTop: chatbotContent[0].scrollHeight },
				3000 // 3秒かけてスクロール
			);
		}

		// 初期ロード時に一番下までスクロール
		scrollToBottom();

		// 要素の変化を監視するためのMutationObserverを設定
		var observer = new MutationObserver(function (mutations) {
			mutations.forEach(function (mutation) {
				// 要素に変化があった場合
				if (mutation.type === "childList" || mutation.type === "subtree") {
					if (shouldScrollToBottom) {
						setTimeout(function () {
							scrollToBottom(); // スクロール実行
						}, 2500); // 2秒（1000ミリ秒）後に実行
					}
				}
			});
		});

		// 監視の設定
		observer.observe(chatbotContent[0], {
			childList: true, // 子ノードの変更を監視
			subtree: true, // 子孫ノード（深い階層の子も含む）も監視
		});

		// スクロール位置が手動で変更されたら自動スクロールを一時的に解除
		chatbotContent.on("scroll", function () {
			// ユーザーが手動でスクロールした場合、フラグを解除
			shouldScrollToBottom =
				chatbotContent[0].scrollTop + chatbotContent.outerHeight() >=
				chatbotContent[0].scrollHeight - 10;
		});

		// コンテンツに変化があったら自動スクロールを再有効化
		chatbotContent.on("DOMNodeInserted", function () {
			shouldScrollToBottom = true;
		});
	});

	//質問の検索
	jQuery(document).ready(function ($) {
		// .archive-questionクラスの存在でアーカイブページかどうかを判別
		var isArchivePage = $(".archive-question").length > 0;

		// ページロード時に全てのコメントを取得する (アーカイブページの場合のみ)
		if (isArchivePage) {
			$.post(
				chatbot_ajax.ajax_url,
				{
					action: "get_all_comments", // すべてのコメントを取得するためのAJAXアクション
				},
				function (response) {
					$(".comment-search-result").html(response); // 取得した全コメントを.comment-search-resultに表示
				}
			);
		}

		// コメント検索ボタンのクリックイベント
		$("#comment-search-button").on("click", function () {
			executeSearch(); // 検索を実行
		});

		// エンターキーでのコメント検索イベント
		$("#comment-search-input").on("keyup", function (event) {
			if (event.keyCode === 13) {
				// エンターキーが押されたとき
				executeSearch(); // 検索を実行
			}
		});

		// 検索処理を関数に分離
		function executeSearch() {
			var searchTerm = $("#comment-search-input").val(); // 検索キーワードを取得

			// AJAXで検索リクエストを送信
			$.post(
				chatbot_ajax.ajax_url,
				{
					action: "search_comments", // コメント検索用のAJAXアクションフック
					search: searchTerm,
				},
				function (response) {
					$(".comment-search-result").html(response); // 取得した検索結果を.comment-search-resultに表示
				}
			);
		}
	});

	//道のりページ　under-menu
	$(".under-menu").click(function () {
		$(this).toggleClass("open");
	});
});
