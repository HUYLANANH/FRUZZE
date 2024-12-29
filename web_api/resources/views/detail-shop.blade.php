@include('layouts.header')

      <!-- Begin Main Content Area  -->
      <main class="main-content">
        <div
          class="breadcrumb-area breadcrumb-height"
          data-bg-image="/assets/images/breadcrumb/bg/bg.png"
          >
          <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-12">
            <div class="breadcrumb-item">
              <h2 class="breadcrumb-heading">CHI TIẾT SẢN PHẨM</h2>
              <ul>
                <li>
                  <a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a>
                </li>
                <li>Cửa Hàng</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
        </div>
        <div class="single-product-area section-space-top-100">
          <div class="container">
          <div class="row">
          <div class="product-row row">
    <!-- Hình ảnh sản phẩm -->
    <div class="col-lg-6">
        <div class="single-product-img h-100">
                <div class="image-container">
                    <img id="product-thumbnail" src="/" alt="Product Image">
                </div>
        </div>
    </div>
    
    <!-- Thông tin sản phẩm và nút thêm giỏ hàng -->
    <div class="col-lg-6">
        <div class="single-product-content">
            <div class="product-details">
                <h2 id="product-name" class="title">Tên sản phẩm</h2>
                <div class="price-box pb-1">
                    <span id="new-price" class="new-price text-danger">giá đã giảm</span>
                    <span id="old-price" class="old-price text-primary">giá chưa giảm</span>
                </div>
                <p id="product-description" class="short-desc mb-6">Mô tả description</p>
                <div class="quantity-with-btn">
                    <div class="quantity">
                        <button class="btn quantity-btn" id="decrease">-</button>
                        <span class="quantity-number">1</span>
                        <button class="btn quantity-btn" id="increase">+</button>
                    </div>
                    <button class="btn add-to-cart" id="add-to-cart-button"
                        
                    >
                        Thêm vào giỏ hàng
                    </button>
                    <button class="btn wishlist-btn">Yêu thích</button>
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
                    <B>MÔ TẢ</B>  
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
                </div>
              </div>
            </div>
          </div>
        </div>

      </main>
      <!-- Main Content Area End Here  -->

<script>
// Lấy ID sản phẩm từ URL và gán vào biến toàn cục productId
const productId = window.location.pathname.split('/').pop();

// Fetch chi tiết sản phẩm
function fetchProductDetail() {
  const token = localStorage.getItem('token');

  fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json',
    },
  })
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      if (!data || !data.id) {
        // Nếu phản hồi không hợp lệ hoặc không có sản phẩm
        console.error('Không tìm thấy sản phẩm hoặc dữ liệu không hợp lệ!');
        alert('Không tìm thấy sản phẩm hoặc dữ liệu không hợp lệ!');
        return;
      }

      // Hiển thị thông tin sản phẩm
      document.getElementById('product-thumbnail').src = `/${data.thumbnail}`;
      document.getElementById('product-name').textContent = data.name;

      const oldPrice = parseFloat(data.price.replace(/,/g, ''));  // Xóa dấu phẩy nếu có
      const discountRate = 10; // % giảm giá (nếu có)
      const newPrice = oldPrice - (oldPrice * discountRate / 100);

      // Kiểm tra và hiển thị giá mới và giá cũ
      if (isNaN(newPrice)) {
        console.error('Lỗi tính giá mới!');
        alert('Lỗi tính giá mới!');
      } else {
        document.getElementById('new-price').textContent = newPrice.toLocaleString('vi-VN', {
          style: 'currency',
          currency: 'VND',
        });
      }

      // Hiển thị giá cũ
      document.getElementById('old-price').textContent = oldPrice.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND',
      });

      // Hiển thị mô tả sản phẩm
      document.getElementById('product-description').textContent = data.description;

      // Cập nhật ảnh sản phẩm
      const productThumbnail = document.getElementById('product-thumbnail');
      productThumbnail.style.maxWidth = "100%";
      productThumbnail.style.maxHeight = "500px";
      productThumbnail.style.objectFit = "cover";
      productThumbnail.style.objectPosition = "center center";
    })
    .catch(error => {
      console.error('Lỗi không mong muốn:', error.message);
      alert('Đã xảy ra lỗi khi tải thông tin sản phẩm.');
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const decreaseButton = document.getElementById('decrease');
    const increaseButton = document.getElementById('increase');
    const quantityDisplay = document.querySelector('.quantity-number');

    let quantity = 1; // Số lượng mặc định

    // Hàm cập nhật hiển thị số lượng
    function updateQuantityDisplay() {
        quantityDisplay.textContent = quantity;
    }

    // Sự kiện giảm số lượng
    decreaseButton.addEventListener('click', function () {
        if (quantity > 1) {
            quantity -= 1;
            updateQuantityDisplay();
        }
    });

    // Sự kiện tăng số lượng
    increaseButton.addEventListener('click', function () {
        quantity += 1;
        updateQuantityDisplay();
    });

    // Cập nhật số lượng khi thêm vào giỏ hàng
    const addToCartButton = document.getElementById('add-to-cart-button');
    addToCartButton.addEventListener('click', function () {
        const productName = document.getElementById('product-name').textContent;
        const productPrice = document.getElementById('old-price').textContent;
        const productThumbnail = document.getElementById('product-thumbnail').src;

        // Gọi hàm thêm sản phẩm vào giỏ hàng với số lượng hiện tại
        addToCart(productId, productName, productPrice, productThumbnail, quantity);
    });
});

