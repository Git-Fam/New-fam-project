window.addEventListener("DOMContentLoaded", () => {
  const topBtnBox = document.querySelector(".top-btn-box");
  const fadeSection = document.getElementById("topPage05");

  if (!topBtnBox || !fadeSection) return;

  // Intersection Observer API を使ってセクションの表示・非表示を監視
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {

        if (entry.isIntersecting) {
          // 画面内に入ったらボタンを非表示
          topBtnBox.style.opacity = "0";
          topBtnBox.style.pointerEvents = "none";
        } else {
          // 画面外に出たらボタンを再表示
          topBtnBox.style.opacity = "1";
          topBtnBox.style.pointerEvents = "auto";
        }
      });
    },
    {
      threshold: 0.1, 
    }
  );

  observer.observe(fadeSection);
});
