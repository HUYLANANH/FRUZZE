<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>FRUZZE</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Favicon -->
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="{{ asset('assets/images/FRUZZE-favicon.png') }}"
    />

    <!-- Vendor CSS (Contain Bootstrap, Icon Fonts) -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/Pe-icon-7-stroke.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Plugin CSS (Global Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.min.css') }}"/>

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  </head>

  <body>
<!-- Begin Main Header Area -->
<header class="main-header_area position-relative">
        <div class="header-middle py-5">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-12">
                <div class="header-middle-wrap">
                  <a href="/index" class="header-logo">
                    <img
                      src="{{ asset('assets/images/logo/logotachnen.png') }}"
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
                            <a class="dropdown-item" href="/profile"
                              >Tài Khoản</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="/login"
                              >Đăng Nhập</a
                            >
                          </li>
                          <li>
                            <a class="dropdown-item" href="/register"
                              >Đăng Ký</a
                            >
                          </li>
                        </ul>
                      </li>
                      <li class="d-none d-md-block">
                        <a href="/wishlist">
                          <i class="pe-7s-like"></i>
                        </a>
                      </li>
                      <li class="d-block d-lg-none">
                        <a href="#searchBar" class="search-btn toolbar-btn">
                          <i class="pe-7s-search"></i>
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
                          <a href="/index">Trang Chủ</a>
                        </li>
                        <li>
                          <a href="/about">Về FRUZZE</a>
                        </li>
                        <li>
                          <a href="/shop">Cửa Hàng</a>
                        </li>
                        <li>
                          <a href="/blog">Bài Viết</a>
                        </li>
                        <li>
                          <a href="/contact">Liên Hệ</a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- Main Header Area End Here -->