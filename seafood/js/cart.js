let cart = JSON.parse(localStorage.getItem("cart")) || [];

const itemsEl = document.getElementById("cart-items");
const totalQtyEl = document.getElementById("total-qty");
const totalPriceEl = document.getElementById("total-price");

function renderCart() {
  itemsEl.innerHTML = "";

  let totalQty = 0;
  let totalPrice = 0;

  cart.forEach((item, index) => {
    totalQty += item.qty;
    totalPrice += item.price * item.qty;

    const div = document.createElement("div");
    div.className = "cart-item";
    div.innerHTML = `
      <img src="${item.img}" class="cart-img">

      <div class="cart-qty">
        <button class="qty-btn minus" data-index="${index}">−</button>
        <span class="qty-num">${item.qty}</span>
        <button class="qty-btn plus" data-index="${index}">＋</button>
      </div>
    `;

    itemsEl.appendChild(div);
  });

  totalQtyEl.textContent = totalQty;
  totalPriceEl.textContent = totalPrice.toLocaleString();

  localStorage.setItem("cart", JSON.stringify(cart));
}

// ＋ − ボタン操作
itemsEl.addEventListener("click", (e) => {
  const index = e.target.dataset.index;
  if (index === undefined) return;

  if (e.target.classList.contains("plus")) {
    cart[index].qty += 1;
  }
  if (e.target.classList.contains("minus")) {
    cart[index].qty -= 1;
  
    if (cart[index].qty <= 0) {
      cart.splice(index, 1);
    }
  }
  renderCart();
});

renderCart();
