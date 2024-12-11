<!-- resources/views/partials/header.blade.php -->
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