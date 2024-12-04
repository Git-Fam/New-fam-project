// $(function () {
//     let _click = (window.ontouchstart === undefined)? 'click' : 'touchstart';
//     radioNumber = 0;
//     function resultPrice() {
//      $('.result').html(radioNumber.toLocaleString());
//      $('.result').val(radioNumber.toLocaleString());
//     }
//     $('.radio').on(_click, function() {
//      if($(this).closest('.select').find('.checked').length > 0){
//       radioNumber = radioNumber - $(this).closest('.select').find('.checked').data('number');
//       radioNumber = radioNumber + $(this).data('number');
//       $(this).closest('.select').find('.checked').toggleClass('checked');
//       $(this).toggleClass('checked');
//      } else {
//       radioNumber = radioNumber + $(this).data('number');
//       $(this).toggleClass('checked');
//      }
//      resultPrice();
//     })
// });

$(function () {
	let _click = window.ontouchstart === undefined ? "click" : "touchstart";

	// 合計点数を計算する関数
	function calculateSectionTotal(section) {
		let total = 0;
		$(section)
			.find(".radio.checked")
			.each(function () {
				total += $(this).data("number");
			});
		return total;
	}

	// 最も高い数字を見つける関数
	function getHighestNumber(section) {
		let maxNumber = -Infinity;
		$(section)
			.find(".radio.checked")
			.each(function () {
				let number = $(this).data("number");
				if (number > maxNumber) {
					maxNumber = number;
				}
			});
		return maxNumber;
	}

	// 最も高い数字の出現回数をカウントする関数
	function countHighestNumberOccurrences(section, highestNumber) {
		let count = 0;
		$(section)
			.find(".radio.checked")
			.each(function () {
				if ($(this).data("number") === highestNumber) {
					count++;
				}
			});
		return count;
	}

	// 各セクションの結果を更新
	function updateResults() {
		$(".section-radio").each(function () {
			let sectionId = $(this).attr("id");
			let sectionTotal = calculateSectionTotal(this);
			$(`#result_${sectionId}`).val(sectionTotal.toLocaleString());
		});
	}

	// ラジオボタン選択処理
	$(".radio").on(_click, function () {
		let $parentSelect = $(this).closest(".select");
		$parentSelect.find(".checked").removeClass("checked");
		$(this).addClass("checked");
		updateResults();
	});

	// 次へボタン処理
	$(".next").off("click").on("click", function () {
		$(this)
			.closest("section")
			.removeClass("active")
			.next("section")
			.addClass("active");
	});

	// 前へボタン処理
	$(".prev").off("click").on("click", function () {
		$(this)
			.closest("section")
			.removeClass("active")
			.prev("section")
			.addClass("active");
	});

	// 最も高い数字が多いセクションのIDを取得
	function getSectionWithMostHighNumbers() {
		let highestId = null;
		let highestMaxNumber = -Infinity;
		let highestMaxCount = -Infinity;

		$(".section-radio").each(function () {
			let sectionId = $(this).attr("id");
			let maxNumber = getHighestNumber(this); // セクション内の最も高い数字
			let maxCount = countHighestNumberOccurrences(this, maxNumber); // その出現回数

			// 比較ロジック
			if (
				maxNumber > highestMaxNumber || // 最大値が高い場合
				(maxNumber === highestMaxNumber && maxCount > highestMaxCount) // 最大値が同じ場合は出現回数で比較
			) {
				highestMaxNumber = maxNumber;
				highestMaxCount = maxCount;
				highestId = sectionId;
			}
		});

		return highestId;
	}

	// 最も高い数字が多いセクションを確認するボタン処理
	$("#checkHighest").click(function () {
		let highestSectionId = getSectionWithMostHighNumbers();
		alert(`選ばれたのは: ${highestSectionId}`);
	});
});
