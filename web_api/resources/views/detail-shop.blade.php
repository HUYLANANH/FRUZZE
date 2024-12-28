@include('layouts.header')

      <!-- Begin Main Content Area  -->
      <main class="main-content">
        <div
          class="breadcrumb-area breadcrumb-height"
          data-bg-image="assets/images/breadcrumb/bg/bg.png"
        >
          <div class="container h-100">
            <div class="row h-100">
              <div class="col-lg-12">
                <div class="breadcrumb-item">
                  <h2 class="breadcrumb-heading">CHI TIẾT SẢN PHẨM</h2>
                  <ul>
                    <li>
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
                    </li>
                    <li>Chi Tiết Sản Phẩm</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="single-product-area section-space-top-100">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="single-product-img h-100">
                  <div class="swiper-container single-product-slider">
                    <div class="swiper-wrapper">
                      <div class="swiper-slide">
                        <a
                          href="assets/images/product/large-size/2-1-555x645.jpg"
                          class="single-img gallery-popup"
                        >
                          <img
                            class="img-full"
                            src="assets/images/product/large-size/2-1-555x645.jpg"
                            alt="Product Image"
                          />
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a
                          href="assets/images/product/large-size/2-2-555x645.jpg"
                          class="single-img gallery-popup"
                        >
                          <img
                            class="img-full"
                            src="assets/images/product/large-size/2-2-555x645.jpg"
                            alt="Product Image"
                          />
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a
                          href="assets/images/product/large-size/2-3-555x645.jpg"
                          class="single-img gallery-popup"
                        >
                          <img
                            class="img-full"
                            src="assets/images/product/large-size/2-3-555x645.jpg"
                            alt="Product Image"
                          />
                        </a>
                      </div>
                      <div class="swiper-slide">
                        <a
                          href="assets/images/product/large-size/2-4-555x645.jpg"
                          class="single-img gallery-popup"
                        >
                          <img
                            class="img-full"
                            src="assets/images/product/large-size/2-4-555x645.jpg"
                            alt="Product Image"
                          />
                        </a>
                      </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="product-thumb-with-content row">
                  <div class="col-12 order-lg-1 order-2 pt-10 pt-lg-0">
                    <div class="single-product-content">
                      <h2 class="title">Tên sản phẩm</h2>
                      <div class="price-box pb-1">
                        <span class="new-price text-danger">giá đã giảm</span>
                        <span class="old-price text-primary">giá chưa giảm</span>
                      </div>
                      <p class="short-desc mb-6">
                        Mô tả description
                      </p>
                      <ul class="quantity-with-btn pb-7">
                        <li class="quantity">
                          <div class="cart-plus-minus">
                            <input
                              class="cart-plus-minus-box"
                              value="1"
                              type="text"
                            />
                          </div>
                        </li>
                        <li class="add-to-cart">
                          <a
                            class="btn btn-custom-size lg-size btn-primary btn-secondary-hover rounded-0"
                            href="cart.html"
                            >Thêm vào giỏ hàng</a
                          >
                        </li>
                        <li class="wishlist-btn-wrap">
                          <a class="btn rounded-0" href="wishlist.html">
                            <i class="pe-7s-like"></i>
                          </a>
                        </li>
                      </ul>
                      <div class="social-link align-items-center pb-lg-8">
                        <span class="title pe-3">Chia sẻ:</span>
                        <ul>
                          <li>
                            <a href="https://www.facebook.com/profile.php?id=61554393290754">
                              <i class="fab fa-facebook"></i>
                            </a>
                          </li>
                          <li>
                            <a href="https://www.instagram.com/ours.fruzze">
                              <i class="fab fa-instagram"></i>
                            </a>
                          </li>
                          <li>
                            <a href="https://www.tiktok.com/@ours.fruzze">
                              <i class="fab fa-tiktok"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 order-lg-2 order-1 pt-10 pt-lg-0">
                    <div class="swiper-container single-product-thumbs">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="product-tab-area section-space-top-100">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <ul
                  class="nav product-tab-nav product-tab-style-2"
                  role="tablist"
                >
                  <li class="nav-item" role="presentation">
                    <a
                      class="active btn btn-custom-size"
                      id="description-tab"
                      data-bs-toggle="tab"
                      href="#description"
                      role="tab"
                      aria-controls="description"
                      aria-selected="true"
                    >
                      Mô Tả
                    </a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a
                      class="btn btn-custom-size"
                      id="reviews-tab"
                      data-bs-toggle="tab"
                      href="#reviews"
                      role="tab"
                      aria-controls="reviews"
                      aria-selected="false"
                    >
                      Đánh Giá
                    </a>
                  </li>
                </ul>
                <div class="tab-content product-tab-content">
                  <div
                    class="tab-pane fade show active"
                    id="description"
                    role="tabpanel"
                    aria-labelledby="description-tab"
                  >
                    <div class="product-description-body">
                      <p class="short-desc mb-0">
                      <div class="product-info-box" style="border: 1px solid #ddd; border-radius: 10px; padding: 20px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <h4 style="color: #bac34e;">Công dụng:</h4>
    <ul style="line-height: 1.8; padding-left: 20px;">
                <li><strong>Giữ nguyên dưỡng chất:</strong> Trái cây sấy được chế biến để bảo toàn phần lớn các vitamin và khoáng chất tự nhiên.</li>
                <li><strong>Tiện lợi:</strong> Là món ăn nhẹ gọn nhẹ, dễ bảo quản, phù hợp cho các chuyến đi xa hoặc khi cần bổ sung năng lượng nhanh chóng.</li>
                <li><strong>Hỗ trợ tiêu hóa:</strong> Hàm lượng chất xơ cao trong trái cây sấy giúp duy trì hệ tiêu hóa khỏe mạnh và ngăn ngừa táo bón.</li>
                <li><strong>Tốt cho sức khỏe:</strong> Là nguồn bổ sung vitamin, khoáng chất và chất chống oxy hóa, hỗ trợ hệ miễn dịch và sức khỏe tổng thể.</li>
                <li><strong>Đa dạng trong chế biến:</strong> Trái cây sấy có thể ăn trực tiếp hoặc kết hợp trong các món ăn như ngũ cốc, bánh, hoặc smoothie.</li>
            </ul>
    <h4 style="color: #bac34e;">Xuất xứ:</h4>
    <p style="line-height: 1.8; padding-left: 20px;">Việt Nam</p>
    <h4 style="color: #bac34e;">Đóng gói:</h4>
    <ul style="line-height: 1.8; padding-left: 20px;">
        <li><strong>Khối lượng:</strong> 50g, 100g(Tùy chỉnh theo nhu cầu).</li>
        <li><strong>Bao bì:</strong> Túi zip bạc, đảm bảo kín khí, giữ nguyên hương vị và chất lượng sản phẩm.</li>
        <li><strong>Hạn sử dụng:</strong> 12 tháng kể từ ngày sản xuất (in trên bao bì).</li>
    </ul>
    <h4 style="color: #bac34e;">Bảo quản:</h4>
    <ul style="line-height: 1.8; padding-left: 20px;">
        <li>Nơi khô ráo, thoáng mát, tránh ánh nắng trực tiếp.</li>
        <li><strong>Nhiệt độ bảo quản lý tưởng:</strong> 18-25°C.</li>
    </ul>
    <h4 style="color: #bac34e;">Hướng dẫn sử dụng:</h4>
    <ul style="line-height: 1.8; padding-left: 20px;">
        <li>Ăn trực tiếp như một món ăn vặt giàu dinh dưỡng.</li>
        <li>Kết hợp với các loại hạt, trái cây sấy khác để tạo ra hỗn hợp ăn sáng hoặc bữa phụ giàu năng lượng.</li>
        <li>Sử dụng làm nguyên liệu cho các loại bánh, granola, smoothie.</li>
    </ul>
    <h4 style="color: #bac34e;">Lưu ý:</h4>
    <ul style="line-height: 1.8; padding-left: 20px;">
        <li>Mặc dù tốt cho sức khỏe, không nên ăn quá nhiều trong một lần.</li>
        <li>Người bị tiểu đường nên tham khảo ý kiến bác sĩ trước khi sử dụng.</li>
        <li>Sản phẩm có thể gây dị ứng ở một số người.</li>
    </ul>
