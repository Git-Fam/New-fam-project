

  // ホバーバブル
  document.addEventListener('DOMContentLoaded', function () {
    const atWater = document.querySelector('.C_AtWater');
    const hoverBubbles = atWater.querySelector('.hover-bubbles');
    let targetX = 0, targetY = 0;
    let currentX = 0, currentY = 0;

    atWater.addEventListener('mouseenter', () => {
      hoverBubbles.classList.add('active');
    });

    atWater.addEventListener('mouseleave', () => {
      hoverBubbles.classList.remove('active');
    });

    atWater.addEventListener('mousemove', (e) => {
      const rect = atWater.getBoundingClientRect();
      targetX = e.clientX - rect.left;
      targetY = e.clientY - rect.top;
    });

    function updatePosition() {
      currentX += (targetX - currentX) * 0.1;
      currentY += (targetY - currentY) * 0.1;

      hoverBubbles.style.transform = `translate(calc(${currentX}px - 50%), calc(${currentY}px - 50%))`;

      requestAnimationFrame(updatePosition);
    }

    updatePosition();
  });


