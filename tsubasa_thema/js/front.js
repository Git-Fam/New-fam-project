$(function () {


	// KVスクロールアニメーション（枝・芝を外側へ）
	if (window.gsap && window.ScrollTrigger) {
		gsap.registerPlugin(ScrollTrigger);

		const kvBranchTl = gsap.timeline({
			scrollTrigger: {
				trigger: ".front-kv",
				start: "50% top",
				end: "100% top", // front-kvは100vhなので約50vhスクロールで完了
				scrub: true,
			},
		});

		kvBranchTl
			.to(".front-kv-branch-l", { xPercent: -120, scale: 1.3, transformOrigin: "left top", ease: "power2.in" }, 0)
			.to(".front-kv-branch-r", { xPercent: 120, scale: 1.3, transformOrigin: "right top", ease: "power2.in" }, 0)
			.to(".front-kv-lawn-l", { xPercent: -120, scale: 1.3, transformOrigin: "left bottom", ease: "power2.in" }, 0)
			.to(".front-kv-lawn-r", { xPercent: 120, scale: 1.3, transformOrigin: "right bottom", ease: "power2.in" }, 0);


		const kvContentsTl = gsap.timeline({
			scrollTrigger: {
				trigger: ".front-kv",
				start: "60% top",
				end: "130% top", // front-kvは100vhなので約50vhスクロールで完了
				scrub: true,
			},
		});

		kvContentsTl
			.to(".front-kv-contents", { scale: 2, transformOrigin: "center top", opacity: 0, ease: "power2.in" }, 0)
			.to(".front-news-banner", { yPercent: 120, transformOrigin: "center bottom", opacity: 0, ease: "power2.in" }, 0);

		const kvBgTl = gsap.timeline({
			scrollTrigger: {
				trigger: ".front-kv",
				start: "60% top",
				end: "140% top", // front-kvは100vhなので約50vhスクロールで完了
				scrub: true,
			},
		});

		kvBgTl
			.to(".front-kv-bg", { scale: 2, transformOrigin: "center top", opacity: 0, ease: "power2.in" }, 0)

		kvContentsTl
			.to(".front-kv-contents", { scale: 2, transformOrigin: "center top", opacity: 0, ease: "power2.in" }, 0)

		const kvWhiteBgTl = gsap.timeline({
			scrollTrigger: {
				trigger: ".front-kv",
				start: "190% top",
				end: "200% top", // front-kvは100vhなので約50vhスクロールで完了
				scrub: true,
			},
		});
		kvWhiteBgTl
			.to(".front-kv-white-bg", { opacity: 0, ease: "sine.out" }, 0)
			.to(".front-kv", { pointerEvents: "none" }, 0)
	}

	// ヘッダーの表示制御（トップから210vhを境に切り替え）
	$(window).on("scroll", function () {
		if ($(this).scrollTop() > window.innerHeight * 2.1) {
			$(".front-hidden").removeClass("is-hidden");
		} else {
			$(".front-hidden").addClass("is-hidden");
		}
	});


});
