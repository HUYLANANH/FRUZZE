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
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
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
                  <div class="widgets-searchbox mb-9">
                    <form id="widgets-searchbox" action="#">
                      <input
                        class="input-field"
                        type="text"
                        placeholder="Tìm Kiếm Sản Phẩm"
                      />
                      <button class="widgets-searchbox-btn" type="submit">
                        <i class="pe-7s-search"></i>
                      </button>
                    </form>
                  </div>
                  <div class="widgets-area mb-9">
                    <h2 class="widgets-title mb-5">Lọc Theo</h2>
                    <div class="widgets-item">
                      <ul class="widgets-checkbox">
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="refine-item"
                          />
                          <label class="label-checkbox mb-0" for="refine-item"
                            >Đang giảm giá
                            <span>4</span>
                          </label>
                        </li>
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="refine-item-2"
                            checked
                          />
                          <label class="label-checkbox mb-0" for="refine-item-2"
                            >Mới
                            <span>4</span>
                          </label>
                        </li>
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="refine-item-3"
                          />
                          <label class="label-checkbox mb-0" for="refine-item-3"
                            >Còn hàng
                            <span>4</span>
                          </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="widgets-area widgets-filter mb-9">
                    <h2 class="widgets-title mb-5">Lọc theo giá tiền</h2>
                    <div class="price-filter">
                      <div id="slider-range"></div>
                      <div class="price-slider-amount">
                        <button class="btn btn-primary btn-secondary-hover">
                          Lọc
                        </button>
                        <div class="label-input position-relative">
                          <label>Giá : </label>
                          <input
                            type="text"
                            id="amount"
                            name="price"
                            placeholder="Nhập giá mong muốn"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="widgets-area mb-9">
                    <h2 class="widgets-title mb-5">Trọng Lượng</h2>
                    <div class="widgets-item">
                      <ul class="widgets-checkbox">
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="size-selection-1"
                          />
                          <label
                            class="label-checkbox mb-0"
                            for="size-selection-1"
                            >50 Gram</label
                          >
                        </li>
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="size-selection-2"
                            checked
                          />
                          <label
                            class="label-checkbox mb-0"
                            for="size-selection-2"
                            >100 Gram</label
                          >
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="widgets-area">
                    <h2 class="widgets-title mb-5">Thẻ</h2>
                    <div class="widgets-item">
                      <ul class="widgets-tags">
                        <li>
                          <a href="javascript:void(0)">Sầu riêng</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Mít</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Chuối</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Xoài</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Thanh long</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Dứa</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Đào</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Kiwi</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Măng cụt</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Sữa chua</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Mix</a>
                        </li>
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
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
      <!-- Main Content Area End Here -->

      <script>
// Fetch product data from the API
function fetchProducts() {
  const token = localStorage.getItem('token');
  fetch('http://127.0.0.1:8000/api/product', {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  })
  .then(response => {
        if (!response.ok) {
          console.log('lỗi');
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
  .then(data => {
      console.log('Dữ liệu trả về từ backend:', data);
      if (Array.isArray(data) && data.length > 0) {
          let productListHTML = '';
          data.forEach(product => {
              const formattedPrice = product.price.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
              productListHTML += `
                  <div class="product-list-view with-sidebar row">
                      <div class="col-12 pt-6">
                          <div class="product-item">
                              <div class="product-img img-zoom-effect">
                                  <a href="/shop/${product.id}">
                                      <img class="img-full" src="${product.thumbnail}" alt="${product.name}" />
                                  </a>
                                  <div class="product-add-action">
                                      <ul>
                                          <li>
                                              <a href="/cart">
                                                  <i class="pe-7s-cart"></i>
                                              </a>
                                          </li>
                                          <li>
                                              <a href="/wishlist">
                                                  <i class="pe-7s-like"></i>
                                              </a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="product-content align-self-center">
                                  <a class="product-name pb-2" href="/shop/${product.id}"><b>${product.name}</b></a>
                                  <div class="price-box pb-1">
                                      <span class="new-price"><b>Giá tiền:</b> ${product.price} VNĐ</span>
                                  </div>
                                  <p class="short-desc mb-0"><b>Mô tả:</b> ${product.description}</p>
                              </div>
                          </div>
                      </div>
                  </div>
              `;
          });

          document.getElementById('product-list').innerHTML = productListHTML;
      } else {
          document.getElementById('product-list').innerHTML = "<p>No products found</p>";
      }
  })
  .catch(error => console.error('Error fetching products:', error));
} // Missing closing bracket added here

document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM fully loaded and parsed. Calling fetchProducts...");
    fetchProducts();
});
</script>


@include('layouts.footer')
