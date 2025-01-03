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
                    <th>Tình trạng</th>
                  </tr>
                </thead>
                <tbody id="cartItemsBody">
                  <tr>
                    <td colspan="7" class="text-center">Đang tải giỏ hàng...</td>
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
                      disabled
                    />
                    <input
                      class="button mt-xxs-30"
                      name="apply_coupon"
                      value="Tự động thêm Voucher"
                      type="button"
                      onclick="applyVoucher()"
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
                  <a href="javascript:void(0)" class="checkout-btn" id="checkoutButton" onclick="proceedToCheckout()">Tiến hành thanh toán</a>
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
                checkStockAvailability(cart);
            })
            .catch((error) => {
                console.error('Lỗi khi tải giỏ hàng:', error);
                document.querySelector('#cartItemsBody').innerHTML =
                    '<tr><td colspan="7" class="text-center">Giỏ hàng trống hoặc không thể tải dữ liệu. Vui lòng thử lại sau!</td></tr>';
            });
    }

    // Cập nhật giao diện giỏ hàng
    function updateCart(cart) {
        const cartItemsBody = document.querySelector('#cartItemsBody');

        if (!cart || !Array.isArray(cart.items)) {
            cartItemsBody.innerHTML = '<tr><td colspan="7" class="text-center">Không có sản phẩm trong giỏ hàng</td></tr>';
            return;
        }

        const html = cart.items
            .map((item) => {
                const product = item.product || {};
                const price = parseFloat(item.price || 0);
                const formattedPrice = price.toLocaleString('vi-VN') + ' VNĐ';
                const subtotal = item.quantity * price;
                const formattedSubtotal = subtotal.toLocaleString('vi-VN') + ' VNĐ';

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
                        <td class="product-name">
                            <a href="/detail-shop/${product.id}">${product.name || 'Sản phẩm không xác định'}</a>
                        </td>
                        <td class="product-price item-price">
                            <span class="amount">${formattedPrice}</span>
                        </td>
                        <td class="product-quantity">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" data-product-id="${item.product_id}" value="${item.quantity}" type="number" onchange="updateCartItem(${item.product_id}, this, ${price})" />
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="amount">${formattedSubtotal}</span>
                        </td>
                        <td class="product-stock" id="stock-${item.product_id}">Đang kiểm tra...</td>
                    </tr>`;
            })
            .join('');

        cartItemsBody.innerHTML = html;
    }

// Kiểm tra tình trạng tồn kho và cập nhật nút thanh toán
function checkStockAvailability(cart) {
    const token = localStorage.getItem('token');
    let allInStock = true; // Biến theo dõi tất cả sản phẩm còn hàng

    fetch('/api/warehouse', {
        headers: { Authorization: `Bearer ${token}` },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Không thể lấy dữ liệu kho hàng.');
            }
            return response.json();
        })
        .then((warehouseData) => {
            cart.items.forEach((item) => {
                const stockElement = document.querySelector(`#stock-${item.product_id}`);
                const warehouseItem = warehouseData.data.find((w) => w.product_id === item.product_id);

                if (warehouseItem) {
                    if (warehouseItem.quantity >= item.quantity) {
                        stockElement.textContent = 'Còn hàng';
                        stockElement.style.color = 'green';
                    } else if (warehouseItem.quantity > 0) {
                        stockElement.textContent = `Chỉ còn ${warehouseItem.quantity} sản phẩm`;
                        stockElement.style.color = 'red';
                        allInStock = false; // Một sản phẩm không đủ số lượng
                    } else {
                        stockElement.textContent = 'Hết hàng';
                        stockElement.style.color = 'red';
                        allInStock = false; // Một sản phẩm đã hết hàng
                    }
                } else {
                    stockElement.textContent = 'Hết hàng';
                    stockElement.style.color = 'red';
                    allInStock = false; // Không tìm thấy sản phẩm trong kho
                }
            });

            // Cập nhật trạng thái nút thanh toán
            toggleCheckoutButton(allInStock);
        })
        .catch((error) => {
            console.error('Lỗi kiểm tra tồn kho:', error);
            cart.items.forEach((item) => {
                const stockElement = document.querySelector(`#stock-${item.product_id}`);
                stockElement.textContent = 'Lỗi kiểm tra';
                stockElement.style.color = 'orange';
            });
            toggleCheckoutButton(false); // Nếu lỗi xảy ra, nút bị vô hiệu hóa
        });
}

