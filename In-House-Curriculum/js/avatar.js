$(function () {
	// エラーハンドリングを追加
	window.addEventListener("error", function (e) {
		console.log("JavaScript error caught:", e.error);
		// エラーをログに記録するが、処理は継続
	});

	// 現在選択されているアバターの情報を保存する変数
	var currentSelectedAvatar = null;

	// カテゴリータブ切り替え(スキン編集画面)
	$(document).on("click", ".category__list__items li", function () {
		console.log("Category tab clicked:", $(this).text());
		$(".category__list__items li").removeClass("active");
		$(this).addClass("active");

		$(".tag__list__area").removeClass("active");
		var index = $(".category__list__items li").index(this);
		$(".tag__list__area").eq(index).addClass("active");

		$(".control__list__wrap").removeClass("active");
		$(".control__list__wrap").eq(index).addClass("active");

		// 1つ目の.tag__itemに.activeを付与
		var activeTagListArea = $(".tag__list__area").eq(index);
		activeTagListArea.find(".tag__item").removeClass("active");
		activeTagListArea.find(".tag__item").first().addClass("active");

		// .tag__item.activeに対応した.control__category-tag__listにactiveを付与
		var controlListWrap = $(".control__list__wrap").eq(index);
		controlListWrap.find(".control__category-tag__list").removeClass("active");
		controlListWrap
			.find(".control__category-tag__list")
			.first()
			.addClass("active");
	});

	// タグタブ切り替え(スキン編集画面)
	$(document).on("click", ".tag__list__items li .tag__item", function () {
		console.log("Tag tab clicked:", $(this).text());
		$(".tag__list__items li .tag__item").removeClass("active");
		$(this).addClass("active");

		$(".control__category-tag__list").removeClass("active");
		var index = $(".tag__list__items li .tag__item").index(this);
		$(".control__category-tag__list").eq(index).addClass("active");
	});

	// やめるボタン
	$(document).on("click", ".item__button .buttons.cancel", function () {
		$(".display__character__serif").addClass("none");
		$("input.category-tag__item--wrap").prop("checked", false);
	});

	// 操作履歴を保存するためのスタック
	var actionStack = [];

	// 操作をスタックにプッシュする関数
	function pushAction(action) {
		actionStack.push(action);
	}

	// 操作を元に戻す関数
	function popAction() {
		return actionStack.pop();
	}

	// クリックでimgを変更（着せ替え）
	$(document).on("change", "input.category-tag__item--wrap", function () {
		console.log("=== Input change event triggered ===");
		console.log("this:", this);
		console.log('$(this).attr("name"):', $(this).attr("name"));
		console.log("$(this).val():", $(this).val());

		var name = $(this).attr("name");
		var thumbnailUrl = $(this).closest("li").find("img").attr("src");
		var value = $(this).val();
		var category = name.replace("selected_items-", "");

		console.log("=== Input change event ===");
		console.log("name:", name);
		console.log("thumbnailUrl:", thumbnailUrl);
		console.log("value:", value);
		console.log("category:", category);

		// 現在の状態をスタックにプッシュ
		pushAction({
			name: name,
			previousUrl: $("." + name).attr("src"),
		});

		// アバターかアイテムかを判定（post_typeで判定）
		var $input = $(this);
		var $controlWrap = $input.closest(".control__list__wrap");
		var isAvatar =
			$controlWrap.hasClass("active") &&
			$controlWrap.prevAll(".control__list__wrap").length === 0;

		console.log("isAvatar:", isAvatar);
		console.log(
			'$controlWrap.hasClass("active"):',
			$controlWrap.hasClass("active")
		);
		console.log(
			'$controlWrap.prevAll(".control__list__wrap").length:',
			$controlWrap.prevAll(".control__list__wrap").length
		);

		if (isAvatar) {
			console.log("Processing as avatar");
			// アバターの場合はselected_items-character-characterクラスを更新
			$(".selected_items-character-character").attr("src", thumbnailUrl);

			// アバターのアスペクト比とスタイルを適用
			var aspectRatio = $(this).closest("li").find(".aspect-ratio").text();
			var avatarStyle = $(this).closest("li").find(".avatar-style").text();
			var styleAttr = "";
			if (aspectRatio) {
				styleAttr += "aspect-ratio: " + aspectRatio + "; ";
			}
			if (avatarStyle) {
				styleAttr += avatarStyle;
			}
			if (styleAttr) {
				$(".selected_items-character-character").attr("style", styleAttr);
			}

			// アバター情報を保存
			currentSelectedAvatar = {
				id: value.split("-").pop(),
				value: value,
				thumbnail: thumbnailUrl,
				aspectRatio: aspectRatio,
				style: avatarStyle,
			};
			console.log("currentSelectedAvatar updated:", currentSelectedAvatar);
			// hidden inputを更新
			$("#selected_avatar_input").val(value);
			console.log("selected_avatar input updated:", value);
		} else {
			console.log("Processing as item");
			// アバターのカテゴリー名（normal等）の場合はスキップ
			var $avatarCategories = $(".control__list__wrap")
				.first()
				.find(".control__category-tag__list");
			var isAvatarCategory = false;
			$avatarCategories.each(function () {
				var avatarCategoryName = $(this)
					.find("input")
					.first()
					.attr("name")
					.replace("selected_items-", "");
				if (category === avatarCategoryName) {
					isAvatarCategory = true;
					return false; // break
				}
			});

			if (isAvatarCategory) {
				console.log("Skipping avatar category:", category);
				return; // アバターカテゴリーの場合はスキップ
			}

			var $itemElement = $(".selected_items-" + category);
			if ($itemElement.length === 0) {
				// アイテム要素が存在しない場合は作成
				$(".display__character").append(
					'<img class="selected_items-item selected_items-' +
						category +
						'" src="' +
						thumbnailUrl +
						'">'
				);
				$itemElement = $(".selected_items-" + category);
			} else {
				$itemElement.attr("src", thumbnailUrl);
			}

			// アイテムのアスペクト比とカスタムスタイルを適用
			var aspectRatio = $(this).closest("li").find(".aspect-ratio").text();
			var itemStyle = $(this).closest("li").find(".item-style").text();
			var styleAttr = "";
			if (aspectRatio) {
				styleAttr += "aspect-ratio: " + aspectRatio + "; ";
			}
			if (itemStyle) {
				styleAttr += itemStyle;
			}

			// アバター別のアイテムスタイルを適用
			if (currentSelectedAvatar) {
				var avatarId = currentSelectedAvatar.id;
				var avatarItemStyles = getAvatarItemStyles(avatarId);
				console.log("Avatar ID:", avatarId);
				console.log("Avatar Item Styles:", avatarItemStyles);
				console.log("Item ID:", value.split("-").pop());
				if (avatarItemStyles && avatarItemStyles[value.split("-").pop()]) {
					console.log(
						"Applying avatar-specific style:",
						avatarItemStyles[value.split("-").pop()]
					);
					styleAttr += avatarItemStyles[value.split("-").pop()];
				}
			}

			// 既存のスタイル情報を保持（display-character.phpで生成されたスタイル）
			var existingStyle = $itemElement.attr("style") || "";
			if (existingStyle && !existingStyle.includes("aspect-ratio:")) {
				// 既存のスタイルにアスペクト比が含まれていない場合は追加
				if (aspectRatio) {
					existingStyle = "aspect-ratio: " + aspectRatio + "; " + existingStyle;
				}
			}

			// 最終的なスタイルを適用
			var finalStyle = styleAttr || existingStyle;
			if (finalStyle) {
				$itemElement.attr("style", finalStyle);
			}
		}

		// 試着表示を更新
		updateCharacterDisplay();
	});

	// ひとつ戻すボタンのクリックイベント
	$(document).on("click", ".sideButton__button", function () {
		var lastAction = popAction();
		if (lastAction) {
			$("." + lastAction.name).attr("src", lastAction.previousUrl);
		}
	});

	// input要素の::beforeがある場合の処理
	$(document).on("change", "input.category-tag__item--wrap", function () {
		console.log("=== Purchase dialog change event triggered ===");
		console.log("this:", this);
		console.log('$(this).is(":checked"):', $(this).is(":checked"));
		console.log(
			'$(this).siblings(".nothing-item").hasClass("active"):',
			$(this).siblings(".nothing-item").hasClass("active")
		);

		var paymentType = $(this).closest("li").find(".payment_type").text();
		var thumbnailUrl = $(this).closest("li").find("img").attr("src"); // 画像のURLを取得
		var tag = $(this).data("tag"); // データ属性からタグを取得
		var name = $(this).attr("name");
		var price = $(this).closest("li").find(".price").text();

		console.log("=== Purchase dialog change event ===");
		console.log("paymentType:", paymentType);
		console.log("thumbnailUrl:", thumbnailUrl);
		console.log("tag:", tag);
		console.log("name:", name);
		console.log("price:", price);

		// 現在の状態をスタックにプッシュ
		pushAction({
			name: name,
			previousUrl: $("." + name).attr("src"),
		});

		// 購入ダイアログの表示条件を修正
		// チェックされている かつ 所持していないアイテムの場合に表示
		if (
			$(this).is(":checked") &&
			!$(this).siblings(".nothing-item").hasClass("active")
		) {
			console.log("=== Showing purchase dialog ===");
			console.log(
				"Dialog element exists:",
				$(".display__character__serif").length
			);
			console.log(
				"Dialog current classes:",
				$(".display__character__serif").attr("class")
			);
			$(".display__character__serif").removeClass("none");
			console.log(
				"Dialog classes after removing none:",
				$(".display__character__serif").attr("class")
			);
			$(".item__cost .icon").removeClass("coin point").addClass(paymentType); // 以前のクラスを削除してから追加
			$(".item__cost .TX").text(price); // 価格を設定
			$(".item__img").attr("src", thumbnailUrl); // 画像のURLを設定
			if (tag) {
				$(".character__" + tag).attr("src", thumbnailUrl); // タグに対応する画像のURLを設定
			}

			console.log("=== Purchase dialog updated ===");
			console.log("Cost display:", $(".item__cost .TX").text());
			console.log("Payment type class:", $(".item__cost .icon").attr("class"));
			console.log("Exchange button exists:", $(".buttons.exchange").length);
			console.log(
				"Exchange button disabled:",
				$(".buttons.exchange").prop("disabled")
			);
		} else if (
			$(this).is(":checked") &&
			$(this).siblings(".nothing-item").hasClass("active")
		) {
			// 所持しているアイテムの場合は購入ダイアログを非表示
			console.log("=== Item already owned, hiding purchase dialog ===");
			$(".display__character__serif").addClass("none");
		} else {
			console.log("=== Hiding purchase dialog ===");
			$(".display__character__serif").addClass("none");
			$(".item__cost .icon").removeClass("coin point"); // すべてのクラスを削除
			$(".item__cost .TX").text(""); // 価格をクリア
			$(".item__img").attr("src", ""); // 画像のURLをクリア
			if (tag) {
				$(".character__" + tag).attr("src", ""); // タグに対応する画像のURLをクリア
			}
		}

		// saving__buttonのdisabled属性の制御
		var hasUnpurchasedItem = false;
		$("input.category-tag__item--wrap").each(function () {
			if (
				$(this).is(":checked") &&
				!$(this).siblings(".nothing-item").hasClass("active")
			) {
				hasUnpurchasedItem = true;
			}
		});

		if (hasUnpurchasedItem) {
			$(".saving__button").attr("disabled", "disabled");
		} else {
			$(".saving__button").removeAttr("disabled");
		}
	});

	// アイテム選択時の処理
	function updateCharacterDisplay() {
		// チェックされているアイテムを取得
		var checkedItems = {};
		var selectedAvatar = null;

		$("input.category-tag__item--wrap:checked").each(function () {
			var name = $(this).attr("name");
			var value = $(this).val();
			var category = name.replace("selected_items-", "");

			// アバターかアイテムかを判定（post_typeで判定）
			var $input = $(this);
			var $controlWrap = $input.closest(".control__list__wrap");
			var isAvatar =
				$controlWrap.hasClass("active") &&
				$controlWrap.prevAll(".control__list__wrap").length === 0;

			if (isAvatar) {
				// アバターの場合
				selectedAvatar = value;
			} else {
				// アイテムの場合（アバターエリア以外）
				checkedItems[category] = value;
			}
		});

		// アバターの更新（既存のselected_items-character-character要素のsrcを上書き）
		if (selectedAvatar) {
			var avatarThumbnail = $('input[value="' + selectedAvatar + '"]')
				.closest("li")
				.find("img")
				.attr("src");
			var avatarAspectRatio = $('input[value="' + selectedAvatar + '"]')
				.closest("li")
				.find(".aspect-ratio")
				.text();
			var avatarStyle = $('input[value="' + selectedAvatar + '"]')
				.closest("li")
				.find(".avatar-style")
				.text();

			$(".selected_items-character-character").attr("src", avatarThumbnail);

			// アスペクト比とスタイルを適用
			var styleAttr = "";
			if (avatarAspectRatio) {
				styleAttr += "aspect-ratio: " + avatarAspectRatio + "; ";
			}
			if (avatarStyle) {
				styleAttr += avatarStyle;
			}
			if (styleAttr) {
				$(".selected_items-character-character").attr("style", styleAttr);
			}

			// アバター情報を保存
			currentSelectedAvatar = {
				id: selectedAvatar.split("-").pop(),
				value: selectedAvatar,
				thumbnail: avatarThumbnail,
				aspectRatio: avatarAspectRatio,
				style: avatarStyle,
			};
			// hidden inputを更新
			$("#selected_avatar_input").val(selectedAvatar);
			console.log(
				"selected_avatar input updated in updateCharacterDisplay:",
				selectedAvatar
			);
		} else {
			// アバターが選択されていない場合はデフォルト画像に戻す
			var defaultAvatarUrl =
				// "/wp-content/themes/In-House-Curriculum/img/avatar-img/avatar01.webp";
			$(".selected_items-character-character").attr("src", defaultAvatarUrl);
			$(".selected_items-character-character").removeAttr("style");
		}

		// アイテムの更新（アイテムエリアの要素のみ）
		$(".selected_items-item").hide(); // 一旦すべて非表示

		$.each(checkedItems, function (category, value) {
			// アイテムエリアの要素かどうかを再確認
			var $input = $('input[value="' + value + '"]');
			var $controlWrap = $input.closest(".control__list__wrap");
			var isItem = !(
				$controlWrap.hasClass("active") &&
				$controlWrap.prevAll(".control__list__wrap").length === 0
			);

			if (!isItem) {
				return; // アバターの場合はスキップ
			}

			// さらに、アバターのカテゴリー名（normal等）の場合はスキップ
			var $avatarCategories = $(".control__list__wrap")
				.first()
				.find(".control__category-tag__list");
			var isAvatarCategory = false;
			$avatarCategories.each(function () {
				var avatarCategoryName = $(this)
					.find("input")
					.first()
					.attr("name")
					.replace("selected_items-", "");
				if (category === avatarCategoryName) {
					isAvatarCategory = true;
					return false; // break
				}
			});

			if (isAvatarCategory) {
				return; // アバターカテゴリーの場合はスキップ
			}

			var itemThumbnail = $input.closest("li").find("img").attr("src");
			var itemAspectRatio = $input.closest("li").find(".aspect-ratio").text();
			var itemStyle = $input.closest("li").find(".item-style").text();

			// アイテムIDを取得
			var itemId = value.split("-").pop();

			var $itemElement = $(".selected_items-" + category);
			if ($itemElement.length === 0) {
				// アイテム要素が存在しない場合は作成
				$(".display__character").append(
					'<img class="selected_items-item selected_items-' +
						category +
						'" src="' +
						itemThumbnail +
						'">'
				);
				$itemElement = $(".selected_items-" + category);
			} else {
				$itemElement.attr("src", itemThumbnail);
			}

			$itemElement.show();

			// アスペクト比とスタイルを適用
			var styleAttr = "";
			if (itemAspectRatio) {
				styleAttr += "aspect-ratio: " + itemAspectRatio + "; ";
			}
			if (itemStyle) {
				styleAttr += itemStyle;
			}

			// アバター別のアイテムスタイルを適用
			if (currentSelectedAvatar) {
				var avatarId = currentSelectedAvatar.id;
				var avatarItemStyles = getAvatarItemStyles(avatarId);
				console.log("Avatar ID:", avatarId);
				console.log("Avatar Item Styles:", avatarItemStyles);
				console.log("Item ID:", itemId);
				if (avatarItemStyles && avatarItemStyles[itemId]) {
					console.log(
						"Applying avatar-specific style:",
						avatarItemStyles[itemId]
					);
					styleAttr += avatarItemStyles[itemId];
				}
			}

			// 既存のスタイル情報を保持（display-character.phpで生成されたスタイル）
			var existingStyle = $itemElement.attr("style") || "";
			if (existingStyle && !existingStyle.includes("aspect-ratio:")) {
				// 既存のスタイルにアスペクト比が含まれていない場合は追加
				if (itemAspectRatio) {
					existingStyle =
						"aspect-ratio: " + itemAspectRatio + "; " + existingStyle;
				}
			}

			// 最終的なスタイルを適用
			var finalStyle = styleAttr || existingStyle;
			if (finalStyle) {
				$itemElement.attr("style", finalStyle);
			}
		});
	}

	// アバター別のアイテムスタイルを取得する関数
	function getAvatarItemStyles(avatarId) {
		console.log("Getting avatar item styles for avatar ID:", avatarId);

		// 現在選択されているアバターのinputから直接取得
		var $currentAvatarInput = $(
			'input[value="' + currentSelectedAvatar.value + '"]'
		);
		if ($currentAvatarInput.length > 0) {
			var avatarItemStylesData = $currentAvatarInput
				.closest("li")
				.find(".avatar-item-styles")
				.text();
			console.log(
				"Raw avatar item styles data from current avatar:",
				avatarItemStylesData
			);
			if (
				avatarItemStylesData &&
				avatarItemStylesData !== "null" &&
				avatarItemStylesData !== ""
			) {
				try {
					var parsedStyles = JSON.parse(avatarItemStylesData);
					console.log(
						"Parsed avatar item styles from current avatar:",
						parsedStyles
					);
					return parsedStyles;
				} catch (e) {
					console.log(
						"Failed to parse avatar item styles from current avatar:",
						e
					);
					console.log("Raw data:", avatarItemStylesData);
				}
			}
		}

		// フォールバック: アバターIDで検索
		var $avatarInput = $('input[value*="-' + avatarId + '"]').first();
		console.log("Found avatar input by ID:", $avatarInput.length > 0);
		if ($avatarInput.length > 0) {
			var avatarItemStylesData = $avatarInput
				.closest("li")
				.find(".avatar-item-styles")
				.text();
			console.log("Raw avatar item styles data by ID:", avatarItemStylesData);
			if (
				avatarItemStylesData &&
				avatarItemStylesData !== "null" &&
				avatarItemStylesData !== ""
			) {
				try {
					var parsedStyles = JSON.parse(avatarItemStylesData);
					console.log("Parsed avatar item styles by ID:", parsedStyles);
					return parsedStyles;
				} catch (e) {
					console.log("Failed to parse avatar item styles by ID:", e);
					console.log("Raw data:", avatarItemStylesData);
				}
			}
		}

		return null;
	}

	// ページ読み込み時に実行
	$(document).ready(function () {
		console.log("=== Page loaded ===");
		console.log("Exchange button exists:", $(".buttons.exchange").length);
		console.log("Exchange button HTML:", $(".buttons.exchange").html());

		// メガネの要素を確認
		console.log("=== Glasses elements debug ===");
		$('input[name="selected_items-glasses"]').each(function (index) {
			console.log("Glasses element " + index + ":");
			console.log("  value:", $(this).val());
			console.log("  price:", $(this).closest("li").find(".price").text());
			console.log(
				"  payment_type:",
				$(this).closest("li").find(".payment_type").text()
			);
			console.log("  checked:", $(this).is(":checked"));
		});

		// 帽子の要素も確認（比較用）
		console.log("=== Hat elements debug ===");
		$('input[name="selected_items-hat"]').each(function (index) {
			console.log("Hat element " + index + ":");
			console.log("  value:", $(this).val());
			console.log("  price:", $(this).closest("li").find(".price").text());
			console.log(
				"  payment_type:",
				$(this).closest("li").find(".payment_type").text()
			);
			console.log("  checked:", $(this).is(":checked"));
		});

		// デフォルトのアバター情報を設定
		var defaultAvatarInput = $('input[value*="normal-7547"]').first();
		if (defaultAvatarInput.length > 0) {
			currentSelectedAvatar = {
				id: "7376",
				value: "normal-7547",
				thumbnail: defaultAvatarInput.closest("li").find("img").attr("src"),
				aspectRatio: defaultAvatarInput
					.closest("li")
					.find(".aspect-ratio")
					.text(),
				style: defaultAvatarInput.closest("li").find(".avatar-style").text(),
			};
		}

		updateCharacterDisplay();
	});

	// ラジオボタンのチェック解除時の処理
	$(document).on("change", "input.category-tag__item--wrap", function () {
		var name = $(this).attr("name");
		var category = name.replace("selected_items-", "");

		// チェックが外された場合
		if (!$(this).is(":checked")) {
			// アバターかアイテムかを判定
			var $input = $(this);
			var $controlWrap = $input.closest(".control__list__wrap");
			var isAvatar =
				$controlWrap.hasClass("active") &&
				$controlWrap.prevAll(".control__list__wrap").length === 0;

			if (isAvatar) {
				// アバターの場合はデフォルト画像に戻す
				var defaultAvatarUrl =
					// "/wp-content/themes/In-House-Curriculum/img/avatar-img/avatar01.webp";
				$(".selected_items-character-character").attr("src", defaultAvatarUrl);
				$(".selected_items-character-character").removeAttr("style");
			} else {
				// アイテムの場合は該当する要素を非表示にする
				var $itemElement = $(".selected_items-" + category);
				if ($itemElement.length > 0) {
					$itemElement.hide();
				}
			}
		}
	});

	// 交換するボタンのクリックイベント
	$(document).on("click", ".buttons.exchange", function () {
		console.log("=== Exchange button clicked (document.on) ===");
		console.log("Exchange button element:", this);

		// 未所持かつ選択中のinputを探す
		var $checkedInput = $("input.category-tag__item--wrap:checked").filter(
			function () {
				return !$(this).siblings(".nothing-item").hasClass("active");
			}
		);

		if ($checkedInput.length === 0) {
			alert("交換できるアイテムが選択されていません。");
			return;
		}

		var selectedItem = $checkedInput.val();
		var paymentType = $checkedInput.closest("li").find(".payment_type").text();
		var costText = $checkedInput.closest("li").find(".price").text();
		var cost = parseInt(costText, 10);

		console.log("=== Exchange button clicked ===");
		console.log("paymentType:", paymentType);
		console.log("costText:", costText);
		console.log("cost:", cost);
		console.log("selectedItem:", selectedItem);
		console.log("user_id:", user_id);
		console.log("ajaxurl:", ajaxurl);

		// デバッグ: チェックされている要素の詳細を確認
		console.log("=== Checked elements debug ===");
		$checkedInput.each(function (index) {
			console.log("Checked element " + index + ":");
			console.log("  name:", $(this).attr("name"));
			console.log("  value:", $(this).val());
			console.log(
				"  category:",
				$(this).attr("name").replace("selected_items-", "")
			);
			console.log("  price:", $(this).closest("li").find(".price").text());
			console.log(
				"  payment_type:",
				$(this).closest("li").find(".payment_type").text()
			);
			console.log(
				"  is_owned:",
				$(this).siblings(".nothing-item").hasClass("active")
			);
		});

		// コストが無効な場合はエラー
		if (isNaN(cost) || cost <= 0) {
			console.error("Invalid cost:", cost);
			alert("価格が正しく設定されていません。");
			return;
		}

		// 選択されたアイテムがない場合はエラー
		if (!selectedItem) {
			console.error("No item selected");
			alert("アイテムが選択されていません。");
			return;
		}

		if (confirm("本当に交換しますか？")) {
			console.log("=== Sending AJAX request ===");
			$.ajax({
				url: ajaxurl, // WordPressのAjax URL
				type: "POST",
				data: {
					action: "exchange_item",
					nonce: exchange_ajax.nonce,
					payment_type: paymentType,
					cost: cost,
					user_id: user_id, // 現在のユーザーID
					selected_item: selectedItem, // 選択されたアイテム
				},
				success: function (response) {
					console.log("AJAX success response:", response);
					if (response.success) {
						alert("交換が成功しました！");
						location.reload(); // ページをリロードして最新の情報を表示
					} else {
						alert("交換に失敗しました: " + response.data);
					}
				},
				error: function (xhr, status, error) {
					console.log("AJAX error:", xhr, status, error);
					alert("通信エラーが発生しました: " + error);
				},
			});
		}
	});
});
