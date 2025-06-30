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

	$(".archive--item--img").click(function () {
		var currentSection = $(".page-section.show");
		currentSection.removeClass("show");
		$(".page1").addClass("show");
	});

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

	// チャットクラス名付与
	$(function ($) {
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
					});
				}
			});
		}

		// リロード時に既存のメッセージにクラスを付与
		processMessages($("#sac-messages li"));

		// sac-messages要素が存在するか確認
		var targetNode = document.getElementById("sac-messages");

		if (targetNode) {
			// 新しいメッセージが追加されたときの処理
			var observer = new MutationObserver(function (mutationsList) {
				mutationsList.forEach(function (mutation) {
					if (mutation.type === "childList") {
						processMessages($(mutation.addedNodes).filter("li"));
					}
				});
			});

			// MutationObserverで対象のノードを監視
			observer.observe(targetNode, {
				childList: true,
			});
		}
		// すべての処理が完了した後にメッセージリスト全体を表示
		$("#sac-messages").css("visibility", "visible");

		// ユーザーグループクラスをメッセージリストに追加
		// sac-messages 要素が存在するか確認
		var targetNode = document.getElementById("sac-messages");

		if (
			targetNode &&
			typeof userGroupData !== "undefined" &&
			userGroupData.group
		) {
			// userGroupDataが定義されており、groupプロパティが存在する場合のみクラスを追加
			$("#sac-messages").addClass(userGroupData.group + "_user");
		}

		// グループのクラス名が付与された後にそのクラスの最新6件のメッセージを抽出
		$(document).ajaxStop(function () {
			// userGroupData が定義されているか確認
			if (typeof userGroupData !== "undefined" && userGroupData.group) {
				var messages = $("#sac-messages li." + userGroupData.group);

				if (messages.length > 0) {
					// ソート処理
					messages.sort(function (a, b) {
						return (
							new Date($(b).attr("data-time")) -
							new Date($(a).attr("data-time"))
						);
					});

					// 最新6件を抽出して表示
					var latestMessages = messages.slice(0, 6).clone();
					$("#latest-messages").empty().append(latestMessages);
				}
			}
		});
	});

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

	function displayCharacters() {
		$(".character-box").remove();

		if (
			typeof allUsersProgress !== "undefined" &&
			allUsersProgress.length > 0
		) {
			// 各 destination に対する表示済みカウントを保持
			const destinationUserMap = new Map();

			// ★進捗値ごとの表示数を管理（重なり回避用）
			const progressCountMap = new Map();

			allUsersProgress.forEach((user) => {
				const userProgress = user.progress;
				const username = user.username;

				let lastCheckpointClass = "";
				let lastProgressValue = 0;

				const $activeCategory = $(".archive--contents--items--wap.active");

				if ($activeCategory.length) {
					const categoryId = $activeCategory.data("category-id");

					const isOneWeekPassed =
						lastPostProgress?.[user.user_id]?.[lastCheckpointClass] === true;

					if (!isOneWeekPassed) {
						$.each(userProgress, (key, value) => {
							const progressValue = parseInt(value) || 0;
							if (
								progressValue > 0 &&
								$activeCategory.find(`.${key}`).length > 0
							) {
								lastCheckpointClass = key;
								lastProgressValue = progressValue;
							}
						});

						// 目的地の要素が見つかった後、キャラクター表示処理の直前で期限切れチェック
						if (lastCheckpointClass) {
							const $checkpointElement = $activeCategory.find(
								`.${lastCheckpointClass}`
							);
							if ($checkpointElement.length) {
								const destinationKey = $checkpointElement.get(0);

								// === ここで期限切れチェック追加 ===
								const isExpired =
									lastPostProgress?.[user.user_id]?.[lastCheckpointClass] ===
									true;

								if (isExpired) return;

								// ユーザーが自分かどうかを判定
								const isMe = $.trim(username) === $.trim(currentUsername);

								// 目的地ごとの表示数を管理（自分は制限外）
								let count = destinationUserMap.get(destinationKey) || 0;

								if (isMe || count < 10) {
									const $characterBox = $("<div>")
										.addClass("character-box")
										.css({
											position: "absolute",
											left: lastProgressValue + "%",
										});

									const $nameElement = $("<p>").addClass("name").text(username);

									if (isMe) {
										$nameElement.css("color", "red");
										$characterBox.addClass("me");
									}

									const userCharacter = wpData.allUsersCharacters.find(
										(c) => c.username === username
									);
									if (userCharacter) {
										const $characterDiv = $("<div>")
											.addClass("character")
											.html(userCharacter.character_html);
										$characterBox.append($characterDiv);
									}

									// ★★★ ここから縦横ずらしロジック追加！ ★★★
									const progressKey = `${lastCheckpointClass}-${lastProgressValue}`;
									let stackedCount = progressCountMap.get(progressKey) || 0;
									progressCountMap.set(progressKey, stackedCount + 1);

									// 縦に等間隔（24pxごと下にずらす）
									const verticalOffset = stackedCount * 24;

									// 交互に横へずらす
									const horizontalOffset = stackedCount % 2 === 0 ? 20 : -20; // 偶数:右、奇数:左

									$characterBox.css({
										left: `calc(${lastProgressValue}% + ${horizontalOffset}px)`,
										top: verticalOffset + "px",
									});
									// ★★★ ここまで追加！ ★★★
									$characterBox
										.append($nameElement)
										.appendTo($checkpointElement);

									// 自分以外ならカウント
									if (!isMe) {
										destinationUserMap.set(destinationKey, count + 1);
									}
								}
							}
						}
					}
				}
			});
		}
	}

	// ゴールのクラスを更新する関数
	function updateGoalClasses() {
		if (
			typeof allUsersProgress !== "undefined" &&
			allUsersProgress.length > 0
		) {
			const currentUserProgress = allUsersProgress.find(
				(user) => user.username === currentUsername
			);

			if (currentUserProgress && currentUserProgress.progress) {
				const userProgress = currentUserProgress.progress;
				let prevWasClear = false; // 直前がclearかどうか

				$(".destination").each(function () {
					const $destination = $(this);
					const $goalElement = $destination.find(".goal");
					let isClear = false; // 今回のclear判定用

					const tagClass = $destination
						.attr("class")
						.split(" ")
						.find(function (className) {
							return userProgress.hasOwnProperty(className);
						});

					let progressValue = null;
					if (tagClass) {
						progressValue = parseInt(userProgress[tagClass], 10);

						if (progressValue === 0 || isNaN(progressValue)) {
							$goalElement.addClass("not");
						} else if (progressValue === 100) {
							$goalElement.addClass("clear");
							isClear = true;
						}
						// 1~99%は何もしない
					} else {
						$goalElement.addClass("not");
					}

					// next判定
					if (prevWasClear && (progressValue === 0 || isNaN(progressValue))) {
						$goalElement.addClass("next");
					}

					// 次のループ用に状態更新
					prevWasClear = isClear;
				});
			}
		}
	}

	// ページロード時の初期表示
	displayCharacters();
	updateGoalClasses();

	$(function () {
		// archive--itemにactiveを付ける関数（使い回せるようにwindowに出しておく）
		window.updateArchiveItemActive = function () {
			$(".archive--item").removeClass("active");
			const $activeWap = $(".archive--contents--items--wap.active").first();
			if ($activeWap.length) {
				const classes = $activeWap.attr("class").split(" ");
				// 'archive--contents--items--wap'と'active'以外がカテゴリ名
				const categoryClass = classes.find(
					(c) => c !== "archive--contents--items--wap" && c !== "active"
				);
				if (categoryClass) {
					$(".archive--item").each(function () {
						const tx = $(this).find(".TX").text().trim();
						if (tx === categoryClass) {
							$(this).addClass("active");
						}
					});
				}
			}
		};

		// パラメータ(category)の有無を調べる
		const urlParams = new URLSearchParams(window.location.search);
		const categoryParam = urlParams.get("category");

		if (categoryParam) {
			// パラメータ優先: そのカテゴリ名の.archive--contents--items--wapにactiveを付ける
			$(".archive--contents--items--wap").removeClass("active");
			// ←ここも念のためエスケープしておくと安心（特に記号含む場合）
			const safeCategory = CSS.escape(categoryParam);
			$(`.archive--contents--items--wap.${safeCategory}`).addClass("active");
			window.updateArchiveItemActive(); // ←★追加
		} else {
			// パラメータが無いときだけ進捗ベースでactiveを付ける
			const currentUser = allUsersProgress.find(
				(user) => user.username === currentUsername
			);

			if (currentUser && currentUser.progress) {
				// last_progress_key が一番確実
				const lastProgressKey = window.wpData?.last_progress_key;
				let targetKey = lastProgressKey;

				if (!targetKey) {
					targetKey = Object.keys(currentUser.progress).find(
						(key) => currentUser.progress[key] > 0
					);
				}

				if (targetKey) {
					// 通常の進捗アクティブ処理
					const safeKey = CSS.escape(targetKey);
					const $targetDestination = $(`.destination.${safeKey}`).first();
					if ($targetDestination.length) {
						const $parentWap = $targetDestination.closest(
							".archive--contents--items--wap"
						);
						$(".archive--contents--items--wap").removeClass("active");
						$parentWap.addClass("active");
						window.updateArchiveItemActive();
					}
				} else {
					// ★進捗が全くなかった場合は .HTML のタブをactiveにする
					$(".archive--contents--items--wap").removeClass("active");
					$(".archive--contents--items--wap.HTML").addClass("active");
					window.updateArchiveItemActive();
				}
			}
		}
		displayCharacters();
	});

	// 時間帯によって背景画像を切り替える関数
	function updateTimeClass() {
		const now = new Date();
		const hour = now.getHours(); // 0〜23

		let timeClass = "";

		if (hour >= 4 && hour < 7) {
			timeClass = "morning";
		} else if (hour >= 7 && hour < 16) {
			timeClass = "daytime";
		} else if (hour >= 16 && hour < 18) {
			timeClass = "afternoon";
		} else {
			// 18時〜翌4時
			timeClass = "night";
		}

		// すでにmorning, daytime, afternoon, nightがついてたら消す
		$(".road-wappaer")
			.removeClass("morning daytime afternoon night")
			.addClass(timeClass);
	}

	// 最初に1回実行
	updateTimeClass();

	//.daytime-decoに20%の確率でshowクラスを付与
	if (Math.random() <= 0.05) {
		$(".daytime-deco").addClass("show");
	}
	
	// タブのクリックイベントにキャラクター描画処理を追加
	$(".archive--item").on("click", function () {
		// タブの切り替え処理を実行（activeクラスの付け替えなどがされる想定）
		$(".archive--contents--items--wap").removeClass("active");
		const categoryClass = $(this).find(".TX").text();
		$(".archive--contents--items--wap." + categoryClass).addClass("active");

		// 新しくactiveになったカテゴリーに対してキャラクターを再描画
		displayCharacters();
	});
	// MutationObserver のセットアップ（タブ切り替えの要素追加を監視）
	const observer = new MutationObserver((mutationsList, observer) => {
		mutationsList.forEach((mutation) => {
			if (mutation.type === "childList" && mutation.addedNodes.length > 0) {
			}
		});
	});

	// タブ切り替えコンテナの監視を開始
	const containerToObserve = document.querySelector(".archive--contents--tab");
	if (containerToObserve) {
		observer.observe(containerToObserve, { childList: true, subtree: true });
	}

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
