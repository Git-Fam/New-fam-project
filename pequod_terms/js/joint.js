$(function () {
	//フォント
	(function (d) {
		var config = {
				kitId: "rhe0gfq",
				scriptTimeout: 3000,
				async: true,
			},
			h = d.documentElement,
			t = setTimeout(function () {
				h.className =
					h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
			}, config.scriptTimeout),
			tk = d.createElement("script"),
			f = false,
			s = d.getElementsByTagName("script")[0],
			a;
		h.className += " wf-loading";
		tk.src = "https://use.typekit.net/" + config.kitId + ".js";
		tk.async = true;
		tk.onload = tk.onreadystatechange = function () {
			a = this.readyState;
			if (f || (a && a != "complete" && a != "loaded")) return;
			f = true;
			clearTimeout(t);
			try {
				Typekit.load(config);
			} catch (e) {}
		};
		s.parentNode.insertBefore(tk, s);
	})(document);

    
	(function (d) {
		var config = {
				kitId: "qrh2ejs",
				scriptTimeout: 3000,
				async: true,
			},
			h = d.documentElement,
			t = setTimeout(function () {
				h.className =
					h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
			}, config.scriptTimeout),
			tk = d.createElement("script"),
			f = false,
			s = d.getElementsByTagName("script")[0],
			a;
		h.className += " wf-loading";
		tk.src = "https://use.typekit.net/" + config.kitId + ".js";
		tk.async = true;
		tk.onload = tk.onreadystatechange = function () {
			a = this.readyState;
			if (f || (a && a != "complete" && a != "loaded")) return;
			f = true;
			clearTimeout(t);
			try {
				Typekit.load(config);
			} catch (e) {}
		};
		s.parentNode.insertBefore(tk, s);
	})(document);

	$(".nav-item").hover(function () {
		$(this).toggleClass("show");
	});

	$(".nav-btn").click(function () {
		$(this).toggleClass("active");
		$(".nav").toggleClass("active");
		$("body").toggleClass("active");
		$(".background").toggleClass("active");
	});

	$(".background").click(function () {
		$(this).removeClass("active");
		$(".nav").removeClass("active");
		$("body").removeClass("active");
		$(".nav-btn").removeClass("active");
	});
});
