
$(document).ready(function() {
  $("#form").validate({
    rules: {
      name: {
        required: true
      },
      kana: {
        required: true
      },
      tel: {
        required: false,
      },
      mail: {
        required: true,
        email: true
      },
      mailConfirm: {
        required: true,
        email: true,
        equalTo: "#mail"
      },
      message: {
        required: true
      },
      agreement: {
        required: true
      },
    },
    messages: {
      name: {
        required: "名前を入力してください"
      },
      kana: {
        required: "フリガナを入力してください"
      },
      tel: {
        number: "半角数字で入力してください"
      },
      mail: {
        required: "メールアドレスを入力してください",
        email: "メールアドレスを正しく入力してください"
      },
      mailConfirm: {
        required: "メールアドレスを入力してください",
        email: "メールアドレスを正しく入力してください",
        equalTo: "メールアドレスが一致しません"
      },
      message: {
        required: "お問い合わせ内容を入力してください"
      },
      agreement: {
        required: "同意してください"
      },
    },
    errorClass: "err",
    errorElement: "p",
    errorPlacement: function(error, element) {
      error.appendTo(element.parent());
    },
    highlight: function(element) {
      $(element).addClass('active');
    },
    unhighlight: function(element) {
      $(element).removeClass('active');
    },
  });
  
  // #confirm ボタンがクリックされたときにフォームをバリデートする
  $('#confirm').on('click', function() {
    $("#form").valid();

    if ($("#form").valid() == true) {
      document.getElementById('modal').classList.add('active');
      document.body.classList.add('active');
    }
  });
});



    // モーダルで入力された値を表示
    // id="name"で入力された値をid="name--confirm"に表示
    document.getElementById('name').addEventListener('keyup', function () {
      document.getElementById('name_confirm').textContent = this.value;
    });
    // id="kana"で入力された値をid="kana_confirm"に表示
    document.getElementById('kana').addEventListener('keyup', function () {
      document.getElementById('kana_confirm').textContent = this.value;
    });
    // id="tel"で入力された値をid="tel_confirm"に表示
    document.getElementById('tel').addEventListener('keyup', function () {
      document.getElementById('tel_confirm').textContent = this.value;
    });
    // id="mail"で入力された値をid="mail_confirm"に表示
    document.getElementById('mail').addEventListener('keyup', function () {
      document.getElementById('mail_confirm').textContent = this.value;
    });
    // id="message"で入力された値をid="message_confirm"に表示
    document.getElementById('message').addEventListener('keyup', function () {
      document.getElementById('message_confirm').textContent = this.value;
    });

    // .backをクリックしたらモーダルを閉じる
    document.getElementById('back').addEventListener('click', function () {
      document.getElementById('modal').classList.remove('active');
      document.body.classList.remove('active');
    });
