<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>FRUZZE Admin</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/FRUZZE-favicon.png') }}" />

    <!-- Vendor CSS (Contain Bootstrap, Icon Fonts) -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/Pe-icon-7-stroke.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Plugin CSS (Global Plugins Files) -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.min.css') }}" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin-style.css') }}" />
</head>

<body>
    <header class="main-header_area position-relative">
   <aside class="sidebar">
            <div class="sidebar-header">
                <a href="/" class="header-logo">
                    <img src="{{ asset('assets/images/logo/logotachnen.png') }}" alt="Header Logo" />                                </a>
                            </div>
                            <nav class="sidebar-nav">
                                <h3 >ADMIN</h3>
                                <ul>
                                    <li><a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                    <li><a href="/product/get"><i class="fas fa-cubes"></i> Sản phẩm</a></li>
                                    <li><a href="/orders"><i class="fas fa-box"></i> Đơn hàng</a></li>
                                    <li><a href="/admin/getusers"><i class="fas fa-users"></i> Người dùng</a></li>
                                </ul>
                            </nav>
                            <div class="bt-logout">
                                 <button class="btn btn-success" id="logout">Đăng Xuất</button>
                            </div>
                        </aside>
                    </div>
</header>

