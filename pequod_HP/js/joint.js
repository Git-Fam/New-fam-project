// C_TL
document.querySelectorAll(".C_TL").forEach((container) => {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          setTimeout(() => {
            const items = entry.target.querySelectorAll(".js-g01");
            items.forEach((item, i) => {
              gsap.fromTo(item, {
                opacity: 0,
                scale: 2,
                yPercent: -75
              }, {
                opacity: 1,
                scale: 1,
                yPercent: 0,
                ease: "power1",
                duration: 0.5,
                delay: i * 0.05
              });
            });
            observer.unobserve(entry.target); // アニメーション発火後に監視を解除
          }, 500); // 0.5秒後に発火
        }
      });
    }, { threshold: 0.1 });
  
    observer.observe(container); // 各C_TL要素を監視
  });
  