</div>
                      </p>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="reviews"
                    role="tabpanel"
                    aria-labelledby="reviews-tab"
                  >
                    <div class="product-review-body">
                      <h4 class="heading mb-5">Các Đánh Giá Của Người Dùng</h4>
                      <ul class="user-info-wrap">
                            <li class="user-comment">
                              <div class="meta">
                                <span
                                  ><strong>full_name - </strong> ngày viết note</span
                                >
                              </div>
                              <p class="short-desc mb-0">
                                note
                              </p>
                            </li>
                          </ul>
                        </li>
                      </ul>
                      <div class="feedback-area pt-5">
                        <h2 class="heading mb-1">Viết Đánh Giá</h2>
                        <p class="short-desc mb-3">
                          Địa chỉ email và số điện thoại của bạn sẽ không bị công khai !
                        </p>
                        <form class="feedback-form pt-8" action="#">
                          <div class="group-input">
                            <div class="form-field me-md-6 mb-6 mb-md-0">
                              <input
                                id="full_name"
                                type="text"
                                name="name"
                                placeholder="Tên của bạn là gì ?(Bắt buộc)"
                                class="input-field"
                              />
                            </div>
                            <div class="form-field me-md-6 mb-6 mb-md-0">
                              <input
                                id="email"
                                type="text"
                                name="email"
                                placeholder="Địa chỉ email của bạn là gì ?(Bắt buộc)"
                                class="input-field"
                              />
                            </div>
                            <div class="form-field">
                              <input
                                id="phone_number"
                                type="text"
                                name="number"
                                placeholder="Số điện thoại của bạn là gì ?(Bắt buộc)"
                                class="input-field"
                              />
                            </div>
                          </div>
                          <div class="form-field mt-6">
                            <textarea
                              id="note"
                              name="message"
                              placeholder="Viết đánh giá ở đây nhé !(Bắt buộc)"
                              class="textarea-field"
                            ></textarea>
                          </div>
                          <div class="button-wrap mt-8">
                            <button
                              type="submit"
                              value="submit"
                              class="btn btn-custom-size lg-size btn-secondary btn-primary-hover btn-lg rounded-0"
                              name="submit"
                            >
                              Gửi
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </main>
      <!-- Main Content Area End Here  -->

<script>
// Lấy ID sản phẩm từ URL
const productId = window.location.pathname.split('/').pop();

// Fetch chi tiết sản phẩm
function fetchProductDetail() {
  const token = localStorage.getItem('token');

  fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) throw new Error('Lỗi khi lấy dữ liệu sản phẩm');
    return response.json();
  })
  .then(data => {
    // Hiển thị thông tin sản phẩm
    document.getElementById('product-thumbnail').src = data.thumbnail;
    document.getElementById('product-name').textContent = data.name;

    const oldPrice = parseFloat(data.price);
    const discountRate = 10;
    const newPrice = oldPrice - (oldPrice * discountRate / 100);

    document.getElementById('old-price').textContent = oldPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    document.getElementById('new-price').textContent = newPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
    document.getElementById('product-description').textContent = data.description;
  })
  .catch(error => console.error('Lỗi:', error));
}

// Tải chi tiết sản phẩm khi trang được tải
document.addEventListener('DOMContentLoaded', fetchProductDetail);
</script>

@include('layouts.footer')