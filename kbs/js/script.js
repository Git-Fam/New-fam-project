$(function () {
  // ハンバーガーメニュー
  $(".burger").on("click", function () {
    $(".header--inner").toggleClass("active");
    $("body").toggleClass("active");
  });
  $(".header--nav").on("click", function () {
    $(".header--inner").removeClass("active");
    $("body").removeClass("active");
  });

  // スクロールでヘッダーをずらす
  // スクロールでヘッダーをずらす
  var lastScrollTop = 0;
  var scrollTimeout;

  $(window).scroll(function () {
    var kvHeight = $('.KV').outerHeight();
    var scrollTop = $(window).scrollTop();

    if (scrollTop >= kvHeight) {
      $('.header').addClass('active');
    } else {
      $('.header').removeClass('active');
    }

    clearTimeout(scrollTimeout);
    scrollTimeout = setTimeout(function () {
      $('.header').removeClass('active');
    }, 300);

    lastScrollTop = scrollTop;
  });


  $(".C_selector .list").on("click", function () {
    $(".C_selector .list").removeClass("selected");
    $(this).addClass("selected");
  });
});


document.addEventListener('DOMContentLoaded', function () {
  const lists = document.querySelectorAll('.C_selector .list');
  const items = document.querySelectorAll('.C_example-item .item');

  const noItemsElement = document.createElement('li');
  noItemsElement.classList.add('item');
  noItemsElement.style.display = 'none';
  const noItemsMessage = document.createElement('p');
  noItemsMessage.textContent = '該当する項目がありません。';
  noItemsElement.appendChild(noItemsMessage);

  const exampleItemContainer = document.querySelector('.C_example-item');
  if (exampleItemContainer) {
    exampleItemContainer.appendChild(noItemsElement);
  }

  // URLのハッシュを取得
  const urlHash = window.location.hash.substring(1) || 'all'; // Default to 'all'

  function updateItems(selectedData) {
    let anyVisible = false;

    items.forEach(item => {
      if (selectedData === 'all' || item.getAttribute('text-data') === selectedData) {
        item.style.display = 'block';
        anyVisible = true;
      } else {
        item.style.display = 'none';
      }
    });

    noItemsElement.style.display = anyVisible ? 'none' : 'block';
  }

  lists.forEach(list => {
    list.classList.remove('selected');

    if (list.getAttribute('text-data') === urlHash) {
      list.classList.add('selected');
      updateItems(urlHash);
    }

    list.addEventListener('click', function () {
      lists.forEach(l => l.classList.remove('selected'));
      this.classList.add('selected');

      const selectedData = this.getAttribute('text-data');
      updateItems(selectedData);
    });
  });
});