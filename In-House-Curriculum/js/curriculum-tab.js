
// タブ切り替え

$(function () {
    // 初期化：URLのcategoryパラメータに基づいてタブを設定
    if (selectCategory) {
        $(".archive--contents--items--wap").each(function () {
            const classes = $(this).attr("class").split(" ");
            if (classes.includes(selectCategory)) {
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });

        $(".archive--item").each(function () {
            const title = $(this).find(".TX").text().trim();
            if (title === selectCategory) {
                $(this).addClass("active");
            } else {
                $(this).removeClass("active");
            }
        });
    }

    // タブクリック時に URL パラメータとクラスを更新
    $(".archive--item").on("click", function () {
        // すべての.archive--itemから.activeを削除し、クリックしたタブに追加
        $(".archive--item").removeClass("active");
        $(this).addClass("active");

        // クリックしたタブに対応するコンテンツを表示
        $(".archive--contents--items--wap").removeClass("active");
        const index = $(".archive--item").index(this);
        const activeContent = $(".archive--contents--items--wap").eq(index);
        activeContent.addClass("active");

        // カテゴリー名を取得してURLを更新
        const newCategory = $(this).find(".TX").text().trim();
        const newUrl = `${window.location.pathname}?category=${encodeURIComponent(newCategory)}`;
        history.pushState(null, "", newUrl);
    });
});

