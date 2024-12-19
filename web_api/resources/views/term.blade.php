@include('layouts.header')

<main class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-12">
                    <div class="breadcrumb-item text-center">
                        <h2 class="breadcrumb-heading text-uppercase font-weight-bold">CHÍNH SÁCH</h2>
                        <ul class="breadcrumb-list d-inline-flex justify-content-center">
                            <li><a href="/" class="text-black">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
                            <li class="text-black">Chính Sách</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chính Sách -->
    <div class="policy-container py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- Sidebar Menu -->
                <div class="col-lg-3 mb-4">
                    <div class="list-group sticky-top">
                        <a href="#policy1" class="list-group-item list-group-item-action active">Chính Sách Đổi Trả</a>
                        <a href="#policy2" class="list-group-item list-group-item-action">Chính Sách Vận Chuyển</a>
                        <a href="#policy3" class="list-group-item list-group-item-action">Chính Sách Bảo Mật</a>
                        <a href="#policy4" class="list-group-item list-group-item-action">Chính Sách Thanh Toán</a>
                        <a href="#policy5" class="list-group-item list-group-item-action">Ưu Đãi và Khuyến Mãi</a>
                    </div>
                </div>

                <!-- Nội dung Chính Sách -->
                <div class="col-lg-9">
                    <!-- Chính Sách 1 -->
                    <div id="policy1" class="policy-item p-4 mb-4 border rounded bg-white shadow-sm">
                        <h3 class="text-primary font-weight-bold mb-3">1. Chính Sách Đổi Trả Sản Phẩm</h3>
                        <p>
                            Chúng tôi chấp nhận đổi trả sản phẩm trong vòng <strong>7 ngày</strong> kể từ ngày nhận hàng nếu sản phẩm bị lỗi, hư hỏng hoặc không đúng với mô tả. 
                            Khách hàng cần giữ nguyên bao bì sản phẩm và không sử dụng trước khi yêu cầu đổi trả.
                        </p>
                    </div>

                    <!-- Chính Sách 2 -->
                    <div id="policy2" class="policy-item p-4 mb-4 border rounded bg-white shadow-sm">
                        <h3 class="text-primary font-weight-bold mb-3">2. Chính Sách Vận Chuyển</h3>
                        <p>
                            FRUZZE cung cấp dịch vụ giao hàng tận nơi trên toàn quốc. Thời gian giao hàng sẽ phụ thuộc vào địa điểm của khách hàng và sẽ được thông báo khi khách hàng hoàn tất đơn hàng.
                        </p>
                    </div>

                    <!-- Chính Sách 3 -->
                    <div id="policy3" class="policy-item p-4 mb-4 border rounded bg-white shadow-sm">
                        <h3 class="text-primary font-weight-bold mb-3">3. Chính Sách Bảo Mật Thông Tin</h3>
                        <p>
                            Chúng tôi cam kết bảo mật thông tin cá nhân của khách hàng. Mọi thông tin cá nhân sẽ chỉ được sử dụng cho mục đích xử lý đơn hàng và không chia sẻ với bên thứ ba mà không có sự đồng ý của bạn.
                        </p>
                    </div>

                    <!-- Chính Sách 4 -->
                    <div id="policy4" class="policy-item p-4 mb-4 border rounded bg-white shadow-sm">
                        <h3 class="text-primary font-weight-bold mb-3">4. Chính Sách Thanh Toán</h3>
                        <p>
                            FRUZZE chấp nhận thanh toán qua các phương thức như <strong>chuyển khoản ngân hàng, thẻ tín dụng, ví điện tử và thanh toán khi nhận hàng (COD)</strong>. 
                            Đảm bảo rằng các thông tin thanh toán của bạn sẽ được bảo mật tuyệt đối.
                        </p>
                    </div>

                    <!-- Chính Sách 5 -->
                    <div id="policy5" class="policy-item p-4 mb-4 border rounded bg-white shadow-sm">
                        <h3 class="text-primary font-weight-bold mb-3">5. Chính Sách Ưu Đãi và Khuyến Mãi</h3>
                        <p>
                            Chúng tôi thường xuyên có các chương trình ưu đãi, khuyến mãi đặc biệt dành cho khách hàng thân thiết. 
                            Bạn có thể theo dõi các thông tin này trên website của FRUZZE hoặc các kênh truyền thông của chúng tôi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('layouts.footer')
