@include('layouts.header')

<div class="main-wrapper">
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
              <h2 class="breadcrumb-heading">CỬA HÀNG</h2>
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

    <div class="shop-area section-space-y-axis-100">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 order-lg-1 order-2 pt-10 pt-lg-0">
            <div class="sidebar-area">
              <div class="widgets-area mb-9">
                <h2 class="widgets-title mb-5"><b style="color: #bac34e; font-size: 25px;">LỌC SẢN PHẨM</b></h2>
                <div class="widgets-area mb-9">
                  <h2 class="widgets-title mb-5" style="color: #bac34e">Danh mục sản phẩm</h2>
                  <div class="widgets-item">
                    <ul class="widgets-checkbox">
                      <li>
                        <input
                          class="input-checkbox"
                          type="checkbox"
                          id="2"
                          data-category-id="2"
                        />
                        <label class="label-checkbox mb-0" for="2">Trái Cây Sấy Lạnh Thăng Hoa</label>
                      </li>
                      <li>
                        <input
                          class="input-checkbox"
                          type="checkbox"
                          id="3"
                          data-category-id="3"
                        />
                        <label class="label-checkbox mb-0" for="3">Sữa Chua Sấy Lạnh Thăng Hoa</label>
                      </li>
                      <li>
                        <input
                          class="input-checkbox"
                          type="checkbox"
                          id="4"
                          data-category-id="4"
                        />
                        <label class="label-checkbox mb-0" for="4">Mix</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="widgets-area mb-9">
                <h2 class="widgets-title mb-5" style="color: #bac34e">Trọng Lượng</h2>
                <div class="widgets-item">
                  <ul class="widgets-checkbox">
                  <li>
                    <input
                      class="input-checkbox"
                      type="checkbox"
                      id="size-selection-1"
                      data-weight="50"
                    />
                    <label class="label-checkbox mb-0" for="size-selection-1">50 Gram</label>
                  </li>
                  <li>
                    <input
                      class="input-checkbox"
                      type="checkbox"
                      id="size-selection-2"
                      data-weight="100"
                    />
                    <label class="label-checkbox mb-0" for="size-selection-2">100 Gram</label>
                  </li>
                    <button id="filter-btn" class="btn btn-primary btn-secondary-hover" type="button">
                      Lọc
                    </button>
                  </ul>
                </div>
              </div>

              <div class="widgets-area">
                <h2 class="widgets-title mb-5" style="color: #bac34e">Thẻ</h2>
                <div class="widgets-item">
                  <ul class="widgets-tags">
                    <li><a href="javascript:void(0)">Sầu riêng</a></li>
                    <li><a href="javascript:void(0)">Mít</a></li>
                    <li><a href="javascript:void(0)">Chuối</a></li>
                    <li><a href="javascript:void(0)">Xoài</a></li>
                    <li><a href="javascript:void(0)">Thanh long</a></li>
                    <li><a href="javascript:void(0)">Dứa</a></li>
                    <li><a href="javascript:void(0)">Đào</a></li>
                    <li><a href="javascript:void(0)">Kiwi</a></li>
                    <li><a href="javascript:void(0)">Măng cụt</a></li>
                    <li><a href="javascript:void(0)">Sữa chua</a></li>
                    <li><a href="javascript:void(0)">Mix</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-9 order-lg-2 order-1">
            <div class="product-topbar">
              <ul>
                <li class="product-view-wrap">
                  <ul class="nav" role="tablist">
                    <li class="list-view" role="presentation">
                      <a class="active" id="list-view-tab" data-bs-toggle="tab" href="#list-view" role="tab" aria-selected="true">
                        <i class="fa fa-th-list"></i>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="short">
                <select id="sort-options" class="nice-select wide rounded-0" onchange="handleSortChange()">
                  <option value="default">Mặc định</option>
                  <option value="price_asc">Giá: Thấp đến Cao</option>
                  <option value="price_desc">Giá: Cao đến Thấp</option>
                  <option value="newest">Mới nhất</option>
                </select>
                </li>
              </ul>
            </div>

            <div class="tab-content text-charcoal pt-8" id="product-list"></div>

            <div class="pagination-area pt-10">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <!-- Pagination will be injected here -->
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
let currentPage = 1;  // Khởi tạo giá trị currentPage
let selectedCategories = []; // Mảng chứa các category_id đã chọn
let selectedWeights = []; // Mảng chứa trọng lượng đã chọn
let allProducts = []; // Mảng lưu trữ tất cả sản phẩm
let currentSort = 'default'; // Tiêu chí sắp xếp hiện tại

