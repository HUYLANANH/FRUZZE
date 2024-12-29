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
          <form id="checkout-form" action="javascript:void(0)">
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
                    <input id="address" placeholder="Nhập địa chỉ nhận hàng" type="text" required />
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
                    <th class="cart-product-name">Sản phẩm</th>
                    <th class="cart-product-quantity">Số lượng</th>
                    <th class="cart-product-total">Tổng cộng</th>
                  </tr>
                </thead>
                <tbody id="cart-items" style="text-align: center; vertical-align: middle;">
                  <!-- Dữ liệu giỏ hàng sẽ được tải vào đây -->
                </tbody>
                <tfoot>
                  <tr class="cart-subtotal">
                    <th>Tổng giá trị sản phẩm</th>
                    <th></th>
                    <td colspan="2" style="text-align: center; vertical-align: middle;">
                      <span class="amount" id="subtotal">0 VNĐ</span>
                    </td>
                  </tr>
                  <tr class="order-total">
                    <th>Số tiền phải thanh toán</th>
                    <th></th>
                    <td style="text-align: center; vertical-align: middle;">
                      <strong><span class="amount" id="total">0 VNĐ</span></strong>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>

            <!-- Phương thức thanh toán -->
            <h3>PHƯƠNG THỨC THANH TOÁN</h3>
            <div class="payment-method">
              <div class="payment-options">
                <div class="row">
                  <div class="col-md-6">
                  <label>
                    <input type="radio" name="payment-method" value="cash" checked />
                    Thanh toán bằng tiền mặt
                  </label>
                  </div>
                  <div class="col-md-6">
                  <label>
                    <input type="radio" name="payment-method" value="bank-transfer" />
                    Chuyển khoản ngân hàng
                  </label>
                  </div>
                </div>
              </div>
              <div class="group-btn_wrap d-grid gap-2" style="padding-top: 10px; padding-bottom: 10px;">
                <a href="/cart" class="btn btn-secondary btn-primary-hover" style="padding-top: 10px; padding-bottom: 10px;">
                  Xem giỏ hàng
                </a>
                <a href="" id="confirm-order" type="button" class="btn btn-secondary btn-primary-hover" style="padding-top: 10px; padding-bottom: 10px;">
                  Đặt hàng
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@include('layouts.footer')

<script>
document.addEventListener("DOMContentLoaded", async () => {
    try {
        // Lấy dữ liệu giỏ hàng từ localStorage
        const cartData = JSON.parse(localStorage.getItem("checkoutData"));

        if (!cartData || !cartData.items || cartData.items.length === 0) {
            alert("Giỏ hàng của bạn đang trống.");
            window.location.href = "/cart"; // Quay về trang giỏ hàng nếu không có sản phẩm
            return;
        }

        let subtotal = 0;

        // Lấy dữ liệu giỏ hàng và tính toán giá trị
        const cartItemsHtml = cartData.items.map((item) => {
            const itemTotal = item.price * item.quantity; // Tổng tiền cho sản phẩm
            subtotal += itemTotal;

            return `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${itemTotal.toFixed(0)} VNĐ</td>
                </tr>
            `;
        }).join('');

        // Tính tổng tiền và giảm giá
        const discount = subtotal * 0.1; // Giảm giá 10%
        const totalAfterDiscount = subtotal - discount;

        // Hiển thị thông tin giỏ hàng và số tiền trên giao diện
        document.getElementById("cart-items").innerHTML = cartItemsHtml;
        document.getElementById("subtotal").textContent = `${subtotal.toFixed(0)} VNĐ`;
        document.getElementById("total").textContent = `${totalAfterDiscount.toFixed(0)} VNĐ`;
    } catch (error) {
        console.error("Lỗi khi tải giỏ hàng:", error);
        alert("Đã xảy ra lỗi khi tải giỏ hàng. Vui lòng thử lại.");
    }
});

document.getElementById("confirm-order").addEventListener("click", async () => {
    const name = document.getElementById("name").value;
    const address = document.getElementById("address").value;
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const paymentMethod = document.querySelector('input[name="payment-method"]:checked').value;

    if (!name || !address || !email || !phone) {
        alert("Vui lòng điền đầy đủ thông tin!");
        return;
    }

    try {
        // Lấy dữ liệu giỏ hàng từ localStorage
        const cartData = JSON.parse(localStorage.getItem("checkoutData"));
        if (!cartData || !cartData.items || cartData.items.length === 0) {
            alert("Giỏ hàng của bạn đang trống.");
            return;
        }

        // Chuẩn bị dữ liệu hóa đơn
        const invoiceData = {
            name,
            address,
            email,
            phone,
            paymentMethod: paymentMethod === "cash" ? "Tiền mặt" : "Chuyển khoản",
            items: cartData.items,
            subtotal: parseFloat(document.getElementById("subtotal").textContent.replace(" VNĐ", "").replace(/,/g, "")),
            total: parseFloat(document.getElementById("total").textContent.replace(" VNĐ", "").replace(/,/g, ""))
        };

        // Lưu dữ liệu hóa đơn vào localStorage
        localStorage.setItem("invoiceData", JSON.stringify(invoiceData));

        // Chuyển hướng tới trang hóa đơn
        window.location.href = "/invoice";
    } catch (error) {
        console.error("Lỗi xử lý đặt hàng:", error);
        alert("Đã xảy ra lỗi khi đặt hàng. Vui lòng thử lại.");
    }
});
</script>
