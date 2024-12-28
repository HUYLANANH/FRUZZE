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
                  <select class="nice-select wide rounded-0">
                    <option value="1">Sắp xếp theo mặc định</option>
                    <option value="4">Sắp xếp theo mới nhất</option>
                    <option value="5">Sắp xếp theo giá cao đến thấp</option>
                    <option value="6">Sắp xếp theo giá thấp đến cao</option>
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

  // Gọi API với các bộ lọc
  fetch(`http://127.0.0.1:8000/api/product?page=${page}${categoryFilter}${weightFilter}`, {
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
                      <li><a href="/cart"><i class="pe-7s-cart"></i></a></li>
                      <li><a href="/wishlist"><i class="pe-7s-like"></i></a></li>
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
      document.getElementById('product-list').innerHTML = "<p>Không tìm thấy sản phẩm nào</p>";
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
  selectedCategories = Array.from(document.querySelectorAll('.input-checkbox[data-category-id]:checked'))
    .map(checkbox => checkbox.dataset.category_id);

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

</script>

@include('layouts.footer')
