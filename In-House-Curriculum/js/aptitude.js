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

	// クリックアクション
	$(".answer-radio").on("change", function () {
		var name = $(this).attr("name");
		var id = $(this).attr("id");

		// メッセージを変更

		// ランダムメッセージ
		function displayRandomMessage() {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				const messages = ["ふむふむ...", "なるほど...", "うんうん..."];
				const randomMessage = messages[Math.floor(Math.random() * messages.length)];
				$(".character--message").addClass("active");
				$(".character--message .TX").text(randomMessage);
			}, 100);
		}
		for (let item = 1; item <= 15; item++) {
			for (let question = 1; question <= 96; question++) {
				const idDesigner = `designer-item${item}-question${question}-answer3`;
				const idEngineer = `engineer-item${item}-question${question}-answer3`;

				if (id === idDesigner || id === idEngineer) {
					displayRandomMessage();
				}
			}
		}


		// デザイナー
		if (id === "designer-item1-question3-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("情報収集の習慣つけたいね！");
			}, 100);
		}
		if (id === "designer-item1-question3-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("トレンドやニーズに迅速に対応できるのはいい武器だね！");
			}, 100);
		}

		if (id === "designer-item2-question9-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("変化に気づくって難しいよね");
			}, 100);
		}
		if (id === "designer-item2-question9-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("柔軟に行動できる力...いろんな状況で役に立つね！");
			}, 100);
		}

		if (name === "designer-answer15") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("物事を深く理解して判断できる力は、的確なデザインや提案につながるんだ！");
			}, 100);
		}

		if (id === "designer-item4-question22-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくも苦手...確認作業を習慣化するといいんだって！");
			}, 100);
		}
		if (id === "designer-item4-question22-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("細かい部分まで気を配れると、大きな信頼につながるね！");
			}, 100);
		}

		if (id === "designer-item5-question28-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("急な変化があると焦っちゃうよね");
			}, 100);
		}
		if (id === "designer-item5-question28-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("冷静に計画を調整できるのはデザイナーとしても活かせそうだね");
			}, 100);
		}

		if (id === "designer-item6-question34-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("なかなかむずかしいよね");
			}, 100);
		}
		if (id === "designer-item6-question34-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("よっ！アイデアマン！");
			}, 100);
		}

		if (id === "designer-item7-question40-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("批判は成長のチャンス...?");
			}, 100);
		}
		if (id === "designer-item7-question40-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("逆境に強いね！ぼくもしぶとくいくよ");
			}, 100);
		}

		if (id === "designer-item8-question47-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくはニュースとかよく見るよ！");
			}, 100);
		}
		if (id === "designer-item8-question47-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("業界の変化に敏感！さすがだね！");
			}, 100);
		}

		if (name === "designer-answer48") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("半分終わったよ！その調子でいっちゃおう！");
			}, 100);
		}

		if (id === "designer-item9-question53-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("結果はどうあれ、約束を守る意識をすることが大事だね");
			}, 100);
		}
		if (id === "designer-item9-question53-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("すごいね！ぼくもきみに頼み事しちゃおうかな！");
			}, 100);
		}

		if (id === "designer-item10-question60-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("人をまとめるって簡単じゃないよね");
			}, 100);
		}
		if (id === "designer-item10-question60-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("リーダー性もあるのかな?");
			}, 100);
		}

		if (id === "designer-item11-question67-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくも優柔不断なんだよね〜");
			}, 100);
		}
		if (id === "designer-item11-question67-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("決断力！ぼくにも分けて〜");
			}, 100);
		}

		if (id === "designer-item12-question71-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("変化に気づけるひと憧れるね〜");
			}, 100);
		}
		if (id === "designer-item12-question71-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("（ぼくが明日の夜ご飯のこと考えてたのバレてないよね...）");
			}, 100);
		}

		if (id === "designer-item13-question78-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("お互いの理解が大切だね！");
			}, 100);
		}
		if (id === "designer-item13-question78-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("チームでの協力は、成果を最大化できる！");
			}, 100);
		}

		if (id === "designer-item14-question84-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("言われてから気づくことあるよね...");
			}, 100);
		}
		if (id === "designer-item14-question84-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("細かい点に気づけるデザイナーは需要あるらしいよ..");
			}, 100);
		}

		if (name === "designer-answer86") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ラスト10問だよ〜！");
			}, 100);
		}

		if (id === "designer-item15-question91-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくも効率よくおさんぽできるようになりたい！");
			}, 100);
		}
		if (id === "designer-item15-question91-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("自己管理が得意なんだね！");
			}, 100);
		}

		// エンジニア
		if (id === "engineer-item1-question3-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくも計画的に進めるの苦手...");
			}, 100);
		}
		if (id === "engineer-item1-question3-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("計画的なんだね！すごい！");
			}, 100);
		}

		if (id === "engineer-item2-question9-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("優先順位を考えるのは難しいよね");
			}, 100);
		}
		if (id === "engineer-item2-question9-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("優先順位をつけて動けるのは素晴らしいね");
			}, 100);
		}

		if (name === "engineer-answer15") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("うんうん...");
			}, 100);
		}

		if (id === "engineer-item3-question17-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("いろんな視点で物事をみれるひとすごいよね！");
			}, 100);
		}
		if (id === "engineer-item3-question17-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("創造的な解決力は大きな武器になるね！");
			}, 100);
		}

		if (id === "engineer-item4-question22-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("少しずつ慣れていきたいね");
			}, 100);
		}
		if (id === "engineer-item4-question22-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("計画を守れているのはいい傾向だね！");
			}, 100);
		}

		if (id === "engineer-item5-question28-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("コツコツ大事だよね");
			}, 100);
		}
		if (id === "engineer-item5-question28-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("にんにん！忍耐力！");
			}, 100);
		}

		if (id === "engineer-item6-question34-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("いろんな考えをまとめられるようになりたいな");
			}, 100);
		}
		if (id === "engineer-item6-question34-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("他の意見を受け入れられるのは素敵な強みだね");
			}, 100);
		}

		if (id === "engineer-item7-question41-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ほかの人の意見も大事にしたいもんね");
			}, 100);
		}
		if (id === "engineer-item7-question41-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("芯のあるひとなんだね！");
			}, 100);
		}

		if (id === "engineer-item8-question47-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("伝え方いろいろだよね");
			}, 100);
		}
		if (id === "engineer-item8-question47-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("相手の視点に立てるのはすばらしいね！");
			}, 100);
		}

		if (name === "engineer-answer48") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("半分終わったよ！その調子でいっちゃおう！");
			}, 100);
		}

		if (id === "engineer-item9-question53-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくもみんなにうまく説明できるように意識しないと...");
			}, 100);
		}
		if (id === "engineer-item9-question53-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("論理的に説明ができるってかっこいいな....");
			}, 100);
		}

		if (id === "engineer-item10-question59-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("冷静沈着な鉄のハートの持ち主...?");
			}, 100);
		}
		if (id === "engineer-item10-question59-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("燃える熱意！あちちち...");
			}, 100);
		}

		if (id === "engineer-item11-question66-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("予定通りにいかないこともあるね");
			}, 100);
		}
		if (id === "engineer-item11-question66-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("きっちりかっちり！素晴らしい能力！");
			}, 100);
		}

		if (id === "engineer-item12-question72-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("できるようになりたいなあ");
			}, 100);
		}
		if (id === "engineer-item12-question72-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("よっ！アイデアマン！");
			}, 100);
		}

		if (name === "engineer-answer78") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("公平に判断するのは簡単じゃないよね..");
			}, 100);
		}

		if (id === "engineer-item14-question84-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("結果はどうあれ、約束を守る意識をすることが大事だね");
			}, 100);
		}
		if (id === "engineer-item14-question84-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("すごいね！ぼくもきみに頼み事しちゃおうかな！");
			}, 100);
		}

		if (name === "engineer-answer86") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ラスト10問だよ〜！");
			}, 100);
		}

		if (id === "engineer-item15-question92-answer1") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("ぼくも緊張しちゃうと冷静になれないんだ");
			}, 100);
		}
		if (id === "engineer-item15-question92-answer5") {
			$(".character--message").removeClass("active");
			setTimeout(function () {
				$(".character--message").addClass("active");
				$(".character--message .TX").text("精神力強いんだね！見習いたいなあ");
			}, 100);
		}


		// キャラクターアニメーション
		if (name === "designer-answer02" || name === "engineer-answer02") {
			$(".character--animation .character-item.item-01").addClass("active");
		}

		if (name === "designer-answer10" || name === "engineer-answer10") {
			$(".character--animation .character-item.item-02").addClass("active");
		}

		if (name === "designer-answer18" || name === "engineer-answer18") {
			$(".character--animation .character-item.item-03").addClass("active");
		}

		if (name === "designer-answer20" || name === "engineer-answer20") {
			$(".character--animation .character-item.item-04").addClass("active");
		}

		if (name === "designer-answer30" || name === "engineer-answer30") {
			$(".character--animation .character-item.item-05").addClass("active");
		}

		if (name === "designer-answer33" || name === "engineer-answer33") {
			$(".character--animation .character-item.item-06").addClass("active");
		}

		if (name === "designer-answer45" || name === "engineer-answer45") {
			$(".character--animation .character-item.item-07").addClass("active");
		}

		if (name === "designer-answer48" || name === "engineer-answer48") {
			$(".character--animation .character-item.item-08").addClass("active");
		}

		if (name === "designer-answer56" || name === "engineer-answer56") {
			$(".character--animation .character-item.item-09").addClass("active");
		}

		if (name === "designer-answer58" || name === "engineer-answer58") {
			$(".character--animation .character-item.item-10").addClass("active");
		}

		if (name === "designer-answer69" || name === "engineer-answer69") {
			$(".character--animation .character-item.item-11").addClass("active");
		}

		if (name === "designer-answer72" || name === "engineer-answer72") {
			$(".character--animation .character-item.item-12").addClass("active");
		}

		if (name === "designer-answer81" || name === "engineer-answer81") {
			$(".character--animation .character-item.item-13").addClass("active");
		}

		if (name === "designer-answer82" || name === "engineer-answer82") {
			$(".character--animation .character-item.item-14").addClass("active");
		}

		if (name === "designer-answer96" || name === "engineer-answer96") {
			$(".character--animation .character-item.item-15").addClass("active");
		}
	});

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
