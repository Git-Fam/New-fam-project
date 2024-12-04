$(function () {

  $(".btn-area .btn#next-item").on("click", function () {
    let $btn_area_parent = $(this).parent().parent();
    $btn_area_parent.removeClass("active");
    $btn_area_parent.next().addClass("active");
  });

  $(".btn-area .btn#prev-item").on("click", function () {
    let $btn_area_parent = $(this).parent().parent();
    $btn_area_parent.removeClass("active");
    $btn_area_parent.prev().addClass("active");
  });

});




function updateTotalScores() {
  const totals = {
    item1: 0,
    item2: 0,
    item3: 0,
    item4: 0,
    item5: 0
  };


  const radioGroups = document.querySelectorAll('.input-radio');


  radioGroups.forEach(radio => {
    radio.addEventListener('change', function () {

      const itemName = this.name.split('-')[1];

      totals[itemName] = Array.from(document.querySelectorAll(`input[name^="engineer-${itemName}"]:checked`))
        .reduce((sum, input) => sum + parseInt(input.value), 0);


      document.getElementById('selected-value1').textContent = totals.item1;
      document.getElementById('selected-value2').textContent = totals.item2;
      document.getElementById('selected-value3').textContent = totals.item3;
      document.getElementById('selected-value4').textContent = totals.item4;
      document.getElementById('selected-value5').textContent = totals.item5;
    });
  });
}
document.addEventListener('DOMContentLoaded', updateTotalScores);