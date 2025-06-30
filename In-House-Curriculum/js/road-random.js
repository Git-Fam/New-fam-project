$(function () {
	// --- 落とし物ボタン処理 ---
	$(".road-lost.HTML").on("click", function () {
		$(".action-modal").addClass("show HTML");
	});
	$(".road-lost.jQuery").on("click", function () {
		$(".action-modal").addClass("show jQuery");
	});

	$(document).on("click", ".lost-chara", function (e) {
		const $goal = $(this).closest(".goal-wrap").find(".goal");
		const categoryClass = $(this)
			.attr("class")
			.split(/\s+/)
			.find((cls) => cls !== "lost-chara");

		const alreadyOwned = window.LOST_ITEMS?.owned?.[categoryClass] === true;
		const isPassable = !$goal.hasClass("not") && alreadyOwned;

		// 🔒 どちらの場合もイベントを止める（リンクに伝播させない）
		e.preventDefault();
		e.stopPropagation();

		if (isPassable) {
			$(".action-modal").addClass("show " + categoryClass + "-lostchara");
		}
	});

	$(".lost-button").on("click", function () {
		const button = $(this);
		button.prop("disabled", true);

		const modal = button.closest(".action-modal");
		const classList = modal.attr("class").split(/\s+/);
		const itemType = classList.find(
			(c) => c !== "action-modal" && c !== "show"
		);

		if (itemType) {
			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					action: "mark_lost_item_collected",
					item_type: itemType,
				},
				success: function (res) {
					if (res.success) {
						modal.removeClass("show").removeClass(itemType);
						if (window.LOST_ITEMS?.owned) {
							window.LOST_ITEMS.owned[itemType] = true;
						}
						checkLostTriggers();
					} else {
						console.error("エラー: ", res);
					}
				},

				error: function (xhr, status, error) {
					console.error("通信失敗: ", error);
				},
				complete: function () {
					button.prop("disabled", false);
				},
			});
		}
	});

	// --- 🌟 lost-chara の挿入だけを行う ---
	window.updateLostCharaMarkers = function () {
		const $wap = $(".archive--contents--items--wap.active");
		const categoryClass = $wap
			.attr("class")
			.split(/\s+/)
			.find(
				(cls) => cls !== "archive--contents--items--wap" && cls !== "active"
			);

		const alreadyOwned = window.LOST_ITEMS?.owned?.[categoryClass] === true;
		const disabledClass = alreadyOwned ? "" : " disabled";

		const $allDestinations = $(".destination");
		$allDestinations.each(function (i) {
			const $this = $(this);
			if ($this.hasClass("lost-trigger")) {
				const $target = $allDestinations.eq(i + 2);
				const $goal = $target.find(".goal-wrap");

				if ($goal.length && $goal.find(".lost-chara").length === 0) {
					$goal.append(
						'<div class="lost-chara ' +
							categoryClass +
							disabledClass +
							'"></div>'
					);
				}
			}
		});
	};

	// --- 🧭 is-visible 判定だけ行う ---
	window.checkLostTriggers = function () {
		const $wap = $(".archive--contents--items--wap.active");
		const categoryClass = $wap
			.attr("class")
			.split(/\s+/)
			.find(
				(cls) => cls !== "archive--contents--items--wap" && cls !== "active"
			);

		const $destinations = $wap.find(".page-section .destination");
		const $roadLost = $wap.find(".road-lost." + categoryClass);
		let shouldShow = false;

		$destinations.each(function () {
			const $this = $(this);
			const classList = $this.attr("class");

			if ($this.hasClass("lost-trigger")) {

				const hasClear = $this.find(".goal").hasClass("clear");
				const alreadyOwned = window.LOST_ITEMS?.owned?.[categoryClass] === true;


				if (hasClear && !alreadyOwned) {
					shouldShow = true;
				}
			}
		});

		// 🌟 ここにランダム判定を追加

		if (shouldShow && Math.random() <= 1) {
			// 40%の確率で表示
			$roadLost.addClass("is-visible");
		} else {
			$roadLost.removeClass("is-visible");
		}
	};

	// 初期実行
	updateLostCharaMarkers();
	setTimeout(() => {
		checkLostTriggers();
	}, 100);

	// セクション切り替え
	// セクション切り替え後に遅延して checkLostTriggers 実行
	$(".section-arrow").on("click", function () {
		setTimeout(() => {
			updateLostCharaMarkers();

			requestAnimationFrame(() => {
				setTimeout(() => {
					checkLostTriggers(); // ← この時点では DOM に destination がある
				}, 50);
			});
		}, 300);
	});

	// --- 📨 渡すボタンでチェックを外す処理 ---
	$(document).on("click", ".lost-pass-button", function () {
		const modal = $(this).closest(".action-modal");
		const classList = modal.attr("class").split(/\s+/);
		const itemType = classList
			.find((cls) => cls.endsWith("-lostchara"))
			?.replace("-lostchara", "");

		if (!itemType) return;

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
				action: "unmark_lost_item_collected",
				item_type: itemType,
			},
			success: function (res) {
				if (res.success) {
					modal.removeClass("show").removeClass(itemType + "-lostchara");

					// ✅ JS側の状態更新
					if (window.LOST_ITEMS?.owned) {
						window.LOST_ITEMS.owned[itemType] = false;
					}
					updateLostCharaMarkers(); // ← アイコンの再描画も
					checkLostTriggers(); // ← 表示状態の再判定も

					modal.addClass("show " + itemType + "-pass");
				}
			},
			error: function (xhr, status, error) {
				console.error("通信エラー:", error);
			},
		});
	});
});

