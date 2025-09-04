document.querySelectorAll(".choice--item").forEach((item) => {
	item.addEventListener("click", function () {
		document.querySelectorAll(".choice--item").forEach((otherItem) => {
			if (otherItem === item) {
				otherItem.classList.add("active");
				otherItem.classList.remove("not-active");
			} else {
				otherItem.classList.add("not-active");
				otherItem.classList.remove("active");
			}
		});

		const messageElement = document.querySelector(".character--message");
		if (item.classList.contains("choice--item--engineer")) {
			messageElement.classList.add("choice-engineer");
			messageElement.classList.remove("choice-designer");
		} else if (item.classList.contains("choice--item--designer")) {
			messageElement.classList.add("choice-designer");
			messageElement.classList.remove("choice-engineer");
		}
	});
});
