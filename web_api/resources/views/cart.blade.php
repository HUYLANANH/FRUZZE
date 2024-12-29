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
            <table>
        <thead>
            <tr>
                <th>Xóa</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody id="cartItemsBody">
            <tr>
                <td colspan="6" class="text-center">Đang tải giỏ hàng...</td>
            </tr>
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
    // Lấy dữ liệu giỏ hàng từ API
    function fetchCartData() {
        const token = localStorage.getItem('token');

        fetch('/api/cart', {
            headers: { Authorization: `Bearer ${token}` },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Không thể lấy dữ liệu giỏ hàng.');
                }
                return response.json();
            })
            .then((cart) => {
                updateCart(cart);
                updateCartTotal();
            })
            .catch((error) => {
                console.error('Lỗi khi tải giỏ hàng:', error);
                document.querySelector('#cartItemsBody').innerHTML =
                    '<tr><td colspan="6" class="text-center">Giỏ hàng trống hoặc không thể tải dữ liệu. Vui lòng thử lại sau!</td></tr>';
            });
    }

    // Cập nhật giao diện giỏ hàng
    function updateCart(cart) {
        const cartItemsBody = document.querySelector('#cartItemsBody');

        if (!cart || !Array.isArray(cart.items)) {
            cartItemsBody.innerHTML = '<tr><td colspan="6" class="text-center">Không có sản phẩm trong giỏ hàng</td></tr>';
            return;
        }

        const html = cart.items
            .map((item) => {
                const product = item.product || {};
                const price = parseFloat(item.price || 0); // Nhân giá trị với 1,000
                const formattedPrice = price.toLocaleString('vi-VN') + ' VNĐ'; // Định dạng giá
                const subtotal = item.quantity * price; // Tính thành tiền
                const formattedSubtotal = subtotal.toLocaleString('vi-VN') + ' VNĐ'; // Định dạng thành tiền

                return `
                    <tr data-product-id="${item.product_id}">
                        <td class="product_remove">
                            <a href="javascript:void(0)" onclick="removeFromCart(${item.product_id})">
                                <i class="pe-7s-close" title="Xóa"></i>
                            </a>
                        </td>
                        <td class="product-thumbnail">
                            <img src="${product.thumbnail || ''}" alt="Cart Thumbnail" style="width: 50px; height: 50px;" />
                        </td>
                        <td class="product-name">${product.name || 'Sản phẩm không xác định'}</td>
                        <td class="product-price item-price">
                            <span class="amount">${formattedPrice}</span>
                        </td>
                        <td class="product-quantity">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" data-product-id="${item.product_id}" value="${item.quantity}" type="number"
                                onchange="updateCartItem(${item.product_id}, this, ${price})" />
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="amount">${formattedSubtotal}</span>
                        </td>
                    </tr>`;
            })
            .join('');

        cartItemsBody.innerHTML = html;
    }

    // Cập nhật số lượng sản phẩm
    function updateCartItem(productId, quantityInput, price) {
        const token = localStorage.getItem('token');
        const quantity = parseInt(quantityInput.value) || 0;

        if (isNaN(quantity) || quantity <= 0) {
        alert("Số lượng phải là số hợp lệ lớn hơn 0!");
        quantityInput.value = 1; // Reset về giá trị mặc định
        return;
        }

        fetch('/api/cart', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({ product_id: productId, quantity }),
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Không thể cập nhật sản phẩm.');
                }
                return response.json();
            })
            .then(() => {
                const productRow = document.querySelector(`#cartItemsBody [data-product-id="${productId}"]`);
                if (productRow) {
                    const itemTotal = productRow.querySelector('.product-subtotal .amount');
                    const newTotal = price * quantity;
                    itemTotal.textContent = `${newTotal.toLocaleString()} VNĐ`;
                }
                updateCartTotal();
            })
            .catch((error) => {
                console.error('Lỗi cập nhật sản phẩm:', error);
                alert('Đã xảy ra lỗi khi cập nhật giỏ hàng.');
            });
    }

    // Tăng/giảm số lượng sản phẩm
    function updateQuantity(productId, change, price) {
        const quantityInput = document.querySelector(
            `#cartItemsBody [data-product-id="${productId}"] .cart-plus-minus-box`
        );

        if (!quantityInput) {
            console.error('Không tìm thấy input số lượng cho sản phẩm:', productId);
            return;
        }

        const currentQuantity = parseInt(quantityInput.value) || 0;
        const newQuantity = currentQuantity + change;

        if (newQuantity >= 1) {
            quantityInput.value = newQuantity;
            updateCartItem(productId, quantityInput, price);
        } else {
            alert('Số lượng phải lớn hơn 0!');
        }
    }

    // Xóa sản phẩm khỏi giỏ hàng
    function removeFromCart(productId) {
        const token = localStorage.getItem('token');

        fetch(`/api/cart/${productId}`, {
            method: 'DELETE',
            headers: { Authorization: `Bearer ${token}` },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Không thể xóa sản phẩm.');
                }
                return response.json();
            })
            .then(() => {
                const productRow = document.querySelector(`#cartItemsBody [data-product-id="${productId}"]`);
                if (productRow) productRow.remove();
                updateCartTotal();
            })
            .catch((error) => {
                console.error('Lỗi khi xóa sản phẩm:', error);
                alert('Đã xảy ra lỗi khi xóa sản phẩm.');
            });
    }

    // Tính tổng giá trị giỏ hàng
    function updateCartTotal() {
        let total = 0;
        document.querySelectorAll('#cartItemsBody tr').forEach((item) => {
            const price = parseFloat(
                item.querySelector('.product-price .amount').textContent.replace(/[^0-9]/g, '')
            );
            const quantity = parseInt(item.querySelector('.cart-plus-minus-box').value) || 0;

            total += price * quantity;
        });

        const formattedTotal = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
        document.querySelector('#cartTotal').textContent = formattedTotal;
        document.querySelector('#cartTotalFinal').textContent = `${formattedTotal}`;
    }

    // Khởi động lấy dữ liệu giỏ hàng
    fetchCartData();
</script>

@include('layouts.footer')
