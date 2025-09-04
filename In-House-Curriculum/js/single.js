window.addEventListener("DOMContentLoaded", function () {
	// rAF のフォールバック
	window.requestAnimationFrame =
		window.requestAnimationFrame ||
		window.mozRequestAnimationFrame ||
		window.webkitRequestAnimationFrame;

	// confetti のコンテナと canvas を取る（コンテナ内の canvas を優先）
	const confetti = document.querySelector(".confetti");
	const canvas =
		(confetti && confetti.querySelector("canvas")) ||
		document.querySelector("canvas");

	// --- canvas があるときだけ描画系を初期化 ---
	let ctx = null;
	const particles = [];
	let pIndex = 0;

	const gradients = [
		{
			type: "gradient",
			stops: [
				{ pos: 0, color: "#FAFA17" },
				{ pos: 1, color: "#CDBA0E" },
			],
		},
		{
			type: "gradient",
			stops: [
				{ pos: 0, color: "#17DCFA" },
				{ pos: 1, color: "#0EADCD" },
			],
		},
		{
			type: "gradient",
			stops: [
				{ pos: 0, color: "#66BF76" },
				{ pos: 1, color: "#83CA41" },
			],
		},
		{ type: "color", color: "#FFF" },
	];

	function getRandom(min, max) {
		return Math.random() * (max - min) + min;
	}

	function Dot(x, y, gradIdx) {
		this.x = x;
		this.y = y;
		this.gradIdx = gradIdx;
		const angle = getRandom(Math.PI * 1.15, Math.PI * 1.85);
		const speed = getRandom(7, 15);
		this.vx = Math.cos(angle) * speed;
		this.vy = Math.sin(angle) * speed;
		this.size = gradIdx === 3 ? 15 : Math.floor(getRandom(23, 27));
		this.gravity = getRandom(0.14, 0.18);
		this.wind = getRandom(-0.06, 0.06);
		this.degree = getRandom(0, 360);
		this.rotation = getRandom(0, Math.PI * 2);
		this.rotateSpeed = getRandom(-0.13, 0.13);
		this.life = 0;
		this.maxlife = 840 + Math.random() * 1120;
		particles[pIndex] = this;
		this.id = pIndex++;
	}

	Dot.prototype.draw = function () {
		this.degree += 1;
		this.life++;
		this.rotation += this.rotateSpeed;
		this.vy += this.gravity;
		this.vx *= 0.98;
		this.x += this.vx + Math.sin(this.degree * 0.08) * 1.3 + this.wind;
		this.y += this.vy;

		this.width = this.size;
		this.height = Math.cos((this.degree * Math.PI) / 40) * this.size;

		const gradData = gradients[this.gradIdx];
		if (gradData.type === "gradient") {
			const grad = ctx.createLinearGradient(
				this.x + this.x / 2,
				this.y + this.y / 2,
				this.x + this.x / 2,
				this.y + this.y / 2 + this.height
			);
			gradData.stops.forEach((stop) => grad.addColorStop(stop.pos, stop.color));
			ctx.fillStyle = grad;
		} else {
			ctx.fillStyle = gradData.color;
		}

		ctx.save();
		ctx.translate(this.x + this.width / 2, this.y + this.height / 2);
		ctx.rotate(this.rotation);
		ctx.beginPath();
		ctx.moveTo(-this.width / 2, -this.height / 2);
		ctx.lineTo(0, this.height / 2);
		ctx.lineTo(this.width / 2, this.height / 2);
		ctx.lineTo(this.width / 2, -this.height / 2);
		ctx.closePath();
		ctx.fill();
		ctx.restore();

		if (this.life >= this.maxlife || (canvas && this.y > canvas.height + 50)) {
			delete particles[this.id];
		}
	};

	function resizeCanvas() {
		if (!canvas) return;
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
	}

	function launchConfetti() {
		if (!canvas || !ctx) return;
		const NUM = 160;
		for (let i = 0; i < NUM; i++) {
			const idx = i % gradients.length;
			particles[pIndex] = new Dot(
				canvas.width / 2 - 20 + getRandom(-30, 30),
				canvas.height * 0.92 + getRandom(-10, 10),
				idx
			);
		}
	}

	function loop() {
		if (canvas && ctx) {
			ctx.clearRect(0, 0, canvas.width, canvas.height);
			for (let i in particles) {
				if (particles[i]) particles[i].draw();
			}
		}
		requestAnimationFrame(loop);
	}

	if (canvas) {
		// ここで初期化（無いページでは一切触らない）
		resizeCanvas();
		ctx = canvas.getContext("2d");
		if (ctx) {
			ctx.globalCompositeOperation = "source-over";
			window.addEventListener("resize", resizeCanvas);
			loop();
		}
	}

	// 閉じるボタン
	const closeBtn = document.querySelector(".close-area");
	if (closeBtn && confetti) {
		closeBtn.addEventListener("click", function () {
			confetti.classList.remove("show");
		});
	}

	// 進捗ボタンの表示監視
	const observer = new MutationObserver(() => {
		const pass = document.querySelector(".hdq_result_pass");
		const btnWrapper = document.querySelector(
			".progress-complete-button-wrapper"
		);
		const btn = btnWrapper
			? btnWrapper.querySelector("button:not(.is-complete)")
			: null;

		if (
			pass &&
			getComputedStyle(pass).display === "block" &&
			btn &&
			btn.style.display === "none"
		) {
			btn.style.display = "block";
		}
	});

	observer.observe(document.body, {
		attributes: true,
		childList: true,
		subtree: true,
	});

	// 完了ボタン処理
	const btnWrapper = document.querySelector(
		".progress-complete-button-wrapper"
	);
	const btn = btnWrapper
		? btnWrapper.querySelector("button:not(.is-complete)")
		: null;

	if (btn) {
		btn.addEventListener("click", function () {
			const tagSlug = btnWrapper.dataset.tag;

			fetch(ajax_data.ajax_url, {
				method: "POST",
				headers: { "Content-Type": "application/x-www-form-urlencoded" },
				body: new URLSearchParams({
					action: "set_progress_100",
					tag_slug: tagSlug,
				}),
			})
				.then((res) => res.json())
				.then((data) => {
					if (data.success) {
						// 紙吹雪演出
						if (confetti) {
							confetti.classList.add("show");
							if (canvas && ctx) launchConfetti();
							setTimeout(() => {
								confetti.classList.remove("show");
							}, 5000);
						}

						// ボタン切り替え
						btn.disabled = true;
						btn.textContent = "完了済み";
						btn.classList.add("is-complete");

						// 次の記事リンクを表示
						const nextUrl = btnWrapper.dataset.nextUrl;
						if (nextUrl) {
							document.querySelectorAll(".next-post-link").forEach((link) => {
								link.style.display = "block";
							});
						}
					} else {
						alert("エラー: " + data.data);
					}
				})
				.catch((err) => {
					console.error("通信エラー:", err);
					alert("進捗更新に失敗しました");
				});
		});
	}
});
