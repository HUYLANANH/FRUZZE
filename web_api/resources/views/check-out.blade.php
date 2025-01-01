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
                <a href="#" id="confirm-order" class="btn btn-secondary btn-primary-hover" style="padding-top: 10px; padding-bottom: 10px;">
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
        let total = 0;
        const discountRate = 0.1;

        // Tính toán giá trị giỏ hàng
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
        total = subtotal - subtotal * discountRate;

        // Hiển thị thông tin giỏ hàng trên giao diện
        document.getElementById("cart-items").innerHTML = cartItemsHtml;
        document.getElementById("subtotal").textContent = `${subtotal.toFixed(0)} VNĐ`;
        document.getElementById("total").textContent = `${total.toFixed(0)} VNĐ`;
    } catch (error) {
        console.error("Lỗi khi tải giỏ hàng:", error);
        alert("Đã xảy ra lỗi khi tải giỏ hàng. Vui lòng thử lại.");
    }
});

document.getElementById("confirm-order").addEventListener("click", async () => {
    try {
        const customerInfo = {
            name: document.getElementById("name").value,
            address_ship: document.getElementById("address_ship").value,
            email: document.getElementById("email").value,
            phone: document.getElementById("phone").value,
            paymentMethod: document.querySelector('input[name="payment-method"]:checked').value,
        };

        // Kiểm tra thông tin người dùng
        if (!customerInfo.name || !customerInfo.address_ship || !customerInfo.email || !customerInfo.phone) {
            alert("Vui lòng điền đầy đủ thông tin!");
            return;
        }

        const cartData = JSON.parse(localStorage.getItem("checkoutData"));
        if (!cartData || !cartData.items || cartData.items.length === 0) {
            alert("Giỏ hàng của bạn đang trống.");
            window.location.href = "/cart";
            return;
        }

        // Chuẩn bị dữ liệu đơn hàng
        const orderData = {
            address_ship: customerInfo.address_ship,
            total_price: cartData.totalAfterVoucher,
            order_details: cartData.items.map(item => ({
                product_id: item.product_id,
                quantity: item.quantity,
                price: item.price
            }))
        };

        // Gửi yêu cầu đặt hàng
        const response = await fetch('/api/order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
            body: JSON.stringify(orderData)
        });

        const responseText = await response.text(); // Lấy phản hồi dưới dạng văn bản
        console.log(responseText);

        if (!response.ok) {
            const errorData = JSON.parse(responseText);
            alert(`Đặt hàng thất bại: ${errorData.message}`);
            return;
        }

        
        // Xóa dữ liệu giỏ hàng sau khi đặt hàng thành công
        localStorage.removeItem("checkoutData");

   // Hiển thị hóa đơn cho khách hàng
   const invoiceHtml = `
              <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f9f9f9;
                }

                .invoice {
                    max-width: 800px;
                    margin: 50px auto;
                    padding: 20px;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                }

                h3 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 10px;
                }

                table th, table td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: center;
                }
            </style>
            <div class="invoice">
                <h3>Hóa Đơn</h3>
                <p><strong>Họ và tên:</strong> ${customerInfo.name}</p>
                <p><strong>Địa chỉ:</strong> ${customerInfo.address_ship}</p>
                <p><strong>Email:</strong> ${customerInfo.email}</p>
                <p><strong>Số điện thoại:</strong> ${customerInfo.phone}</p>
                <p><strong>Phương thức thanh toán:</strong> Thanh toán bằng tiền mặt</p>
                <table border="1" style="width: 100%; text-align: center;">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${cartData.items.map(item => `
                            <tr>
                                <td>${item.name}</td>
                                <td>${item.quantity}</td>
                                <td>${item.price.toFixed(0)} VNĐ</td>
                                <td>${(item.price * item.quantity).toFixed(0)} VNĐ</td>
                            </tr>
                        `).join('')}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Tổng cộng</td>
                            <td>${cartData.totalAfterVoucher.toFixed(0)} VNĐ</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        `;

        // Hiển thị hóa đơn lên giao diện
        document.body.innerHTML = invoiceHtml;

        // Chuyển hướng sang trang cảm ơn sau 5 giây
        setTimeout(() => {
            window.location.href = "/thank-you";
        }, 10000);

    } catch (error) {
        console.error("Lỗi khi đặt hàng:", error);
        alert("Đã xảy ra lỗi khi đặt hàng. Vui lòng thử lại.");
    }
});

</script>

@include('layouts.footer')
