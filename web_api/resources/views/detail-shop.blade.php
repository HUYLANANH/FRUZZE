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
                      <h2 class="title">Tên sp</h2>
                      <div class="price-box pb-1">
                        <span class="new-price text-danger">Giá tiền đã giảm 10%</span>
                        <span class="old-price text-primary">Giá tiền ban đầu</span>
                      </div>
                      <p class="short-desc mb-6">
                        Description
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
                      <div class="product-category text-matterhorn pb-2">
                        <span class="title">Danh mục sản phẩm :</span>
                        <ul>
                          <li>
                            <a href="javascript:void(0)">Trái cây sấy thăng hoa,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Mix,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Sữa chua sấy thăng hoa</a>
                          </li>
                        </ul>
                      </div>
                      <div
                        class="product-category product-tags text-matterhorn pb-4"
                      >
                        <span class="title">Thẻ :</span>
                        <ul>
                          <li>
                            <a href="javascript:void(0)">Sầu riêng, </a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Thanh long,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Mít,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Chuối,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Dứa,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Xoài,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Đào,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Măng cụt,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Dâu,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Sữa chua,</a>
                          </li>
                          <li>
                            <a href="javascript:void(0)">Kiwi</a>
                          </li>
                        </ul>
                      </div>
                      <div class="social-link align-items-center pb-lg-8">
                        <span class="title pe-3">Share:</span>
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
                      Mô tả
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
                    Đánh giá
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
<div class="section">
  <h4>Công Dụng</h4>
  <ul>
    <li>Là nguồn cung cấp năng lượng nhanh, giàu carbohydrate tự nhiên.</li>
    <li>Chứa chất chống oxy hóa giúp bảo vệ cơ thể khỏi tác hại của các gốc tự do.</li>
    <li>Giàu vitamin C, hỗ trợ tăng cường hệ miễn dịch.</li>
    <li>Tốt cho sức khỏe xương nhờ chứa các khoáng chất như kali và magie.</li>
    <li>Giúp cải thiện tiêu hóa nhờ hàm lượng chất xơ tự nhiên.</li>
    <li>Tăng cường sức khỏe làn da và tóc.</li>
  </ul>
</div>
<div class="section">
  <h4>Thông Tin Sản Phẩm</h4>
  <ul>
    <li><strong>Xuất xứ:</strong> Việt Nam</li>
    <li><strong>Đóng gói:</strong> Khối lượng sản phẩm: 50g, 100g</li>
    <li>Túi giấy có khóa zip và cán màng bạc bên trong, giúp bảo quản sản phẩm lâu hơn.</li>
    <li><strong>Hạn sử dụng:</strong> 6 tháng kể từ ngày sản xuất</li>
  </ul>
</div>
<div class="section">
  <h4>Bảo Quản</h4>
  <ul>
    <li>Nơi khô ráo, thoáng mát ở nhiệt độ từ -50°C đến -30°C, tránh ánh nắng trực tiếp.</li>
    <li>Đóng kín miệng bao bì sau khi sử dụng.</li>
  </ul>
</div>
<div class="section">
  <h4>Hướng Dẫn Sử Dụng</h4>
  <ul>
    <li>Ăn trực tiếp như món ăn vặt.</li>
    <li>Kết hợp với các loại trái cây khô, sữa chua, hoặc làm nguyên liệu trong các món bánh, chè.</li>
    <li>Trang trí bánh ngọt hoặc làm topping cho các món tráng miệng.</li>
  </ul>
</div>
<div class="section note">
  <h4>Lưu Ý</h4>
  <ul>
    <li>Không nên ăn quá 100g/ngày để tránh gây khó tiêu.</li>
    <li>Không sử dụng nếu sản phẩm có dấu hiệu hư hỏng, mốc hoặc đã hết hạn.</li>
  </ul>
