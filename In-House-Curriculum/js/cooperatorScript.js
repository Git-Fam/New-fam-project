// 適性診断　文字をタイピング風に表示
function TextTypingAnime() {
  $(".C_test .TX-bg .TX").each(function () {
    var elemPos = $(this).offset().top - 50;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    var thisChild = "";
    if (scroll >= elemPos - windowHeight) {
      thisChild = $(this).children(); //spanタグを取得
      //spanタグの要素の１つ１つ処理を追加
      thisChild.each(function (i) {
        var time = 100;
        //時差で表示する為にdelayを指定しその時間後にfadeInで表示させる
        $(this)
          .delay(time * i)
          .fadeIn(time);
      });
    } else {
      thisChild = $(this).children();
      thisChild.each(function () {
        $(this).stop(); //delay処理を止める
        $(this).css("display", "none"); //spanタグ非表示
      });
    }
  });
}
$(window).on("load", function () {
  //spanタグを追加する
  var element = $(".C_test .TX-bg .TX-wrap .TX");
  element.each(function () {
    var text = $(this).html();
    var textbox = "";
    text.split("").forEach(function (t) {
      if (t !== " ") {
        textbox += "<span>" + t + "</span>";
      } else {
        textbox += t;
      }
    });
    $(this).html(textbox);
  });

  TextTypingAnime(); /* アニメーション用の関数を呼ぶ*/
});

// var items = ['1番目','2番目','3番目'];
//   rand = items[Math.floor(Math.random()*items.length)];
//   $('.random').text(rand);;

rand = Math.floor(Math.random() * (100 + 1 - 80)) + 80;
$(".random").text(rand);

// チャットクラス名付与
$(document).ready(function ($) {
  // メッセージリストを初期状態で非表示
  $("#sac-messages").css("visibility", "hidden");

  // 既存のメッセージと新しいメッセージにクラスを付与する共通関数
  function processMessages(nodes) {
    nodes.each(function () {
      var node = $(this);
      if (!node.hasClass("group-processed")) {
        var username = node.find(".sac-chat-name").text().split(":")[0].trim();

        $.ajax({
          url: userGroupData.ajaxurl,
          method: "POST",
          data: {
            action: "get_user_group_by_name",
            username: username,
          },
          success: function (response) {
            if (response.success) {
              node.addClass(response.data.group).addClass("group-processed");

              // ユーザーのグループに一致するメッセージを表示
              if (node.hasClass(userGroupData.group)) {
                node.show();
              }
            }
          },
          error: function (xhr, status, error) {
            console.error("AJAX error:", error);
          },
        });
      }
    });
  }

  // リロード時に既存のメッセージにクラスを付与
  processMessages($("#sac-messages li"));

  // 新しいメッセージが追加されたときの処理
  var observer = new MutationObserver(function (mutationsList) {
    mutationsList.forEach(function (mutation) {
      if (mutation.type === "childList") {
        processMessages($(mutation.addedNodes).filter("li"));
      }
    });
  });
  observer.observe(document.getElementById("sac-messages"), {
    childList: true,
  });

  // すべての処理が完了した後にメッセージリスト全体を表示
  $("#sac-messages").css("visibility", "visible");

  // ユーザーグループクラスをメッセージリストに追加
  $("#sac-messages").addClass(userGroupData.group + "_user");

  // グループのクラス名が付与された後にそのクラスの最新2件のメッセージを抽出
  $(document).ajaxStop(function () {
    var messages = $("#sac-messages li." + userGroupData.group);

    if (messages.length > 0) {
      // ソート処理
      messages.sort(function (a, b) {
        return (
          new Date($(b).attr("data-time")) - new Date($(a).attr("data-time"))
        );
      });

      // 最新2件を抽出して表示
      var latestMessages = messages.slice(0, 2).clone();
      $("#latest-messages").empty().append(latestMessages);
    }
  });

  // 他のページで最新2件のメッセージを表示
  function displayLatestMessages(targetSelector, userGroupClass) {
    var messages = $("#sac-messages li." + userGroupClass);

    if (messages.length > 0) {
      messages.sort(function (a, b) {
        return (
          new Date($(b).attr("data-time")) - new Date($(a).attr("data-time"))
        );
      });

      var latestMessages = messages.slice(0, 2).clone();
      $(targetSelector).empty().append(latestMessages);
    }
  }

  // 実行例
  displayLatestMessages("#another-page-latest-messages", "group_a");
});

// ボタンの文字変更
var submitButton = document.getElementById("submitchat");
if (submitButton) {
  submitButton.value = "送信";
}

// いいね機能
$(document).ready(function ($) {
  $(".like-button").on("click", function () {
    var $button = $(this);

    var itemId = $button.data("item-id");

    // // ボタンを無効化して多重クリックを防止
    // $button.prop("disabled", true);

    $.ajax({
      url: myAjax.ajaxurl,
      type: "POST",
      data: {
        action: "handle_like",
        item_id: itemId,
      },
      success: function (response) {
        console.log("AJAX Response:", response);

        if (response.success) {
          $("#like-count-" + itemId).text(response.data.new_count);
          $button.addClass("liked");
          alert(response.data.message);
        } else {
          alert(response.data.message || "エラーメッセージがありません。");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
        alert("AJAXリクエストに失敗しました: " + error);
      },
      complete: function () {
        $button.prop("disabled", false);
      },
    });
  });
});
