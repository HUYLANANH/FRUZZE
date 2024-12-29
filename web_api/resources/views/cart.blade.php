@include('layouts.header')

<!-- Begin Main Content Area -->
<main class="main-content">
  <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-12">
          <div class="breadcrumb-item">
            <h2 class="breadcrumb-heading">GIỎ HÀNG</h2>
            <ul>
              <li><a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
              <li>Giỏ Hàng</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="cart-area section-space-y-axis-100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form action="javascript:void(0)">
            <div class="table-content table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th class="product_remove">Xóa</th>
                    <th class="product-thumbnail">Sản phẩm</th>
                    <th class="cart-product-name">Tên sản phẩm</th>
                    <th class="product-price">Giá</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="product-subtotal">Tổng cộng</th>
                  </tr>
                </thead>
                <tbody id="cartItemsBody">
                  <!-- Sản phẩm trong giỏ hàng -->
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="coupon-all">
                  <div class="coupon">
                    <input
                      id="coupon_code"
                      class="input-text"
                      name="coupon_code"
                      value=""
                      placeholder="Mã Voucher"
                      type="text"
                    />
                    <input
                      class="button mt-xxs-30"
                      name="apply_coupon"
                      value="Tự động thêm Voucher"
                      type="submit"
                    />
                  </div>
                  <!-- Thêm sự kiện cho nút cập nhật giỏ hàng -->
                  <div class="coupon2">
                    <input
                      class="button"
                      name="update_cart"
                      value="Cập nhật giỏ hàng"
                      type="submit"
                      onclick="updateCartData()" 
                    />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 ml-auto">
                <div class="cart-page-total">
                  <h2>Tổng cộng</h2>
                  <ul>
                    <li>Tạm tính <span id="cartTotal">0 VNĐ</span></li>
                    <li>Tổng cộng <span id="cartTotalFinal">0 VNĐ</span></li>
                  </ul>
                  <a href="/checkout" class="checkout-btn">Tiến hành thanh toán</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- Main Content Area End Here -->

<script>
// Lấy danh sách sản phẩm trong giỏ hàng
function fetchCartData() {
    const token = localStorage.getItem('token');

    fetch('/api/cart', {
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Không thể lấy dữ liệu giỏ hàng.');
        return response.json();
    })
    .then(cart => updateCart(cart))
    .catch(error => console.error('Lỗi:', error));
}

function updateCart(cart) {
    const cartItemsBody = document.querySelector('#cartItemsBody');
    const cartTotal = document.querySelector('#cartTotal');
    const cartTotalFinal = document.querySelector('#cartTotalFinal');

    // Kiểm tra dữ liệu giỏ hàng
    if (!cart || !cart.items || !Array.isArray(cart.items)) {
        console.error('Dữ liệu giỏ hàng không hợp lệ:', cart);
        cartItemsBody.innerHTML = '<tr><td colspan="6">Không có sản phẩm trong giỏ hàng</td></tr>';
        return;
    }

    let html = '';
    let total = 0;

    cart.items.forEach(item => {
        const product = item.product;
        const price = parseFloat(item.price); // Chuyển giá sản phẩm thành số thực
        const subtotal = item.quantity * price; // Tính tổng cho từng sản phẩm
        total += subtotal; // Cộng tổng vào tổng giỏ hàng

        html += `
            <tr data-product-id="${item.product_id}">
                <td class="product_remove">
                    <a href="javascript:void(0)" onclick="removeFromCart(${item.product_id})">
                        <i class="pe-7s-close" title="Xóa"></i>
                    </a>
                </td>
                <td class="product-thumbnail">
                    <a href="javascript:void(0)">
                        <img src="${product.thumbnail}" alt="Cart Thumbnail" />
                    </a>
                </td>
                <td class="product-name">
                    <a href="javascript:void(0)">${product.name}</a>
                </td>
                <td class="product-price">
                    <span class="amount">${price.toLocaleString()} VNĐ</span>
                </td>
                <td class="product-quantity">
                    <div class="cart-plus-minus">
                        <button class="qty-minus" onclick="updateQuantity(${item.product_id}, -1)">-</button>
                        <input class="cart-plus-minus-box" value="${item.quantity}" type="number" min="1" onchange="updateCartItem(${item.product_id}, this)" />
                        <button class="qty-plus" onclick="updateQuantity(${item.product_id}, 1)">+</button>
                    </div>
                </td>
                <td class="product-subtotal">
                    <span class="amount">${subtotal.toLocaleString()} VNĐ</span>
                </td>
            </tr>
        `;
    });

    // Cập nhật tổng giỏ hàng
    cartItemsBody.innerHTML = html;
    cartTotal.textContent = `${total.toLocaleString()} VNĐ`;
    cartTotalFinal.textContent = `${total.toLocaleString()} VNĐ`;
}

