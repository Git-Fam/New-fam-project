$(function () {   
  // ハンバーガーメニュー
   $(".burger").on("click", function(){
     $(this).toggleClass("active");
     $('.nav--btn').toggleClass("active");
    //  $('body').toggleClass("active");
   }); 

   $(".nav--btn a,.header--btn a").on("click", function(){
    $(this).removeClass("active");
    $('.nav--btn').removeClass("active");
    $('.burger').removeClass("active");
    // $('body').toggleClass("active");
  }); 

  //  .recommendが画面上部に来たら.follow--btnにactiveクラスを付与
  $(window).scroll(function () {
    if ($(window).scrollTop() > $('.recommend').offset().top - 100) {
      $('.follow--btn').addClass('active');
    } else {
      $('.follow--btn').removeClass('active');
    }
  });

  // ポリシーモーダルで表示
  $('.footer--btn--modal').on('click', function () {
    $('.f--modal').addClass('active');
    $('body').addClass('active');
  });

  $('.close--modal , .f--modal').on('click', function () {
    $('.f--modal').removeClass('active');
    $('body').removeClass('active');
  });

});

function validateForm() {
  // 各フィールドの値を取得
  var name = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var tel = document.getElementById("tel").value;
  var content = document.getElementById("content").value;

  // エラーメッセージをリセット
  document.querySelectorAll('.err').forEach(function (err) {
      err.classList.remove('active');
      document.getElementById("name").classList.remove('active');
      document.getElementById("email").classList.remove('active');
      document.getElementById("err-email-format").classList.remove('active');
      document.getElementById("tel").classList.remove('active');
      document.getElementById("err-tel-format").classList.remove('active');
      document.getElementById("content").classList.remove('active');
  });

  // 各フィールドのバリデーション
  if (name.trim() === "") {
    document.getElementById("err-name").classList.add('active');
    document.getElementById("name").classList.add('active');
  }

  if (email.trim() === "") {
    document.getElementById("err-email").classList.add('active');
    document.getElementById("email").classList.add('active');
  } else if (!isValidEmail(email)) {
    document.getElementById("err-email-format").classList.add('active');
    document.getElementById("email").classList.add('active');
  }

  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  if (tel.trim() === "") {
    document.getElementById("err-tel").classList.add('active');
    document.getElementById("tel").classList.add('active');
  } else if (!/^\d+$/.test(tel)) {
    document.getElementById("err-tel-format").classList.add('active');
    document.getElementById("tel").classList.add('active');
  }

  if (content.trim() === "") {
    document.getElementById("err-content").classList.add('active');
    document.getElementById("content").classList.add('active');
  }

  // バリデーションが通過した場合
  if (
    document.querySelectorAll('.err.active').length === 0 &&
    isValidEmail(email) &&
    /^\d+$/.test(tel)
  ) {
    document.getElementById('modal').classList.add('active');
    document.body.classList.add('active');
  }
}


// モーダルで入力された値を表示
// id="name"で入力された値をid="name--confirm"に表示
document.getElementById('name').addEventListener('keyup', function () {
  document.getElementById('name--confirm').textContent = this.value;
});
// id="email"で入力された値をid="email--confirm"に表示
document.getElementById('email').addEventListener('keyup', function () {
  document.getElementById('email--confirm').textContent = this.value;
});
// id="tel"で入力された値をid="tel--confirm"に表示
document.getElementById('tel').addEventListener('keyup', function () {
  document.getElementById('tel--confirm').textContent = this.value;
});
// id="content"で入力された値をid="content--confirm"に表示
document.getElementById('content').addEventListener('keyup', function () {
  document.getElementById('content--confirm').textContent = this.value;
});



// .backをクリックしたらモーダルを閉じる
document.getElementById('back').addEventListener('click', function () {
  document.getElementById('modal').classList.remove('active');
  document.body.classList.remove('active');
});

