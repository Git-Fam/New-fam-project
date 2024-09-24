$(function () {



});

document.addEventListener("DOMContentLoaded", function () {
  function updateActiveLink() {
    var currentHash = window.location.hash;

    document.querySelectorAll('.C_linkIn--item').forEach(function (link) {
      link.classList.remove('active');
    });

    if (currentHash) {
      var activeLink = document.querySelector('a[href="' + currentHash + '"]');
      if (activeLink) {
        activeLink.classList.add('active');
      }
    } else {
      document.querySelector('.C_linkIn--item').classList.remove('active');
    }
  }

  // 初期ロード時に実行
  updateActiveLink();

  // ハッシュが変更されたときに実行
  window.addEventListener('hashchange', updateActiveLink);
});