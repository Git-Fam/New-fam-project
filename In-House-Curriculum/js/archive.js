$(function () {
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
				const lastProgressKey = window.wpData?.last_progress_key;
				let targetKey = lastProgressKey;

				// 進捗0以外が1つでもあるか判定
				const hasAnyProgress = Object.values(currentUser.progress).some(
					(val) => parseInt(val, 10) > 0
				);

				if (!targetKey && !hasAnyProgress) {
					// 進捗が全くない場合
					$(".archive--contents--items--wap").removeClass("active");
					$(".archive--contents--items--wap.HTML").addClass("active");
					window.updateArchiveItemActive();
				} else if (!targetKey && hasAnyProgress) {
					// 進捗がひとつでもある場合、その最初のkeyで動く（従来通り）
					targetKey = Object.keys(currentUser.progress).find(
						(key) => parseInt(currentUser.progress[key], 10) > 0
					);
				}

				if (targetKey) {
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
				}
			}
			var $el = $(".archive--contents--items--wap.HTML");
			$el.addClass("active");
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
	// 	var currentSection = $(".page-section.show");
	// 	currentSection.removeClass("show");
	// 	$(".page1").addClass("show");
	// });

	//道のり　SPchat
	$(".C_chat-content")
		.off("click")
		.on("click", function () {
			$(this).toggleClass("open");
		});

});