// Bật hoặc tắt nút "Tiến hành thanh toán"
function toggleCheckoutButton(enable) {
    const checkoutButton = document.getElementById('checkoutButton');
    if (enable) {
        checkoutButton.disabled = false;
        checkoutButton.style.backgroundColor = ''; // Trả lại màu mặc định
        checkoutButton.style.cursor = 'pointer';
    } else {
        checkoutButton.disabled = true;
        checkoutButton.style.backgroundColor = 'gray';
        checkoutButton.style.cursor = 'not-allowed';
    }
}

    // Cập nhật số lượng sản phẩm
    function updateCartItem(productId, quantityInput, price) {
    const token = localStorage.getItem('token');
    const quantity = parseInt(quantityInput.value) || 0;

    if (isNaN(quantity) || quantity <= 0) {
        alert("Số lượng phải là số hợp lệ lớn hơn 0!");
        quantityInput.value = 1;
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

            // Gọi lại kiểm tra tình trạng tồn kho
            fetchCartDataAndCheckStock();
        })
        .catch((error) => {
            console.error('Lỗi cập nhật sản phẩm:', error);
            alert('Đã xảy ra lỗi khi cập nhật giỏ hàng.');
        });
}

// Hàm gọi lại dữ liệu giỏ hàng và kiểm tra tồn kho
function fetchCartDataAndCheckStock() {
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
            checkStockAvailability(cart); // Kiểm tra tồn kho cho các sản phẩm trong giỏ
        })
        .catch((error) => {
            console.error('Lỗi khi tải giỏ hàng:', error);
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

    function proceedToCheckout() {
    const checkoutButton = document.getElementById('checkoutButton');
    
    // Kiểm tra nếu nút bị vô hiệu hóa
    if (!checkoutButton || checkoutButton.disabled) {
        alert('Không thể tiến hành thanh toán. Vui lòng kiểm tra lại tình trạng sản phẩm.');
        return;
    }
    
    // Lấy danh sách các sản phẩm trong giỏ hàng
    const cartItems = Array.from(document.querySelectorAll('#cartItemsBody tr')).map((row) => {
        const productId = row.getAttribute('data-product-id');
        const productName = row.querySelector('.product-name a').textContent.trim();
        const quantity = parseInt(row.querySelector('.cart-plus-minus-box').value) || 0;
        const price = parseFloat(row.querySelector('.product-price .amount').textContent.replace(/[^0-9]/g, '')) || 0;
        const subtotal = price * quantity;
        return {
            product_id: productId,
            name: productName,
            quantity: quantity,
            price: price,
            subtotal: subtotal,
        };
    });
    const totalBeforeVoucher = parseFloat(document.getElementById('cartTotal').textContent.replace(/[^0-9]/g, '')) || 0;
    const totalAfterVoucher = parseFloat(document.getElementById('cartTotalFinal').textContent.replace(/[^0-9]/g, '')) || totalBeforeVoucher;
    const checkoutData = {
        items: cartItems,
        totalBeforeVoucher: totalBeforeVoucher,
        totalAfterVoucher: totalAfterVoucher,
    };
    // Lưu dữ liệu vào localStorage để sử dụng trên trang checkout
    localStorage.setItem('checkoutData', JSON.stringify(checkoutData));
    // Chuyển hướng đến trang checkout
    window.location.href = '/check-out';
}


    // Hàm xử lý khi nhấn nút "Cập nhật Voucher"
    function applyVoucher() {
    const couponCode = document.getElementById('coupon_code');
    const cartTotal = parseFloat(document.getElementById('cartTotal').textContent.replace(/[^0-9]/g, ''));

    const discountPercentage = 10; // Giảm 10%
    const discount = cartTotal * (discountPercentage / 100);

    // Lưu giá trị giảm vào localStorage
    localStorage.setItem('discount', discount);

    const newTotal = cartTotal - discount;

    // Hiển thị voucher và tổng tiền sau khi giảm
    couponCode.value = `${discountPercentage}%OFF`;
    document.getElementById('cartTotalFinal').textContent = newTotal.toLocaleString('vi-VN') + ' VNĐ';

    alert('Áp dụng voucher thành công! Giảm ' + discountPercentage + '% cho tổng tiền.');
}

    // Hàm xóa sản phẩm khỏi giỏ hàng
function removeFromCart(productId) {
    const token = localStorage.getItem('token');

    // Gửi yêu cầu DELETE tới API
    fetch(`/api/cart/${productId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Không thể xóa sản phẩm.');
            }
            return response.json();
        })
        .then(() => {
            // Xóa dòng sản phẩm khỏi bảng
            const productRow = document.querySelector(`#cartItemsBody [data-product-id="${productId}"]`);
            if (productRow) {
                productRow.remove();
            }

            // Cập nhật lại tổng tiền
            updateCartTotal();
            alert('Xóa sản phẩm thành công!');
        })
        .catch((error) => {
            console.error('Lỗi khi xóa sản phẩm:', error);
            alert('Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.');
        });
}

</script>

@include('layouts.footer')