//キラキラをランダムに配置する
function generateGlittersForSection($section) {
	const sectionId = $section.attr("class").match(/page[\d\-]+/)?.[0];
	const $roadInner = $section.find(".road-inner");

	if (!$roadInner.length || !sectionId) return;

	const glitterCount = Math.floor(Math.random() * 6); // 0〜5
	const width = $roadInner.outerWidth();
	const height = $roadInner.outerHeight();

	$roadInner.find(".random-glitter").remove(); // リセット

	for (let i = 0; i < glitterCount; i++) {
		const x = Math.random() * (width - 40);
		const y = Math.random() * (height - 40);

		let url = null;
		const isHint = Math.random() < 0.5;

		if (isHint) {
			const $activeWap = $(".archive--contents--items--wap.active");

			let activeCat = null;
			if ($activeWap.length) {
				const classes = $activeWap.attr("class").split(/\s+/);
				activeCat = classes.find(
					(cls) => cls !== "archive--contents--items--wap" && cls !== "active"
				);
				if (activeCat) {
					activeCat = activeCat.toLowerCase(); // ←ここで強制的に小文字に
				}
			}
			const hintLinks = RandomLinksData.hintLinks?.[activeCat] || [];

			if (hintLinks.length > 0) {
				url = hintLinks[Math.floor(Math.random() * hintLinks.length)];
			}
		} else {
			const events = RandomLinksData.eventLinks || [];
			if (events.length > 0) {
				url = events[Math.floor(Math.random() * events.length)];
			}
		}

		if (!url) continue;

		const $g = $(
			`<a class="random-glitter" target="_blank" href="${url}"></a>`
		);
		$g.css({
			position: "absolute",
			top: y + "px",
			left: x + "px",
		});
		$roadInner.append($g);
	}
}

function onSectionShown() {
	$(".page-section").each(function () {
		generateGlittersForSection($(this));
	});
}

$(function () {
	// 画面読み込み後、少し待ってから初期表示処理を実行
	setTimeout(() => {
		onSectionShown();
	}, 300);

	$(".section-arrow").on("click", function () {
		setTimeout(() => {
			onSectionShown();
		}, 300);
	});
});
