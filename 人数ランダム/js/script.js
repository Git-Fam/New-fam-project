$(function () {   
  function updateRandomPeopleCount() {
      // 95から630の間でランダムな数を生成
      var min = 95;
      var max = 130;
      var randomPeopleCount = Math.floor(Math.random() * (max - min + 1)) + min;
      
      var today = new Date().toISOString().split('T')[0];
      
      localStorage.setItem('randomPeopleCount', randomPeopleCount);
      localStorage.setItem('randomPeopleDate', today);
      
      $('.span').text(randomPeopleCount);
  }

  var storedCount = localStorage.getItem('randomPeopleCount');
  var storedDate = localStorage.getItem('randomPeopleDate');
  var today = new Date().toISOString().split('T')[0];

  if (storedCount !== null && storedDate === today) {
      $('.span').text(storedCount);
  } else {
      updateRandomPeopleCount();
  }
});