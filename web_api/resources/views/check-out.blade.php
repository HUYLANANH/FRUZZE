@include('layouts.header')

<main class="main-content">
  <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-12">
          <div class="breadcrumb-item">
            <h2 class="breadcrumb-heading">THANH TOÁN</h2>
            <ul>
              <li><a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
              <li>Thanh Toán</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="checkout-area section-space-y-axis-100">
    <div class="container">
      <div class="row">
        <!-- Form điền thông tin giao hàng -->
        <div class="col-lg-6 col-12">
          <form id="checkout-form">
            <div class="checkbox-form">
              <h3>ĐIỀN THÔNG TIN GIAO HÀNG</h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>HỌ VÀ TÊN <span class="required">*</span></label>
                    <input id="name" placeholder="Nhập họ và tên của bạn" type="text" required />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>ĐỊA CHỈ<span class="required">*</span></label>
                    <input id="address_ship" placeholder="Nhập địa chỉ nhận hàng" type="text" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>EMAIL<span class="required">*</span></label>
                    <input id="email" placeholder="Nhập email" type="email" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>SỐ ĐIỆN THOẠI<span class="required">*</span></label>
                    <input id="phone" placeholder="Nhập số điện thoại liên lạc" type="text" required />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Hiển thị thông tin đơn hàng -->
        <div class="col-lg-6 col-12">
          <div class="your-order">
            <h3>ĐƠN HÀNG CỦA BẠN</h3>
            <div class="your-order-table table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Tổng cộng</th>
                  </tr>
                </thead>
                <tbody id="cart-items" style="text-align: center; vertical-align: middle;"></tbody>
                <tfoot>
                  <tr>
                    <th colspan="2">Tổng giá trị sản phẩm</th>
                    <td id="subtotal" style="text-align: center; vertical-align: middle;">0 VNĐ</td>
                  </tr>
                  <tr>
                    <th colspan="2">Số tiền phải thanh toán</th>
                    <td id="total" style="text-align: center; vertical-align: middle;">0 VNĐ</td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <!-- Phương thức thanh toán -->
            <h3>PHƯƠNG THỨC THANH TOÁN</h3>
            <div class="payment-method">
              <div>
                <label><input type="radio" name="payment-method" value="1" checked /> Thanh toán bằng tiền mặt</label>
              </div>
              <div>
                <label><input type="radio" name="payment-method" value="2" /> Chuyển khoản ngân hàng</label>
              </div>
            </div>
            <div class="group-btn_wrap" style="padding-top: 10px;">
              <a href="/cart" class="btn btn-secondary">Xem giỏ hàng</a>
              <button id="confirm-order" class="btn btn-primary">Đặt hàng</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const cartData = JSON.parse(localStorage.getItem("checkoutData"));
  if (!cartData || !cartData.items || cartData.items.length === 0) {
    alert("Giỏ hàng của bạn đang trống.");
    window.location.href = "/cart";
    return;
  }

  const subtotal = cartData.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
  const discountRate = 0.1; // Giảm giá 10%
  const total = subtotal - subtotal * discountRate;

  document.getElementById("cart-items").innerHTML = cartData.items.map(item => `
    <tr>
      <td>${item.name}</td>
      <td>${item.quantity}</td>
      <td>${(item.price * item.quantity).toFixed(0)} VNĐ</td>
    </tr>
  `).join("");
  document.getElementById("subtotal").textContent = `${subtotal.toFixed(0)} VNĐ`;
  document.getElementById("total").textContent = `${total.toFixed(0)} VNĐ`;

  document.getElementById("confirm-order").addEventListener("click", async () => {
    const customerInfo = {
      name: document.getElementById("name").value,
      address_ship: document.getElementById("address_ship").value,
      email: document.getElementById("email").value,
      phone: document.getElementById("phone").value,
      paymentMethod: document.querySelector('input[name="payment-method"]:checked').value,
    };

    if (!customerInfo.name || !customerInfo.address_ship || !customerInfo.email || !customerInfo.phone) {
      alert("Vui lòng điền đầy đủ thông tin!");
      return;
    }

    if (customerInfo.paymentMethod === "1") {
      const orderData = {
        payment_method: parseInt(customerInfo.paymentMethod),
        address_ship: customerInfo.address_ship,
        subtotal_price: subtotal,
        total_price: total,
        order_details: cartData.items,
      };

      try {
        const response = await fetch('/api/order', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
          },
          body: JSON.stringify(orderData),
        });

        if (!response.ok) throw new Error(await response.text());
        localStorage.removeItem("checkoutData");
        alert("Đặt hàng thành công!");
        window.location.href = "/thank-you";
      } catch (error) {
        alert(`Đặt hàng thất bại: ${error.message}`);
      }
    } const params = new URLSearchParams({
        address_ship: customerInfo.address_ship, // Địa chỉ giao hàng
        payment_method: customerInfo.paymentMethod, // Phương thức thanh toán
        total_price: cartData.totalAfterVoucher, // Tổng tiền cần thanh toán
    });

    // Thêm chi tiết đơn hàng vào query string
    cartData.items.forEach((item, index) => {
        params.append(`order_details[${index}][product_id]`, item.product_id);
        params.append(`order_details[${index}][quantity]`, item.quantity);
        params.append(`order_details[${index}][price]`, item.price);
    });

    try {
        // Gửi dữ liệu đến API với phương thức GET
        const response = await fetch(`/api/payment/vnpay?${params.toString()}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
            },
        });

        const responseData = await response.json();

        // Kiểm tra phản hồi từ API
        if (!response.ok || responseData.code !== "00") {
            alert(`Thanh toán VNPAY thất bại: ${responseData.message || "Lỗi không xác định"}`);
            return;
        }

        // Điều hướng đến liên kết thanh toán VNPAY
        window.location.href = responseData.data;
    } catch (error) {
        console.error("Lỗi khi gửi dữ liệu thanh toán:", error);
        alert("Đã xảy ra lỗi. Vui lòng thử lại.");
    }
  });
});
</script>

@include('layouts.footer')