// Cập nhật số lượng trong giỏ hàng và tính lại tổng tiền
function updateCartItem(productId, quantityInput) {
    const token = localStorage.getItem('token');
    const quantity = parseInt(quantityInput.value);

    if (quantity <= 0) {
        alert("Số lượng phải lớn hơn 0!");
        quantityInput.value = 1;
        return;
    }

    // Cập nhật số lượng sản phẩm qua API
    fetch('/api/cart', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Không thể cập nhật sản phẩm.');
        return response.json();
    })
    .then(cart => {
        updateCart(cart); // Cập nhật lại giỏ hàng sau khi thay đổi số lượng
    })
    .catch(error => console.error('Lỗi:', error));
}

// Hàm để thay đổi số lượng khi nhấn nút + hoặc -
function updateQuantity(productId, change) {
    const quantityInput = document.querySelector(`#cartItemsBody [data-product-id="${productId}"] .cart-plus-minus-box`);
    const currentQuantity = parseInt(quantityInput.value);
    const newQuantity = currentQuantity + change;

    // Kiểm tra xem số lượng có hợp lệ không
    if (newQuantity >= 1) {
        quantityInput.value = newQuantity;
        updateCartItem(productId, quantityInput);  // Cập nhật giỏ hàng với số lượng mới
    }
}

// Cập nhật giỏ hàng khi nhấn "Cập nhật giỏ hàng"
function updateCartData() {
    const cartItems = document.querySelectorAll('#cartItemsBody tr');
    const cartUpdates = [];

    // Duyệt qua các sản phẩm trong giỏ hàng và lấy dữ liệu cập nhật
    cartItems.forEach(item => {
        const productId = item.getAttribute('data-product-id');
        const quantityInput = item.querySelector('.cart-plus-minus-box');
        const quantity = parseInt(quantityInput.value);

        if (quantity > 0) {
            cartUpdates.push({
                product_id: productId,
                quantity: quantity
            });
        }
    });

    // Cập nhật giỏ hàng qua API
    const token = localStorage.getItem('token');
    fetch('/api/cart/update', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(cartUpdates)
    })
    .then(response => {
        if (!response.ok) throw new Error('Không thể cập nhật giỏ hàng.');
        return response.json();
    })
    .then(cart => {
        updateCart(cart);  // Cập nhật lại giỏ hàng sau khi thay đổi
    })
    .catch(error => console.error('Lỗi:', error));
}

// Xóa sản phẩm trong giỏ hàng
function removeFromCart(productId) {
    const token = localStorage.getItem('token');

    fetch(`/api/cart/${productId}`, {
        method: 'DELETE',
        headers: {
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Không thể xóa sản phẩm.');
        return response.json();
    })
    .then(cart => {
        updateCart(cart); // Cập nhật lại giỏ hàng sau khi xóa sản phẩm
    })
    .catch(error => console.error('Lỗi:', error));
}

// Tải dữ liệu ban đầu khi trang được tải
window.onload = fetchCartData;

// Thêm mã voucher
function applyCoupon() {
    alert('Chức năng này đang được phát triển.');
}

</script>

@include('layouts.footer')
