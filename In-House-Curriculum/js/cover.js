$(function () {
    // ローカルストレージからselectCategoryを読み取る
    const savedCategory = localStorage.getItem("selectCategory");
    let selectCategory = ""; // 初期化

    if (savedCategory) {
        selectCategory = savedCategory;
        localStorage.removeItem("selectCategory");
    }

    console.log("Active Category:", selectCategory); // デバッグ用: ログ出力

    // 詳細ページのパンくずリストから戻ってくる
    if (selectCategory) {
        $(".archive--contents--items--wap").each(function () {
            // 現在の要素のクラスからカテゴリー名を取得
            const classes = $(this).attr("class").split(" ");
            if (classes.includes(selectCategory)) {
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    }

    // ページロード時にローカルストレージの初期化（初回のみ）
    if (!localStorage.getItem("initialized")) {
        $("form")
            .serializeArray()
            .forEach((field) => {
                localStorage.setItem(field.name, field.value);
                console.log("Saved Initial Value:", field.name, field.value); // デバッグ用
            });
        localStorage.setItem("initialized", true);
    } else {
        // すでに初期化されている場合、デバッグ用に現在の状態を確認
        $("form")
            .serializeArray()
            .forEach((field) => {
                console.log("Existing Value in LocalStorage:", field.name, localStorage.getItem(field.name));
            });
    }

    // 更新ボタンがクリックされたとき
    $('input[type="submit"][value="更新"]').on("click", function (event) {
        event.preventDefault(); // フォーム送信を一時停止

        const formData = $("form").serializeArray();
        console.log("Form Data:", formData); // デバッグ用: フォームデータを確認

        // カスタムフィールドの値を比較して変更があった項目を取得
        const updatedFields = formData.filter((field) => {
            const originalValue = localStorage.getItem(field.name); // 保存された値と比較
            console.log("Comparing:", field.name, "Saved:", originalValue, "New:", field.value); // デバッグ用
            return originalValue !== field.value; // 値が変わった場合
        });

        if (updatedFields.length > 0) {
            // 最後に変更されたフィールド名を取得
            const lastUpdatedField = updatedFields[updatedFields.length - 1].name;
            console.log("Last Updated Field:", lastUpdatedField); // デバッグ用

            // カテゴリーマッピングをサーバーで取得するリクエスト
            $.ajax({
                url: '/wp-json/custom-endpoint/get-category', // カスタムエンドポイント
                method: 'POST',
                data: {
                    field: lastUpdatedField
                },
                success: function (response) {
                    if (response && response.category) {
                        const mappedCategory = response.category; // サーバーからのカテゴリー名
                        console.log("Mapped Category:", mappedCategory); // デバッグ用

                        // ローカルストレージに変更されたカテゴリー名を保存
                        localStorage.setItem("lastUpdatedCategory", mappedCategory);

                        // ページリダイレクトを設定
                        window.location.href = "/curriculum?category=" + encodeURIComponent(mappedCategory);
                    } else {
                        console.error("Category not found for field:", lastUpdatedField);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching category:", error);
                }
            });
        } else {
            console.log("No fields updated"); // デバッグ用
            $(this).closest("form").submit(); // 通常のフォーム送信
        }
    });
});
