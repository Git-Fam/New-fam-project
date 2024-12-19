// 今日の日付を表示
document.addEventListener("DOMContentLoaded", function() {
  const todayElements = document.querySelectorAll('#js-todays');
  const today = new Date();
  const formattedDate = today.getFullYear() + '/' + 
                        String(today.getMonth() + 1).padStart(2, '0') + '/' + 
                        String(today.getDate()).padStart(2, '0');
  todayElements.forEach(function(element) {
    element.textContent = formattedDate;
  });
});