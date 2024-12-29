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
        <div class="col-lg-6 col-12">
          <form action="javascript:void(0)">
            <div class="checkbox-form">
              <h3>ĐIỀN THÔNG TIN GIAO HÀNG</h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>HỌ VÀ TÊN <span class="required">*</span></label>
                    <input placeholder="Nhập họ và tên của bạn" type="text" required/>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="checkout-form-list">
                    <label>ĐỊA CHỈ<span class="required">*</span></label>
                    <input placeholder="Nhập địa chỉ nhận hàng" type="text"  required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>EMAIL<span class="required">*</span></label>
                    <input placeholder="Nhập email" type="email"  required/>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkout-form-list">
                    <label>SỐ ĐIỆN THOẠI<span class="required">*</span></label>
                    <input placeholder="Nhập số điện thoại liên lạc" type="text"  required/>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
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
  <tbody>
    <tr class="cart_item">
      <td class="cart-product-name"></td>
      <td class="cart-product-quantity" style="text-align: center; vertical-align: middle;"></td>
      <td class="cart-product-total" style="text-align: center; vertical-align: middle;"><span class="amount"></span></td>
    </tr>
  </tbody>
  <tfoot>
    <tr class="cart-subtotal">
      <th>Tổng giá trị sản phẩm</th>
      <th></th>
      <td colspan="2" style="text-align: center; vertical-align: middle;"><span class="amount" ></span></td>
    </tr>
    <tr class="order-total">
      <th>Số tiền phải thanh toán</th>      
      <th></th>
      <td style="text-align: center; vertical-align: middle;"><strong><span class="amount"></span></strong></td>
    </tr>
  </tfoot>
</table>
            </div>

            <h3>PHƯƠNG THỨC THANH TOÁN</h3>

<div class="payment-method">
  <div class="payment-options">
    <div class="row">
      <!-- Cột 1: Thanh toán tiền mặt -->
      <div class="col-md-6">
        <label>
          <input type="checkbox" name="payment-method" value="cash" />
          Thanh toán bằng tiền mặt
        </label>
      </div>
      <!-- Cột 2: Chuyển khoản ngân hàng -->
      <div class="col-md-6">
        <label>
          <input type="checkbox" name="payment-method" value="bank-transfer" />
          Chuyển khoản ngân hàng
        </label>
      </div>
    </div>
  </div>
  <div class="order-button-payment">
    <input value="Xác nhận đơn hàng" type="submit" />
  </div>
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

@include('layouts.footer')