// Tải chi tiết sản phẩm khi trang được tải
document.addEventListener('DOMContentLoaded', fetchProductDetail);

// Hàm thêm sản phẩm vào giỏ hàng
function addToCart(productId, productName, productPrice, productThumbnail, quantity) {
  const token = localStorage.getItem('token');
  if (!token) {
    alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
    return;
  }

  const cleanedPrice = productPrice.replace(/[^\d.-]/g, '');
  const price = parseFloat(cleanedPrice.replace(',', '.'));

  if (isNaN(price)) {
    console.error('Giá sản phẩm không hợp lệ!');
    alert('Giá sản phẩm không hợp lệ!');
    return;
  }

  const cartData = {
    product_id: productId,
    quantity: quantity, // Cập nhật số lượng đã chọn
    price: price * 1000, // Chuyển giá sang đúng định dạng nếu cần
  };

  fetch('http://127.0.0.1:8000/api/cart', {
    method: 'POST',
    body: JSON.stringify(cartData),
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${token}`, // Gửi token để xác thực
    },
  })
    .then(response => {
      if (!response.ok) {
        return response.json().then(err => {
          throw new Error(err.message || 'Không thể thêm sản phẩm vào giỏ hàng');
        });
      }
      return response.json();
    })
    .then(data => {
      console.log('Sản phẩm đã thêm vào giỏ hàng:', data);
      showSuccessMessage();
    })
    .catch(error => {
      console.error('Lỗi:', error);
      alert(error.message || 'Lỗi khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại.');
    });
}

// Hàm hiển thị thông báo thành công với liên kết
function showSuccessMessage() {
  const messageContainer = document.createElement('div');
  messageContainer.innerHTML = `
      <div class="success-message" style="padding: 15px; background-color: #4CAF50; color: white; text-align: center; border-radius: 5px;">
          <p>Thêm sản phẩm vào giỏ hàng thành công! 
              <a href="/cart" class="btn btn-primary" style="color: white; text-decoration: underline;">Xem giỏ hàng</a>
          </p>
      </div>
  `;
  document.body.appendChild(messageContainer); // Thêm thông báo vào body hoặc container mong muốn

  // Tự động ẩn thông báo sau 5 giây
  setTimeout(() => {
    messageContainer.remove();
  }, 5000);
}

// Gắn sự kiện vào các nút "Thêm vào giỏ hàng"
document.addEventListener('DOMContentLoaded', function () {
  const addToCartButton = document.getElementById('add-to-cart-button');
  if (addToCartButton) {
    addToCartButton.addEventListener('click', function () {
      const productName = document.getElementById('product-name').textContent;
      const productPrice = document.getElementById('old-price').textContent;
      const productThumbnail = document.getElementById('product-thumbnail').src;

      // Gọi hàm thêm sản phẩm vào giỏ hàng
      addToCart(productId, productName, productPrice, productThumbnail, quantity);
    });
  }
});

</script>

@include('layouts.footer')