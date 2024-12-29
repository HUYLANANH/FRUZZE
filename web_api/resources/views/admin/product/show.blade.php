@include('layouts.admin')
<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
  <div class="container my-5">
    <h2 class="text-center mb-4">Quản lý sản phẩm</h2>

    <div class="mb-3">
      <button class="btn btn-success" onclick="addProduct()">Thêm sản phẩm</button>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Hình ảnh</th>
          <th>Tên sản phẩm</th>
          <th>Danh mục</th>
          <th>Giá</th>
          <th>Trọng lượng</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody id="product-list">
        <!-- Danh sách sản phẩm sẽ được render tại đây -->
      </tbody>
    </table>

    <nav>
      <ul class="pagination justify-content-center">
        <!-- Pagination sẽ được render tại đây -->
      </ul>
    </nav>
  </div>
</div>
</main>
<script>
let currentPage = 1;

// Fetch product data from the API
function fetchProducts(page = 1) {
  currentPage = page;
  const token = localStorage.getItem('token');

  fetch(`http://127.0.0.1:8000/api/product?page=${page}`, {
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
    renderProductList(data.data);
    renderPagination(data);
  })
  .catch(error => console.error('Lỗi:', error));
}

// Render product list
function renderProductList(products) {
  const productList = document.getElementById('product-list');
  productList.innerHTML = '';
  if (products && products.length > 0) {
    products.forEach(product => {
      const productRow = `
        <tr>
          <td>${product.id}</td>
          <td><img src="/${product.thumbnail}" alt="${product.name}" style="width: 50px; height: 50px;"></td>
          <td>${product.name}</td>
          <td>${ product.category_name}</td>
          <td>${parseFloat(product.price).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' })}</td>
          <td>${product.weight} Gram</td>
          <td>
            <button class="btn btn-primary btn-sm" onclick="editProduct(${product.id})">Sửa</button>
            <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Xóa</button>
          </td>
        </tr>
      `;
      productList.innerHTML += productRow;
    });
  } else {
    productList.innerHTML = '<tr><td colspan="7" class="text-center">Không có sản phẩm nào</td></tr>';
  }
}

// Render pagination
function renderPagination(data) {
  const pagination = document.querySelector('.pagination');
  pagination.innerHTML = '';

  if (data.prev_page_url) {
    pagination.innerHTML += `
      <li class="page-item">
        <a class="page-link" href="javascript:void(0)" onclick="fetchProducts(${currentPage - 1})">&laquo;</a>
      </li>
    `;
  }

  for (let i = 1; i <= data.last_page; i++) {
    pagination.innerHTML += `
      <li class="page-item ${i === currentPage ? 'active' : ''}">
        <a class="page-link" href="javascript:void(0)" onclick="fetchProducts(${i})">${i}</a>
      </li>
    `;
  }

  if (data.next_page_url) {
    pagination.innerHTML += `
      <li class="page-item">
        <a class="page-link" href="javascript:void(0)" onclick="fetchProducts(${currentPage + 1})">&raquo;</a>
      </li>
    `;
  }
}

// Add product
function addProduct() {
  window.location.href = '/product/add'; // Đường dẫn đến trang tạo sản phẩm
}
// Edit product
function editProduct(productId) {
  window.location.href = `/product/update/${productId}`; // Đường dẫn đến trang sửa sản phẩm
}

// Delete product
function deleteProduct(productId) {
  const confirmDelete = confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');
  if (confirmDelete) {
    const token = localStorage.getItem('token');

    fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
      method: 'DELETE',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Lỗi khi xóa sản phẩm: ' + response.status);
      }
      alert('Xóa sản phẩm thành công');
      fetchProducts(currentPage);
    })
    .catch(error => console.error('Lỗi:', error));
  }
}

// Fetch products on page load
document.addEventListener('DOMContentLoaded', function() {
  fetchProducts();
});
</script>
@include('layouts.endadmin')
