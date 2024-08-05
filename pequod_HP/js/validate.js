$(function () {
  $(document).ready(function () {
    $("#contact").validate({
      rules: {
        inquiryType: {
          required: true
        },
        companyName: {
          required: true
        },
        name: {
          required: true
        },
        furigana: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        Agreement: {
          required: true
        },
      },
      messages: {
        inquiryType: {
          required: "お問い合わせ種類を選択してください。"
        },
        companyName: {
          required: "必須項目です。入力してください。"
        },
        name: {
          required: "必須項目です。入力してください。"
        },
        furigana: {
          required: "必須項目です。入力してください。"
        },
        email: {
          required: "必須項目です。入力してください。",
          email: "正しいメールアドレスを入力してください。"
        },
        Agreement: {
          required: "同意してください"
        },
      },

      errorClass: "err-message",
      errorElement: "p",
      errorPlacement: function(error, element) {
        error.appendTo(element.parent());
      },
      highlight: function(element) {
        $(element).addClass('err');
      },
      unhighlight: function(element) {
        $(element).removeClass('err');
      },

    });

    // #confirm ボタンがクリックされたときにフォームをバリデートする
    $('#confirm').on('click', function () {
      $("#contact").valid();
    });
  });
});