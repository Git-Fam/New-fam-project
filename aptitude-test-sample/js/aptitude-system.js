$(function () {
	let _click = window.ontouchstart === undefined ? "click" : "touchstart";
	let isFormChanged = false; // フォームの変更状態を管理

	// ラジオボタン選択処理
	$(".radio").on(_click, function () {
		$(this).closest(".select").find(".checked").removeClass("checked");
		$(this).addClass("checked");
		isFormChanged = true; // フォーム変更を記録
		updateResults();
	});

	// リロード時の警告
	const handleBeforeUnload = (event) => {
		if (isFormChanged) {
			event.preventDefault();
			event.returnValue = ""; // デフォルトの警告を表示
		}
	};
	$(window).on("beforeunload", handleBeforeUnload);

	// 合計計算
	const calculateSectionTotal = (section) =>
		$(section)
			.find(".radio.checked")
			.toArray()
			.reduce((sum, el) => sum + $(el).data("number"), 0);

	// 各セクションの結果を更新
	// const updateResults = () =>
	// 	$(".section-radio").each(function () {
	// 		$(`#result_${this.id}`).val(calculateSectionTotal(this).toLocaleString());
	// 	});

	// 最も高い数字が多いセクションのIDを取得
	function getSectionWithMostHighNumbers() {
		let highestId = null;
		let highestTotal = -Infinity;
		let highestMaxCount = -Infinity;
		let highestHolisticTotal = -Infinity;

		$(".section-radio").each(function () {
			const sectionId = this.id,
				sectionTotal = calculateSectionTotal(this),
				maxCount = $(this).find(".radio.checked[data-number=5]").length,
				holisticTotal = $(this)
					.find(".select.holistic .radio.checked")
					.toArray()
					.reduce((sum, el) => sum + $(el).data("number"), 0);

			if (
				sectionTotal > highestTotal ||
				(sectionTotal === highestTotal && maxCount > highestMaxCount) ||
				(sectionTotal === highestTotal &&
					maxCount === highestMaxCount &&
					holisticTotal > highestHolisticTotal)
			) {
				highestTotal = sectionTotal;
				highestMaxCount = maxCount;
				highestHolisticTotal = holisticTotal;
				highestId = sectionId;
			}
		});

		return highestId;
	}

	// 未選択チェック関数
	function hasUnselectedQuestions(section) {
		return section.find(".select").toArray().some((select) => !$(select).find("input:radio:checked").length);
	}

	// 最も高い数字が多いセクションを確認するボタン処理
	$("#result-page").click(function () {
		if ($(".section-radio").toArray().some((section) => hasUnselectedQuestions($(section)))) {
			alert("すべての項目を選択してください。");
		} else {
			isFormChanged = false; // 全て入力済みの場合、リロード警告を解除
			$(window).off("beforeunload", handleBeforeUnload); // beforeunload イベント解除
			const highestSectionId = getSectionWithMostHighNumbers();
			window.location.href = `/result.html?section=${highestSectionId || "unknown"}`;
		}
	});

	// URLからクエリパラメータを取得
	const params = new URLSearchParams(window.location.search);
	const sectionId = params.get("section");

	$(".answer").removeClass("active");
	if (sectionId) {
		$(`#${sectionId}`).addClass("active");
	}

	// 次へボタン処理
	$(".next").click(function () {
		const currentSection = $(this).closest("section");
		if (hasUnselectedQuestions(currentSection)) {
			alert("すべての項目を選択してください。");
		} else {
			currentSection.removeClass("active").next("section").addClass("active");
		}
	});

	// 前へボタン処理
	$(".prev").click(function () {
		$(this).closest("section").removeClass("active").prev("section").addClass("active");
	});
});
