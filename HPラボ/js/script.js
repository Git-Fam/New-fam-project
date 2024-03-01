$(function () {   
  // ハンバーガーメニュー
  $('.gnav-btn, .gnav-sp li').on('click', function () {
    $('.gnav-btn, .gnav-sp').toggleClass('show');
    $("body").toggleClass("active");
});

//ヘッダー
  var height = $('main').offset().top;
  $(window).on("scroll", function() {
    if ($(this).scrollTop() > height ) {
      $("header").addClass('fixed');
    } else {
      $("header").removeClass('fixed');
    }
  });


 // 下から上に出てくるアニメーション
 function scrollupAnime(){
  $('.up').each(function(){ 
      var elemPos = $(this).offset().top-60;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll >= elemPos - windowHeight){
      $(this).addClass('fadeUpanime');
      }else{
      $(this).removeClass('fadeUpanime');
      }
      });
}
$(window).scroll(function (){
  scrollupAnime();
});


//スライダー
$(document).ready(function(){
  $('.production--under').slick({
    autoplay: true,
    autoplaySpeed: 0,
    speed: 5000,
    cssEase: "linear",
    slidesToShow: 3,
    swipe: false,
    arrows: false,
    pauseOnFocus: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2.5
        }
      }
    ]
  });
});

//Q&Aクリックするとアンサーが出てくる
$('.question').click(function(){
  $(this).next().slideToggle();
});

$('.question').on('click', function () {
  $(this).toggleClass('show');
});



});

function validateForm() {
  // 各フィールドの値を取得
  var selectplan = document.getElementById("selectplan").value;
  var name = document.getElementById("name").value;
  var furigana = document.getElementById("furigana").value;
  var office = document.getElementById("name").value;
  var email = document.getElementById("email").value;
  var tel = document.getElementById("tel").value;
  var content = document.getElementById("content").value;


  // エラーメッセージをリセット
  document.querySelectorAll('.err').forEach(function (err) {
      err.classList.remove('active');
      document.getElementById("selectplan").classList.remove('active');
      document.getElementById("name").classList.remove('active');
      document.getElementById("furigana").classList.remove('active');
      document.getElementById("office").classList.remove('active');
      document.getElementById("email").classList.remove('active');
      document.getElementById("err-email-format").classList.remove('active');
      document.getElementById("tel").classList.remove('active');
      document.getElementById("err-tel-format").classList.remove('active');
      document.getElementById("content").classList.remove('active');
  });

  // 各フィールドのバリデーション
  if (selectplan.trim() === "0") {
    document.getElementById("err-plan").classList.add('active');
    document.getElementById("selectplan").classList.add('active');
  }

  if (name.trim() === "") {
    document.getElementById("err-name").classList.add('active');
    document.getElementById("name").classList.add('active');
  }

  if (furigana.trim() === "") {
    document.getElementById("err-furigana").classList.add('active');
    document.getElementById("furigana").classList.add('active');
  }

  if (office.trim() === "") {
    document.getElementById("err-office").classList.add('active');
    document.getElementById("office").classList.add('active');
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
document.getElementById('selectplan').addEventListener('change', function () {
  var selectedValue = this.value;
  document.getElementById('plan--confirm').textContent = selectedValue;
});// id="name"で入力された値をid="name--confirm"に表示
document.getElementById('name').addEventListener('keyup', function () {
  document.getElementById('name--confirm').textContent = this.value;
});
// id="furigana"で入力された値をid="furigana--confirm"に表示
document.getElementById('furigana').addEventListener('keyup', function () {
  document.getElementById('furigana--confirm').textContent = this.value;
});
// id="office"で入力された値をid="office--confirm"に表示
document.getElementById('office').addEventListener('keyup', function () {
  document.getElementById('office--confirm').textContent = this.value;
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


