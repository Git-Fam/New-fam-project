window.addEventListener("DOMContentLoaded", function () {
	const canvas = document.getElementById("confettiRain");
	const ctx = canvas.getContext("2d");
	canvas.width = window.innerWidth;
	canvas.height = window.innerHeight;
	window.addEventListener("resize", function () {
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
	});

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
	const particles = [];
	let pIndex = 0;

	function Dot(x, y, vx, vy, gradIdx) {
		this.x = x;
		this.y = y;
		this.vx = vx;
		this.vy = vy;
		this.gradIdx = gradIdx;
		this.life = 0;
		this.maxlife = 1000;
		this.degree = getRandom(0, 360);

		if (gradIdx === 0 || gradIdx === 1 || gradIdx === 2) {
			this.size = Math.floor(getRandom(23, 27));
		} else if (gradIdx === 3) {
			this.size = 15;
		} else {
			this.size = Math.floor(getRandom(15, 27));
		}

		this.gravity = getRandom(0.025, 0.045); // ゆっくり落ちる
		this.wind = getRandom(-0.08, 0.08);
		this.rotation = getRandom(0, Math.PI * 2);
		this.rotateSpeed = getRandom(-0.13, 0.13);

		particles[pIndex] = this;
		this.id = pIndex;
		pIndex++;
	}

	Dot.prototype.draw = function () {
		this.degree += 1;
		this.life++;

		this.rotation += this.rotateSpeed;
		this.vy += this.gravity;
		this.vx *= 0.99;
		this.vy *= 0.999;
		this.x += this.vx + Math.cos((this.degree * Math.PI) / 600) + this.wind;
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

		if (this.life >= this.maxlife || this.y > canvas.height + 50) {
			delete particles[this.id];
		}
	};

	function getRandom(min, max) {
		return Math.random() * (max - min) + min;
	}

	function loop() {
		// 紙吹雪を追加し続ける
		if (Math.random() < 0.035) {
			for (let i = 0; i < gradients.length; i++) {
				particles[pIndex] = new Dot(
					Math.random() * canvas.width,
					-20,
					getRandom(-1, 1),
					getRandom(0.02, 0.06), // ←めちゃゆっくり
					i
				);
			}
		}

		ctx.clearRect(0, 0, canvas.width, canvas.height);
		for (var i in particles) {
			if (particles[i]) particles[i].draw();
		}
		requestAnimationFrame(loop);
	}
	loop();
});