function handleSortChange() {
  const sortDropdown = document.getElementById('sort-options');
  currentSort = sortDropdown.value; // Lấy giá trị sắp xếp từ dropdown
  fetchProducts(); // Gọi lại API với tiêu chí sắp xếp mới
}

// Fetch product data from the API with filters
function fetchProducts(page = 1) {
  currentPage = page; // Cập nhật trang hiện tại
  const token = localStorage.getItem('token');

  // Tạo chuỗi query cho category và weight filter
  const categoryFilter = selectedCategories.length > 0 
  ? `&category_id=${encodeURIComponent(selectedCategories.join(','))}` 
  : '';  

  const weightFilter = selectedWeights.length > 0 
  ? `&weight=${encodeURIComponent(selectedWeights.join(','))}` 
  : '';

  // Tạo chuỗi query cho sắp xếp
  // Xác định trường để sắp xếp (sort_by)
  const sort_by = currentSort === 'price_asc' ? 'price' :
                  currentSort === 'price_desc' ? 'price' :
                  currentSort === 'newest' ? 'created_at' : 'id'; // 'id' cho mặc định

  // Xác định thứ tự sắp xếp (sort_order)
  const sort_order = currentSort === 'price_asc' ? 'asc' : // Giá từ thấp đến cao
                     currentSort === 'price_desc' ? 'desc' : // Giá từ cao đến thấp
                     currentSort === 'newest' ? 'desc' : 'asc'; // 'newest' mặc định là 'desc', vì thông thường mới nhất sẽ giảm dần

  // Cập nhật URL với các tham số sắp xếp
  fetch(`http://127.0.0.1:8000/api/product?page=${page}${categoryFilter}${weightFilter}&sort_by=${sort_by}&sort_order=${sort_order}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Lỗi khi lấy dữ liệu: ' + response.status);
    }
    return response.json();
  })
  .then(data => {
    console.log('Dữ liệu trả về từ backend: ', data);

    if (data && data.data && Array.isArray(data.data)) {
      let productListHTML = '';
      data.data.forEach(product => {
        // Tính giá sau khi giảm giá
        const discountRate = 10;
        const oldPrice = parseFloat(product.price);
        const newPrice = oldPrice - (oldPrice * discountRate / 100);

        // Định dạng giá
        const formattedOldPrice = oldPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        const formattedNewPrice = newPrice.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });

        productListHTML += `
          <div class="product-list-view with-sidebar row">
            <div class="col-12 pt-6">
              <div class="product-item">
                <div class="product-img img-zoom-effect">
                  <a href="/detail-shop/${product.id}">
                    <img class="img-full" src="${product.thumbnail}" alt="${product.name}" />
                  </a>
                  <div class="product-add-action">
                    <ul>
                      <li>
                        <a href="javascript:void(0)" 
                          data-product-id="${product.id}" 
                          data-product-name="${product.name}" 
                          data-product-price="${product.price}" 
                          data-product-thumbnail="${product.thumbnail}">
                          <i class="pe-7s-cart"></i>
                        </a>
                      </li>
                      <li><a href="javascript:void(0)" 
                          data-product-id="${product.id}" 
                          data-product-name="${product.name}" 
                          data-product-price="${product.price}" 
                          data-product-thumbnail="${product.thumbnail}">
                          <i class="pe-7s-like"></i></li>
                        </a>
                    </ul>
                  </div>
                </div>
                <div class="product-content align-self-center">
                  <a class="product-name pb-2" href="/detail-shop/${product.id}"><b style="color: #bac34e">${product.name}</b></a>
                  <div class="price-box pb-1">
                    <span class="old-price" style="color: red;"> ${formattedOldPrice}</span>
                    <span class="new-price">${formattedNewPrice}</span>
                  </div>
                  <div><span class="short-desc mb-0">${product.description}</span></div>
                </div>
              </div>
            </div>
          </div>
        `;
      });
      document.getElementById('product-list').innerHTML = productListHTML;
    } else {
      productListHTML = "<p style='text-align: center; color: red; font-weight: bold;'>Không tìm thấy sản phẩm nào!</p>";    
    }

    renderPagination(data); // Gọi hàm phân trang
  })
  .catch(error => console.error('Lỗi:', error));
}

// Render phân trang
function renderPagination(data) {
  const paginationHTML = [];

  if (data.prev_page_url) {
    paginationHTML.push(`
      <li class="page-item">
        <a class="page-link" href="javascript:void(0)" onclick="fetchProducts(${currentPage - 1})" aria-label="Previous">
          <span class="fa fa-chevron-left"></span>
        </a>
      </li>
    `);
  }

  for (let i = 1; i <= data.last_page; i++) {
    paginationHTML.push(`
      <li class="page-item ${i === currentPage ? 'active' : ''}">
        <a class="page-link" href="javascript:void(0)" onclick="fetchProducts(${i})">${i}</a>
      </li>
    `);
  }

  if (data.next_page_url) {
    paginationHTML.push(`
      <li class="page-item">
        <a class="page-link" href="javascript:void(0)" onclick="fetchProducts(${currentPage + 1})" aria-label="Next">
          <span class="fa fa-chevron-right"></span>
        </a>
      </li>
    `);
  }

  document.querySelector('.pagination').innerHTML = paginationHTML.join('');
}

document.getElementById('filter-btn').addEventListener('click', function () {
  // Thu thập các category được chọn
 // Thu thập các trọng lượng được chọn
 selectedCategories = Array.from(
    document.querySelectorAll('.input-checkbox[data-category-id]:checked')
  ).map(checkbox => checkbox.getAttribute('data-category-id'));

  // Thu thập các trọng lượng được chọn
  selectedWeights = Array.from(
    document.querySelectorAll('.input-checkbox[data-weight]:checked')
  ).map(checkbox => checkbox.getAttribute('data-weight'));

  console.log('Danh mục đã chọn:', selectedCategories);
  console.log('Trọng lượng đã chọn:', selectedWeights);

  // Gọi API để lấy sản phẩm với các bộ lọc
  fetchProducts(currentPage);
});

// Load sản phẩm khi DOM được tải
document.addEventListener("DOMContentLoaded", function() {
  fetchProducts(currentPage);
});
// Sự kiện thêm sản phẩm vào giỏ hàng
document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const productId = this.dataset.productId;
        const productName = this.dataset.productName;
        const productPrice = parseFloat(this.dataset.productPrice);
        const productThumbnail = this.dataset.productThumbnail;

        // Thêm sản phẩm vào giỏ hàng
        addToCart(productId, productName, productPrice, productThumbnail);
    });
});

// Hàm thêm sản phẩm vào giỏ hàng
function addToCart(productId, productName, productPrice, productThumbnail) {
    const token = localStorage.getItem('token');
    if (!token) {
        alert('Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.');
        return;
    }

    const cartData = {
        product_id: productId,
        quantity: 1, // Mặc định thêm 1 sản phẩm
        price: productPrice, // Cần gửi giá sản phẩm vì backend yêu cầu
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
        <div class="success-message">
            <p>Thêm sản phẩm vào giỏ hàng thành công! 
                <a href="/cart" class="btn btn-primary">Xem giỏ hàng</a>
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
    document.getElementById('product-list').addEventListener('click', function (event) {
        const target = event.target.closest('[data-product-id]');
        if (target) {
            const productId = target.dataset.productId;
            const productName = target.dataset.productName;
            const productPrice = parseFloat(target.dataset.productPrice);
            const productThumbnail = target.dataset.productThumbnail;

            // Gọi hàm thêm sản phẩm vào giỏ hàng
            addToCart(productId, productName, productPrice, productThumbnail);
        }
    });
});

</script>

@include('layouts.footer')
