$(function () {
	// 1️⃣ URLパラメータ取得
	const urlParams = new URLSearchParams(window.location.search);
	const categoryParam = urlParams.get("category");
	let selectCategory = "";

	// 2️⃣ ローカルストレージから読み取り（ただしURLパラメータが優先）
	const savedCategory = localStorage.getItem("selectCategory");
	if (categoryParam) {
		selectCategory = categoryParam;
	} else if (savedCategory) {
		selectCategory = savedCategory;
		localStorage.removeItem("selectCategory");
	}

	// 3️⃣ カテゴリー表示の切り替え
	if (selectCategory) {
		$(".archive--contents--items--wap").each(function () {
			const classes = $(this).attr("class").split(" ");
			if (classes.includes(selectCategory)) {
				$(".archive--contents--items--wap").removeClass("active");
				$(this).addClass("active");
			}
		});
	}

	// 4️⃣ ローカルストレージの初期化（フォームの値を保存）
	if (!localStorage.getItem("initialized")) {
		$("form")
			.serializeArray()
			.forEach((field) => {
				localStorage.setItem(field.name, field.value);
			});
		localStorage.setItem("initialized", true);
	} else {
		$("form").serializeArray(); // 確認用
	}

	// 5️⃣ 更新ボタンがクリックされたとき
	$('input[type="submit"][value="更新"]').on("click", function (event) {
		event.preventDefault(); // フォーム送信を一時停止

		const formData = $("form").serializeArray();
		console.log("Form Data:", formData);

		const updatedFields = formData.filter((field) => {
			const originalValue = localStorage.getItem(field.name);
			console.log(
				"Comparing:",
				field.name,
				"Saved:",
				originalValue,
				"New:",
				field.value
			);
			return originalValue !== field.value;
		});

		if (updatedFields.length > 0) {
			const lastUpdatedField = updatedFields[updatedFields.length - 1].name;

			$.ajax({
				url: "/wp-json/custom-endpoint/get-category",
				method: "POST",
				data: {
					field: lastUpdatedField,
				},
				success: function (response) {
					if (response && response.category) {
						const mappedCategory = response.category;

						localStorage.setItem("selectCategory", mappedCategory);

						window.location.href =
							"/curriculum?category=" + encodeURIComponent(mappedCategory);
					}
				},
			});
		} else {
			$(this).closest("form").submit();
		}
	});

	$(function () {
		// カテゴリータブクリック時の処理
		$(".archive--item").on("click", function () {
			const categoryName = $(this).find(".TX").text().trim();

			// カテゴリー名をパラメータに付与してリロード
			const currentUrl = new URL(window.location.href);
			currentUrl.searchParams.set("category", categoryName);
			window.location.href = currentUrl.toString();
		});
	});
});
