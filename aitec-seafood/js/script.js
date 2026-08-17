document.querySelectorAll(".add-cart").forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.preventDefault();

    const item = {
      id: btn.dataset.id,
      name: btn.dataset.name,
      price: Number(btn.dataset.price),
      img: btn.dataset.img,
      qty: 1,
    };

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const existing = cart.find((i) => i.id === item.id);

    if (existing) {
      existing.qty += 1;
    } else {
      cart.push(item);
    }

    localStorage.setItem("cart", JSON.stringify(cart));

    location.href = "cart.html";
  });
});
