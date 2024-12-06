$(function () {
	function updateProgress() {
		// 現在アクティブなリストを取得
		let activeList = $(".inner--lists.active");
		// data-textの値を取得
		let currentIndex = activeList.data("text");
		// 進捗テキストを更新
		$(".progress--text .TX--num").text(currentIndex);
		// 進捗バーの幅を更新
		$(".progress--bar").css("width", `calc(100% * ${currentIndex} / 15)`);
	}

	// 未選択チェック関数
	function hasUnselectedQuestions(section) {
		return section
			.find(".select")
			.toArray()
			.some((select) => !$(select).find("input:radio:checked").length);
	}

	$(".list--btn__area .btn#next-item").click(function () {
		const currentSection = $(this).closest(".inner--lists");

		// 未選択の質問があるか確認
		if (hasUnselectedQuestions(currentSection)) {
			alert("すべての項目を選択してください。");
		} else {
			// 未選択がない場合、次のセクションに移動
			let $btn_area_parent = $(this).parent().parent().parent();
			$btn_area_parent.removeClass("active");
			$btn_area_parent.next().addClass("active");
			$btn_area_parent.next()[0].scrollIntoView({
				// behavior: "smooth", // アニメーションスクロール
				block: "start"      // 要素の先頭が表示される
			});		
			updateProgress(); // 進捗を更新
		}
	});
  
	$(".list--btn__area .btn#prev-item").on("click", function () {
		let $btn_area_parent = $(this).parent().parent().parent();
		$btn_area_parent.removeClass("active");
		$btn_area_parent.prev().addClass("active");
		$btn_area_parent.prev()[0].scrollIntoView({
			// behavior: "smooth", // アニメーションスクロール
			block: "start"      // 要素の先頭が表示される
		});	
		updateProgress(); // 進捗を更新
	});

	// 初期ロード時に進捗を設定
	updateProgress();
});

document.querySelectorAll(".answer-radio").forEach(function (radio) {
	radio.addEventListener("change", function () {
		var name = this.name;
		// まず、同じグループの全てのラジオボタンから.changeクラスを外す
		document
			.querySelectorAll('input[name="' + name + '"]')
			.forEach(function (otherRadio) {
				otherRadio.classList.remove("change");
			});
		// 選択されたラジオボタン以外に.changeクラスを付与する
		document
			.querySelectorAll('input[name="' + name + '"]')
			.forEach(function (otherRadio) {
				if (otherRadio !== radio) {
					otherRadio.classList.add("change");
				}
			});
	});
});
