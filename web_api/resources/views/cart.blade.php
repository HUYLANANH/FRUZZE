@include('layouts.header')

      <!-- Begin Main Content Area -->
      <main class="main-content">
        <div
          class="breadcrumb-area breadcrumb-height"
          data-bg-image="assets/images/breadcrumb/bg/bg.png"
        >
          <div class="container h-100">
            <div class="row h-100">
              <div class="col-lg-12">
                <div class="breadcrumb-item">
                  <h2 class="breadcrumb-heading">GIỎ HÀNG</h2>
                  <ul>
                    <li>
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
                    </li>
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
                      <tbody>
                        <tr>
                        <td class="product_remove">
                                            <a href="javascript:void(0)" class="remove-btn">
                                                <i class="pe-7s-close" title="Remove"></i>
                                            </a>
                                        </td>
                          <td class="product-thumbnail">
                            <a href="javascript:void(0)">
                              <img
                                src="assets/images/product/small-size/1-1-112x124.jpg"
                                alt="Cart Thumbnail"
                              />
                            </a>
                          </td>
                          <td class="product-name">
                            <a href="javascript:void(0)">Sầu riêng sấy lạnh thăng hoa</a>
                          </td>
                          <td class="product-price">
                            <span class="amount">80.000 VNĐ</span>
                          </td>
                          <td class="quantity">
                            <div class="cart-plus-minus">
                              <input
                                class="cart-plus-minus-box"
                                value="1"
                                type="text"
                              />
                            </div>
                          </td>
                          <td class="product-subtotal">
                            <span class="amount"></span>
                          </td>
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
                        <div class="coupon2">
                          <input
                            class="button"
                            name="update_cart"
                            value="Cập nhật giỏ hàng"
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
                          <li>Tạm tính <span>$118.60</span></li>
                          <li>Tổng cộng <span>$118.60</span></li>
                        </ul>
                        <a href="/checkout">Tiến hành thanh toán</a>
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

      <script src="{{ asset('assets/js/button-remove.js') }}"></script>

@include('layouts.footer')