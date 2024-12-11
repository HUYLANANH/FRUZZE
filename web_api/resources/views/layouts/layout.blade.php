<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRUZZE Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700,600">
    <link href="https://pennypixels.pennymacusa.com/css/1_4_1/pp.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/FRUZZE-favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.2/dist/sweetalert2.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="main-wrapper">
        <!-- Main Header Area -->
        <header class="main-header_area position-relative">
        <div class="header-middle py-5">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-12">
                <div class="header-middle-wrap">
                  <a href="index.html" class="header-logo">
                    <img
                      src="assets/images/logo/FRUZZE.png"
                      alt="Header Logo"
                    />
                  </a>
                  <div class="header-search-area d-none d-lg-block">
                    <form action="#" class="header-searchbox">
                      <select class="nice-select select-search-category wide">
                        <option value="all">Tất Cả Sản Phẩm</option>
                        <option value="product-item">Trái Cây Sấy Lạnh</option>
                        <option value="product-item-2">Combo</option>
                      </select>
                      <input
                        class="input-field"
                        type="text"
                        placeholder="Tìm Kiếm"
                      />
                      <button
                        class="btn btn-outline-whisper btn-primary-hover"
                        type="submit"
                      >
                        <i class="pe-7s-search"></i>
                      </button>
                    </form>
                  </div>
                  <div class="header-right">
                    <ul>
                      <li class="dropdown d-none d-md-block">
                        <button
                          class="btn btn-link dropdown-toggle ht-btn p-0"
                          type="button"
                          id="settingButton"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="pe-7s-users"></i>
                        </button>
                        <ul
                          class="dropdown-menu dropdown-menu-end"
                          aria-labelledby="settingButton"
                        >
                          <li>
                            <a class="dropdown-item" href="my-account.html"
                              >Tài Khoản</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="login.html"
                              >Đăng Nhập</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="register.html"
                              >Đăng Ký</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li class="d-none d-md-block">
                        <a href="wishlist.html">
                          <i class="pe-7s-like"></i>
                        </a>
                      </li>
                      <li class="d-block d-lg-none">
                        <a href="#searchBar" class="search-btn toolbar-btn">
                          <i class="pe-7s-search"></i>
                        </a>
                      </li>
                      <li class="minicart-wrap me-3 me-lg-0">
                        <a href="#miniCart" class="minicart-btn toolbar-btn">
                          <i class="pe-7s-shopbag"></i>
                          <span class="quantity">3</span>
                        </a>
                      </li>
                      <li class="mobile-menu_wrap d-block d-lg-none">
                        <a
                          href="#mobileMenu"
                          class="mobile-menu_btn toolbar-btn pl-0"
                        >
                          <i class="pe-7s-menu"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="main-header header-sticky" data-bg-color="#3B6230">
          <div class="container">
            <div class="main-header_nav position-relative">
              <div class="row align-items-center">
                <div class="col-lg-12 d-none d-lg-block">
                  <div class="main-menu">
                    <nav class="main-nav">
                      <ul>
                        <li>
                          <a href="index.html">Trang Chủ</a>
                        </li>
                        <li>
                          <a href="about.html">Về FRUZZE</a>
                        </li>
                        <li>
                          <a href="shop.html">Cửa Hàng</a>
                        </li>
                        <li>
                          <a href="blog.html">Bài Viết</a>
                        </li>
                        <li>
                          <a href="contact.html">Liên Hệ</a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mobile-menu_wrapper" id="mobileMenu">
          <div class="offcanvas-body">
            <div class="inner-body">
              <div class="offcanvas-top">
                <a href="#" class="button-close"><i class="pe-7s-close"></i></a>
              </div>
              <div class="offcanvas-user-info text-center px-6 pb-5">
                <ul class="dropdown-wrap justify-content-center text-silver">
                  <li>
                    <a href="wishlist.html">
                      <i class="pe-7s-like"></i>
                    </a>
                  </li>
                </ul>
              </div>
              <div class="offcanvas-menu_area">
                <nav class="offcanvas-navigation">
                  <ul class="mobile-menu">
                    <li class="menu-item-has-children">
                      <a href="#">
                        <span class="mm-text"
                          >Trang Chủ
                          <i class="pe-7s-angle-down"></i>
                        </span>
                      </a>
                      <ul class="sub-menu">
                        <li>
                          <a href="index.html">
                            <span class="mm-text">Trang Chủ</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="about.html">
                        <span class="mm-text">Về FRUZZE</span>
                      </a>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">
                        <span class="mm-text"
                          >Cửa Hàng
                          <i class="pe-7s-angle-down"></i>
                        </span>
                      </a>
                    </li>
                    <li class="menu-item-has-children">
                      <a href="#">
                        <span class="mm-text"
                          >Bài Viết
                          <i class="pe-7s-angle-down"></i>
                        </span>
                      </a>
                    </li>
                    <li>
                      <a href="contact.html">
                        <span class="mm-text">Liên Hệ</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
        <div class="offcanvas-search_wrapper" id="searchBar">
          <div class="offcanvas-body">
            <div class="container h-100">
              <div class="offcanvas-search">
                <div class="offcanvas-top">
                  <a href="#" class="button-close"
                    ><i class="pe-7s-close"></i
                  ></a>
                </div>
                <span class="searchbox-info"
                  >Bắt đầu nhập và nhấn Enter để tìm kiếm</span
                >
                <form action="#" class="hm-searchbox">
                  <input type="text" placeholder="Search" />
                  <button class="search-btn" type="submit">
                    <i class="pe-7s-search"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="offcanvas-minicart_wrapper" id="miniCart">
          <div class="offcanvas-body">
            <div class="minicart-content">
              <div class="minicart-heading">
                <h4 class="mb-0">Giỏ Hàng</h4>
                <a href="#" class="button-close"><i class="pe-7s-close"></i></a>
              </div>
              <ul class="minicart-list">
                <li class="minicart-product">
                  <a class="product-item_remove" href="#"
                    ><i class="pe-7s-close"></i
                  ></a>
                  <a href="shop.html" class="product-item_img">
                    <img
                      class="img-full"
                      src="assets/images/bao bì/sầu riêng 100gr.png"
                      alt="Product Image"
                    />
                  </a>
                  <div class="product-item_content">
                    <a class="product-item_title" href="shop.html"
                      >Sầu riêng sấy lạnh thăng hoa</a
                    >
                    <span class="product-item_quantity">2 x 80.000 VNĐ</span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="minicart-item_total">
              <span>Tổng cộng</span>
              <span class="ammount">160.000 VNĐ</span>
            </div>
            <div class="group-btn_wrap d-grid gap-2">
              <a href="cart.html" class="btn btn-secondary btn-primary-hover"
                >Xem giỏ hàng</a
              >
              <a
                href="checkout.html"
                class="btn btn-secondary btn-primary-hover"
                >Đặt hàng</a
              >
            </div>
          </div>
        </div>
        <div class="global-overlay"></div>
        </header>

        @yield('content') <!-- Placeholder for dynamic content -->

          <!-- Begin Footer Area -->
      <div class="footer-area">
        <div
          class="footer-top section-space-y-axis-100 text-black"
          data-bg-color="#F7F8DF"
        >
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-md-6">
                <div class="widget-item">
                  <div class="footer-logo pb-4">
                    <a href="index.html">
                      <img src="assets/images/logo/FRUZZE.png" alt="Logo" />
                    </a>
                  </div>
                  <p class="short-desc mb-2">
                    Fruzze tự hào là thương hiệu luôn đặt chất lượng lên hàng
                    đầu, mang đến những trải nghiệm tuyệt vời qua từng sản phẩm.
                  </p>
                  <div class="widget-contact-info pb-6">
                    <ul>
                      <li>
                        <i class="pe-7s-map-marker"></i>
                        Tân Lập, Dĩ An, Bình Dương
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 offset-lg-1 col-md-6 pt-10 pt-lg-0">
                <div class="widget-item">
                  <h3 class="widget-title mb-5">Liên Hệ</h3>
                  <ul class="widget-list-item">
                    <li>
                      <b>FB: </b>
                      <a
                        href="https://www.facebook.com/profile.php?id=61554393290754"
                        >FRUZZE</a
                      >
                    </li>
                    <li>
                      <b>IG: </b>
                      <a href="https://www.instagram.com/ours.fruzze/"
                        >ours.fruzze</a
                      >
                    </li>
                    <li>
                      <b>Điện thoại: </b>
                      <a href="tel: +84859306712">0859306712</a>
                    </li>
                    <li>
                      <b>Email: </b>
                      22521442@gm.uit.edu.vn
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-2 offset-lg-1 col-md-6 pt-10 pt-lg-0">
                <div class="widget-item">
                  <h3 class="widget-title mb-5">FRUZZE</h3>
                  <ul class="widget-list-item">
                    <li>
                      <a href="index.html">Trang Chủ</a>
                    </li>
                    <li>
                      <a href="shop.html">Cửa Hàng</a>
                    </li>
                    <li>
                      <a href="blog.html">Bài Viết</a>
                    </li>
                    <li>
                      <a href="term.html">Chính Sách</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 pt-10 pt-lg-0">
                <div class="widget-item">
                  <h3 class="widget-title mb-5">Để lại lời nhắn</h3>
                  <p class="short-desc">
                    Nếu quan tâm đến FRUZZE, hãy để lại thông tin liên lạc tại
                    đây nhé.
                  </p>
                </div>
                <div class="widget-form-area">
                  <form class="widget-form" action="#">
                    <input
                      class="input-field"
                      type="email"
                      autocomplete="off"
                      placeholder="Email của bạn"
                    />
                    <div class="button-wrap pt-5">
                      <button
                        class="btn btn-custom-size btn-primary btn-secondary-hover rounded-0"
                        id="mc-submit"
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
        <div class="footer-bottom py-3" data-bg-color="#3B6230">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="copyright">
                  <span class="copyright-text text-white"
                    >© 2024 FRUZZE Made With
                    <i class="fa fa-heart text-danger"></i> by
                    <a href="https://hasthemes.com/" target="_blank">Group 10</a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Area End Here -->

      <!-- Begin Scroll To Top -->
      <a class="scroll-to-top" href="">
        <i class="fa fa-chevron-up"></i>
      </a>
      <!-- Scroll To Top End Here -->
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.waypoints.js') }}"></script>

    <!--Plugins JS-->
    <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>

    <!--Main JS (Common Activation Codes)-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
