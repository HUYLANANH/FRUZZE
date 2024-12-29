@include('layouts.header')

<main class="main-content">
  <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-lg-12">
          <div class="breadcrumb-item">
            <h2 class="breadcrumb-heading">THANH TOÁN</h2>
            <ul>
              <li><a href="index.html">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
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
        <div class="col-12">
          <div class="coupon-accordion">
            <h3>
              Bạn có tài khoản chưa?
              <span id="showlogin">Nhấn vào đây để đăng nhập</span>
            </h3>
            <div id="checkout-login" class="coupon-content">
              <div class="coupon-info">
                <p class="coupon-text mb-1">Đăng nhập vào tài khoản của bạn</p>
                <form action="javascript:void(0)">
                  <p class="form-row-first">
                    <label class="mb-1">Tên đăng nhập hoặc Email <span class="required">*</span></label>
                    <input type="text" />
                  </p>
                  <p class="form-row-last">
                    <label>Mật khẩu <span class="required">*</span></label>
                    <input type="password" />
                  </p>
                  <p class="form-row">
                    <input type="checkbox" id="remember_me" />
                    <label for="remember_me">Nhớ đăng nhập</label>
                  </p>
                  <p class="lost-password">
                    <a href="javascript:void(0)">Quên mật khẩu?</a>
                  </p>
                </form>
              </div>
            </div>
            <h3>
              VOUCHER?
              <span id="showcoupon">Nhấn vào đây để lấy voucher</span>
            </h3>
            <div id="checkout_coupon" class="coupon-checkout-content">
              <div class="coupon-info">
                <form action="javascript:void(0)">
                  <p class="checkout-coupon">
                    <input placeholder="Mã Voucher" type="text" />
                    <input class="coupon-inner_btn" value="Lấy Voucher" type="submit" />
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-12">
          <form action="javascript:void(0)">
            <div class="checkbox-form">
              <h3>Chi tiết hóa đơn</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Họ <span class="required">*</span></label>
                    <input placeholder="" type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Tên <span class="required">*</span></label>
                    <input placeholder="" type="text" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Tên doanh nghiệp</label>
                    <input placeholder="" type="text" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>Địa chỉ <span class="required">*</span></label>
                    <input placeholder="Đường" type="text" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <input placeholder="Tòa/Nhà/..." type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Quận <span class="required">*</span></label>
                    <input placeholder="" type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Huyện/Thành phố <span class="required">*</span></label>
                    <input placeholder="" type="text" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Email <span class="required">*</span></label>
                    <input placeholder="" type="email" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>Số điện thoại <span class="required">*</span></label>
                    <input type="text" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="forgotton-password_info">
                    <a href="register.html">Tạo tài khoản?</a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-6 col-12">
          <div class="your-order">
            <h3>Đơn hàng của bạn</h3>
            <div class="your-order-table table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th class="cart-product-name">Sản phẩm</th>
                    <th class="cart-product-total">Tổng cộng</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="cart_item">
                    <td class="cart-product-name">Tên sản phẩm <strong class="product-quantity"> × 1</strong></td>
                    <td class="cart-product-total"><span class="amount">80.000 VNĐ</span></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr class="cart-subtotal">
                    <th>Tổng giá trị sản phẩm</th>
                    <td><span class="amount">80.000 VNĐ</span></td>
                  </tr>
                  <tr class="order-total">
                    <th>Số tiền phải thanh toán</th>
                    <td><strong><span class="amount">80.000 VNĐ</span></strong></td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="payment-method">
              <div class="payment-accordion">
                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="payment-1">
                      <h5 class="panel-title">
                        <a href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">Direct Bank Transfer</a>
                      </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                      <div class="card-body">
                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="payment-2">
                      <h5 class="panel-title">
                        <a href="javascript:void(0)" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">Cheque Payment</a>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                      <div class="card-body">
                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="payment-3">
                      <h5 class="panel-title">
                        <a href="javascript:void(0)" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">PayPal</a>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                      <div class="card-body">
                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="order-button-payment">
                  <input value="Place order" type="submit" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@include('layouts.footer')