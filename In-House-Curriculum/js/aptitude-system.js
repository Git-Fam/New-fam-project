$(function () {
	let _click = window.ontouchstart === undefined ? "click" : "touchstart";
	let isFormChanged = false; // フォームの変更状態を管理

	// ラジオボタン選択処理
	$(".radio").on(_click, function () {
		$(this).closest(".select").find(".checked").removeClass("checked");
		$(this).addClass("checked");
		isFormChanged = true; // フォーム変更を記録
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
	const calculateSectionTotal = (ul) =>
		$(ul)
			.find(".radio.checked")
			.toArray()
			.reduce((sum, el) => sum + $(el).data("number"), 0);

	// 最も高い数字が多いセクションのIDを取得
	// function getSectionWithMostHighNumbers() {
	// 	let highestId = null;
	// 	let highestTotal = -Infinity;
	// 	let highestFrequencyScore = -Infinity; // 高いスコアの頻度
	// 	let highestFrequency = -Infinity; // 最頻値の頻度
	// 	let highestGeneralTotal = -Infinity;

	// 	$(".inner--lists").each(function () {
	// 		const sectionId = this.id,
	// 			sectionTotal = calculateSectionTotal(this),
	// 			scoreFrequency = {};

	// 		// スコアの頻度を計算
	// 		$(this)
	// 			.find(".radio.checked")
	// 			.each((_, el) => {
	// 				const score = $(el).data("number");
	// 				scoreFrequency[score] = (scoreFrequency[score] || 0) + 1;
	// 			});

	// 		// 最大頻度のスコアとその頻度を取得
	// 		const maxScore = Math.max(...Object.keys(scoreFrequency).map(Number));
	// 		const maxFrequency = scoreFrequency[maxScore] || 0;

	// 		// select-generalの合計を計算
	// 		const generalTotal = $(this)
	// 			.find(".select.select-general .radio.checked")
	// 			.toArray()
	// 			.reduce((sum, el) => sum + $(el).data("number"), 0);

	// 		// 優先順位：合計スコア > 最大頻度スコア > 最大頻度 > generalTotal
	// 		if (
	// 			sectionTotal > highestTotal ||
	// 			(sectionTotal === highestTotal && maxScore > highestFrequencyScore) ||
	// 			(sectionTotal === highestTotal &&
	// 				maxScore === highestFrequencyScore &&
	// 				maxFrequency > highestFrequency) ||
	// 			(sectionTotal === highestTotal &&
	// 				maxScore === highestFrequencyScore &&
	// 				maxFrequency === highestFrequency &&
	// 				generalTotal > highestGeneralTotal)
	// 		) {
	// 			highestTotal = sectionTotal;
	// 			highestFrequencyScore = maxScore;
	// 			highestFrequency = maxFrequency;
	// 			highestGeneralTotal = generalTotal;
	// 			highestId = sectionId;
	// 		}
	// 	});

	// 	return highestId;
	// }

	function getSectionWithMostHighNumbers() {
		let highestId = null;
		let highestTotal = -Infinity;
		let highestFrequencyScore = -Infinity; // 高いスコアの頻度
		let highestFrequency = -Infinity; // 最頻値の頻度
		let highestGeneralTotal = -Infinity;

		// 条件を満たすセクションを収集
		const candidates = [];

		$(".inner--lists").each(function () {
			const sectionId = this.id,
				sectionTotal = calculateSectionTotal(this),
				scoreFrequency = {};

			// スコアの頻度を計算
			$(this)
				.find(".radio.checked")
				.each((_, el) => {
					const score = $(el).data("number");
					scoreFrequency[score] = (scoreFrequency[score] || 0) + 1;
				});

			// 最大頻度のスコアとその頻度を取得
			const maxScore = Math.max(...Object.keys(scoreFrequency).map(Number));
			const maxFrequency = scoreFrequency[maxScore] || 0;

			// select-generalの合計を計算
			const generalTotal = $(this)
				.find(".select.select-general .radio.checked")
				.toArray()
				.reduce((sum, el) => sum + $(el).data("number"), 0);

			// 優先順位：合計スコア > 最大頻度スコア > 最大頻度 > generalTotal
			if (
				sectionTotal > highestTotal ||
				(sectionTotal === highestTotal && maxScore > highestFrequencyScore) ||
				(sectionTotal === highestTotal &&
					maxScore === highestFrequencyScore &&
					maxFrequency > highestFrequency) ||
				(sectionTotal === highestTotal &&
					maxScore === highestFrequencyScore &&
					maxFrequency === highestFrequency &&
					generalTotal > highestGeneralTotal)
			) {
				// 更新
				highestTotal = sectionTotal;
				highestFrequencyScore = maxScore;
				highestFrequency = maxFrequency;
				highestGeneralTotal = generalTotal;
				highestId = sectionId;

				// 候補をリセットして新しいセクションを追加
				candidates.length = 0;
				candidates.push(sectionId);
			} else if (
				sectionTotal === highestTotal &&
				maxScore === highestFrequencyScore &&
				maxFrequency === highestFrequency &&
				generalTotal === highestGeneralTotal
			) {
				// 条件が完全一致した場合、候補として追加
				candidates.push(sectionId);
			}
		});

		// 条件を満たす複数の候補がある場合、デフォルトで #index16 を選択
		if (candidates.length > 1) {
			return "index16";
		}

		return highestId;
	}

	// 未選択チェック関数
	function hasUnselectedQuestions(section) {
		return section
			.find(".select")
			.toArray()
			.some((select) => !$(select).find("input:radio:checked").length);
	}

	// 最も高い数字が多いセクションを確認するボタン処理
	$("#result-item.engineer").click(function () {
		if (
			$(".inner--lists")
				.toArray()
				.some((section) => hasUnselectedQuestions($(section)))
		) {
			alert("すべての項目を選択してください。");
		} else {
			isFormChanged = false; // 全て入力済みの場合、リロード警告を解除
			$(window).off("beforeunload", handleBeforeUnload); // beforeunload イベント解除
			const highestSectionId = getSectionWithMostHighNumbers();
			window.location.href = `/aptitude-result-engineer?section=${
				highestSectionId || "unknown"
			}`;
		}
	});
	$("#result-item.designer").click(function () {
		if (
			$(".inner--lists")
				.toArray()
				.some((section) => hasUnselectedQuestions($(section)))
		) {
			alert("すべての項目を選択してください。");
		} else {
			isFormChanged = false; // 全て入力済みの場合、リロード警告を解除
			$(window).off("beforeunload", handleBeforeUnload); // beforeunload イベント解除
			const highestSectionId = getSectionWithMostHighNumbers();
			window.location.href = `/aptitude-result-designer?section=${
				highestSectionId || "unknown"
			}`;
		}
	});

	// URLからクエリパラメータを取得
	const params = new URLSearchParams(window.location.search);
	const sectionId = params.get("section");

	$(".answer").removeClass("active");
	if (sectionId) {
		$(`#${sectionId}`).addClass("active");
	}
});
