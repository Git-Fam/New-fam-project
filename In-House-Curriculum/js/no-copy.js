document.addEventListener('contextmenu', function(e) {
    // 画像そのもの、または画像を含むリンクなどを検出
    if (e.target.closest('img')) {
      e.preventDefault();
      return false;
    }
  });
  
  
  document.addEventListener('contextmenu', event => event.preventDefault());
  