</div>
<div class="section">
  <h4>Khuyến Cáo (Những Đối Tượng Không Nên Sử Dụng)</h4>
  <ul>
    <li>Người bị tiểu đường hoặc béo phì nên hạn chế vì sầu riêng có hàm lượng đường và năng lượng cao.</li>
    <li>Người bị dị ứng với sầu riêng hoặc các loại trái cây nhiệt đới.</li>
    <li>Người có hệ tiêu hóa yếu hoặc mắc các bệnh liên quan đến dạ dày, cần dùng lượng vừa phải.</li>
    <li>Trẻ nhỏ dưới 2 tuổi nên sử dụng với liều lượng nhỏ, phù hợp với độ tuổi.</li>
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
                      <h4 class="heading mb-5">3 Review Items</h4>
                      <ul class="user-info-wrap">
                        <li>
                          <ul class="user-info">
                            <li class="user-avatar">
                              <img
                                src="assets/images/testimonial/user/1.png"
                                alt="User Image"
                              />
                            </li>
                            <li class="user-comment">
                              <div class="rating-box">
                                <ul>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                </ul>
                              </div>
                              <div class="meta">
                                <span
                                  ><strong>Oscar -</strong> March 15, 2021</span
                                >
                              </div>
                              <p class="short-desc mb-0">
                                “Sed ligula sapien, fermentum id est eget,
                                viverra auctor sem. Vivamus maximus enim vitae
                                urna porta, ut euismod nibh lacinia ellentesque
                                at diam voluptas quas nisi, culpa in
                                accusantium“
                              </p>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <ul class="user-info">
                            <li class="user-avatar">
                              <img
                                src="assets/images/testimonial/user/1.png"
                                alt="User Image"
                              />
                            </li>
                            <li class="user-comment">
                              <div class="rating-box">
                                <ul>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                </ul>
                              </div>
                              <div class="meta">
                                <span
                                  ><strong>Oscar -</strong> March 15, 2021</span
                                >
                              </div>
                              <p class="short-desc mb-0">
                                “Sed ligula sapien, fermentum id est eget,
                                viverra auctor sem. Vivamus maximus enim vitae
                                urna porta, ut euismod nibh lacinia ellentesque
                                at diam voluptas quas nisi, culpa in
                                accusantium“
                              </p>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <ul class="user-info">
                            <li class="user-avatar">
                              <img
                                src="assets/images/testimonial/user/1.png"
                                alt="User Image"
                              />
                            </li>
                            <li class="user-comment">
                              <div class="rating-box">
                                <ul>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                  <li><i class="pe-7s-star"></i></li>
                                </ul>
                              </div>
                              <div class="meta">
                                <span
                                  ><strong>Oscar -</strong> March 15, 2021</span
                                >
                              </div>
                              <p class="short-desc mb-0">
                                “Sed ligula sapien, fermentum id est eget,
                                viverra auctor sem. Vivamus maximus enim vitae
                                urna porta, ut euismod nibh lacinia ellentesque
                                at diam voluptas quas nisi, culpa in
                                accusantium“
                              </p>
                            </li>
                          </ul>
                        </li>
                      </ul>
                      <div class="feedback-area pt-5">
                        <h2 class="heading mb-1">Add a review</h2>
                        <p class="short-desc mb-3">
                          Your email address will not be published.
                        </p>
                        <div class="rating-box">
                          <span>Your rating</span>
                          <ul class="ps-4">
                            <li><i class="pe-7s-star"></i></li>
                            <li><i class="pe-7s-star"></i></li>
                            <li><i class="pe-7s-star"></i></li>
                            <li><i class="pe-7s-star"></i></li>
                            <li><i class="pe-7s-star"></i></li>
                          </ul>
                        </div>
                        <form class="feedback-form pt-8" action="#">
                          <div class="group-input">
                            <div class="form-field me-md-6 mb-6 mb-md-0">
                              <input
                                type="text"
                                name="name"
                                placeholder="Your Name*"
                                class="input-field"
                              />
                            </div>
                            <div class="form-field me-md-6 mb-6 mb-md-0">
                              <input
                                type="text"
                                name="email"
                                placeholder="Your Email*"
                                class="input-field"
                              />
                            </div>
                            <div class="form-field">
                              <input
                                type="text"
                                name="number"
                                placeholder="Phone number"
                                class="input-field"
                              />
                            </div>
                          </div>
                          <div class="form-field mt-6">
                            <textarea
                              name="message"
                              placeholder="Message"
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
                              Submit
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="shipping"
                    role="tabpanel"
                    aria-labelledby="shipping-tab"
                  >
                    <div class="product-shipping-body">
                      <h4 class="title">Shipping</h4>
                      <p class="short-desc mb-4">
                        The item will be shipped from China. So it need 15-20
                        days to deliver. Our product is good with reasonable
                        price and we believe you will worth it. So please wait
                        for it patiently! Thanks.Any question please kindly to
                        contact us and we promise to work hard to help you to
                        solve the problem
                      </p>
                      <h4 class="title">About return request</h4>
                      <p class="short-desc mb-4">
                        If you don't need the item with worry, you can contact
                        us then we will help you to solve the problem, so please
                        close the return request! Thanks
                      </p>
                      <h4 class="title">Guarantee</h4>
                      <p class="short-desc mb-0">
                        If it is the quality question, we will resend or refund
                        to you; If you receive damaged or wrong items, please
                        contact us and attach some pictures about product, we
                        will exchange a new correct item to you after the
                        confirmation.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- Main Content Area End Here  -->


@include('layouts.footer')