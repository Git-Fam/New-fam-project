window.addEventListener("DOMContentLoaded", function () {
	document.body.addEventListener("click", function (e) {
		// クリックされたのが .hdq_finsh_button だった場合
		if (e.target && e.target.classList.contains("hdq_finsh_button")) {
			e.preventDefault();

			const pass = document.querySelector(".hdq_result_pass");
			const coin = document.querySelector(".random-coin-get");

			if (
				pass &&
				getComputedStyle(pass).display !== "none" &&
				coin &&
				getComputedStyle(coin).display === "none"
			) {
				coin.style.setProperty("display", "block", "important");
			} 
		}
	});
});


