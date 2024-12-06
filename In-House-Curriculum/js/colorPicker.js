window.onload = function() {
  const colorDisplay = document.getElementById('color-display');
  const colorBar = document.getElementById('color-bar');
  const colorBarMarker = document.getElementById('color-bar-marker');
  const selectedColor = document.getElementById('selected-color');
  const ctxDisplay = colorDisplay.getContext('2d');
  const ctxBar = colorBar.getContext('2d');

  let selectedX = 0;
  let selectedY = 0;
  let selectedBarXPercent = 0;
  let selectedColorValue = '#f00'; // 初期色

  // グラデーションを作成
  function createGradient(ctx, width, height, colors, isVertical = false) {
      const gradient = isVertical ? ctx.createLinearGradient(0, 0, 0, height) : ctx.createLinearGradient(0, 0, width, 0);
      colors.forEach((color, index) => {
          gradient.addColorStop(index / (colors.length - 1), color);
      });
      return gradient;
  }

  // カラーディスプレイの描画
  function drawColorDisplay() {
    // 左から右のグラデーション
    const gradientHorizontal = ctxDisplay.createLinearGradient(0, 0, colorDisplay.width, 0);
    gradientHorizontal.addColorStop(0, '#fff'); // 白
    gradientHorizontal.addColorStop(0.9, selectedColorValue); // 選択された色
    ctxDisplay.fillStyle = gradientHorizontal;
    ctxDisplay.fillRect(0, 0, colorDisplay.width, colorDisplay.height);

    // 上から下のグラデーション
    const gradientVertical = ctxDisplay.createLinearGradient(0, 0, 0, colorDisplay.height);
    gradientVertical.addColorStop(0, 'rgba(0,0,0,0)'); // 透明
    gradientVertical.addColorStop(0.99, '#000'); // 黒
    ctxDisplay.fillStyle = gradientVertical;
    ctxDisplay.fillRect(0, 0, colorDisplay.width, colorDisplay.height);

    // 選択された色の位置にマークを描画
    if (selectedX !== 0 || selectedY !== 0) {
        ctxDisplay.strokeStyle = '#000';
        ctxDisplay.lineWidth = 2;
        ctxDisplay.beginPath();
        ctxDisplay.arc(selectedX, selectedY, 5, 0, 2 * Math.PI);
        ctxDisplay.stroke();
    }
}

  // カラーバーの描画
  function drawColorBar() {
      const gradient = createGradient(ctxBar, colorBar.width, 0, ['#f00', '#ff0', '#0f0', '#0ff', '#00f', '#f0f', '#f00']);
      ctxBar.fillStyle = gradient;
      ctxBar.fillRect(0, 0, colorBar.width, colorBar.height);
  }

  // カラーディスプレイのクリックイベント
  colorDisplay.addEventListener('click', function(event) {
      const rect = colorDisplay.getBoundingClientRect();
      const scaleX = colorDisplay.width / rect.width;
      const scaleY = colorDisplay.height / rect.height;
      selectedX = (event.clientX - rect.left) * scaleX;
      selectedY = (event.clientY - rect.top) * scaleY;
      const imageData = ctxDisplay.getImageData(selectedX, selectedY, 1, 1).data;
      const color = `rgb(${imageData[0]}, ${imageData[1]}, ${imageData[2]})`;
      selectedColor.style.backgroundColor = color;
      selectedColor.setAttribute('value', color); // value属性を更新
      drawColorDisplay(); // 再描画してマークを更新
  });

  // カラーバーのクリックイベント
  colorBar.addEventListener('click', function(event) {
      const rect = colorBar.getBoundingClientRect();
      const clickX = event.clientX - rect.left;
      selectedBarXPercent = (clickX / rect.width) * 100;
      const imageData = ctxBar.getImageData(clickX, 0, 1, 1).data;
      selectedColorValue = `rgb(${imageData[0]}, ${imageData[1]}, ${imageData[2]})`;
      drawColorDisplay(); // カラーディスプレイのグラデーションを更新

      // カラーバーのマーカー位置を更新
      colorBarMarker.style.left = `${selectedBarXPercent}%`;

      // カラーバーをクリックしたときは、選択位置をリセット
      selectedX = 0;
      selectedY = 0;
      drawColorBar(); // 再描画してマークを更新
  });

  drawColorDisplay();
  drawColorBar();
};