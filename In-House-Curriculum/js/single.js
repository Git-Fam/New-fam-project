	window.addEventListener("DOMContentLoaded", function () {
		window.requestAnimationFrame =
			window.requestAnimationFrame ||
			window.mozRequestAnimationFrame ||
			window.webkitRequestAnimationFrame;
		var canvas = document.querySelector("canvas");
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
		var ctx = canvas.getContext("2d");
		ctx.globalCompositeOperation = "source-over";
		var particles = [];
		var pIndex = 0;

		// グラデーションパターン
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

		// 紙吹雪クラス
		function Dot(x, y, gradIdx) {
			this.x = x;
			this.y = y;
			this.gradIdx = gradIdx;

			// GIFのような初速（下から上、左右にバラける）
			const angle = getRandom(Math.PI * 1.15, Math.PI * 1.85); // 207〜333度くらい
			const speed = getRandom(7, 15); // 強め
			this.vx = Math.cos(angle) * speed;
			this.vy = Math.sin(angle) * speed;

			// 色ごとに大きさ
			if (gradIdx === 0 || gradIdx === 1 || gradIdx === 2) {
				this.size = Math.floor(getRandom(23, 27));
			} else if (gradIdx === 3) {
				this.size = 15;
			} else {
				this.size = Math.floor(getRandom(15, 27));
			}

			this.gravity = getRandom(0.18, 0.14); // 重力やや強め
			this.wind = getRandom(-0.06, 0.06); // 横風
			this.degree = getRandom(0, 360);
			this.rotation = getRandom(0, Math.PI * 2);
			this.rotateSpeed = getRandom(-0.13, 0.13);
			this.life = 0;
			this.maxlife = 840 + Math.random() * 1120; // 画面上に長く残る
			particles[pIndex] = this;
			this.id = pIndex;
			pIndex++;
		}

		Dot.prototype.draw = function () {
			this.degree += 1;
			this.life++;

			// 回転
			this.rotation += this.rotateSpeed;

			// ひらひら降下＆左右揺れ
			this.vy += this.gravity;
			this.vx *= 0.98; // 横速度は徐々に減衰
			this.x += this.vx + Math.sin(this.degree * 0.08) * 1.3 + this.wind;
			this.y += this.vy;

			this.width = this.size;
			this.height = Math.cos((this.degree * Math.PI) / 40) * this.size;

			// グラデーション/単色設定
			const gradData = gradients[this.gradIdx];
			if (gradData.type === "gradient") {
				const grad = ctx.createLinearGradient(
					this.x + this.x / 2,
					this.y + this.y / 2,
					this.x + this.x / 2,
					this.y + this.y / 2 + this.height
				);
				gradData.stops.forEach((stop) =>
					grad.addColorStop(stop.pos, stop.color)
				);
				ctx.fillStyle = grad;
			} else {
				ctx.fillStyle = gradData.color;
			}

			// 回転描画
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

			if (this.life >= this.maxlife || this.y > canvas.height + 50) {
				delete particles[this.id];
			}
		};

		window.addEventListener("resize", function () {
			canvas.width = window.innerWidth;
			canvas.height = window.innerHeight;
		});

		// 最初に一気にパーン！だけ生成
		let launched = false;
		function launchConfetti() {
			if (launched) return;
			launched = true;
			const NUM = 160; // 一気に発射する数
			for (let i = 0; i < NUM; i++) {
				const idx = i % gradients.length;
				particles[pIndex] = new Dot(
					canvas.width / 2 - 20 + getRandom(-30, 30), // 中央ちょいずらし
					canvas.height * 0.92 + getRandom(-10, 10), // 画面下部
					idx
				);
			}
		}
		launchConfetti(); // ページ読み込み時に一斉発射

		function loop() {
			ctx.clearRect(0, 0, canvas.width, canvas.height);
			for (var i in particles) {
				if (particles[i]) particles[i].draw();
			}
			frameId = requestAnimationFrame(loop);
		}
		loop();

		function getRandom(min, max) {
			return Math.random() * (max - min) + min;
		}
	});

	//モーダル



    $(function () {
        $(".close").on("click", function () {
            $(".confetti").removeClass("show");
        });
    });
    