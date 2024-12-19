@include('layouts.header')

<!-- Begin Main Content Area -->
<main class="main-content">
    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">WISHLIST</h2>
                        <ul>
                            <li><a href="index.html">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wishlist-area section-space-y-axis-100">
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
                                        <th class="product-stock-status">Tình trạng</th>
                                        <th class="cart_btn">Thêm vào giỏ hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="wishlist-item">
                                        <td class="product_remove">
                                            <a href="javascript:void(0)" class="remove-btn">
                                                <i class="pe-7s-close" title="Remove"></i>
                                            </a>
                                        </td>
                                        <td class="product-thumbnail">
                                            <a href="javascript:void(0)">
                                                <img src="" alt="Ảnh sản phẩm" />
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="javascript:void(0)" class="product-name-link">Mít sấy thăng hoa</a>
                                        </td>
                                        <td class="product-price">
                                            <span class="amount">80.000 VNĐ</span>
                                        </td>
                                        <td class="product-stock-status">
                                            <span class="in-stock">Còn hàng</span>
                                        </td>
                                        <td class="cart_btn">
                                            <a href="javascript:void(0)" class="add-to-cart-btn" data-product-name="Sầu riêng sấy thăng hoa" data-product-price="80.000 VNĐ">
                                                Thêm vào giỏ hàng
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Thêm các sản phẩm khác vào đây -->
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Main Content Area End Here -->

<script>
// JavaScript xử lý giỏ hàng
document.addEventListener("DOMContentLoaded", function() {
    // Kiểm tra và lấy giỏ hàng từ LocalStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Xử lý sự kiện khi click vào nút "Thêm vào giỏ hàng"
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            let productName = this.getAttribute('data-product-name');
            let productPrice = this.getAttribute('data-product-price');

            // Kiểm tra sản phẩm có trong giỏ hàng chưa
            let productIndex = cart.findIndex(item => item.name === productName);

            if (productIndex !== -1) {
                // Sản phẩm đã có trong giỏ hàng
                alert('Sản phẩm đã được thêm vào giỏ hàng');
            } else {
                // Thêm sản phẩm vào giỏ hàng
                cart.push({
                    name: productName,
                    price: productPrice
                });

                // Lưu giỏ hàng vào LocalStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                alert('Sản phẩm đã được thêm vào giỏ hàng');
            }
        });
    });

    // Xử lý sự kiện xóa sản phẩm
    document.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Tìm dòng sản phẩm cần xóa
            const row = this.closest('tr');
            if (row) {
                row.remove(); // Xóa dòng sản phẩm khỏi bảng
                alert('Sản phẩm đã bị xóa khỏi danh sách yêu thích');
            }
        });
    });
});
</script>

<script src="{{ asset('assets/js/button-remove.js') }}"></script>

@include('layouts.footer')
