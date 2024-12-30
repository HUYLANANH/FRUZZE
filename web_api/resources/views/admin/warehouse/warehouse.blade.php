@include('layouts.admin')
<link rel="stylesheet" href="/assets/css/show.css">

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
  <div class="container my-5">
    <h2 class="text-center mb-4">Quản lý kho hàng</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID sản phẩm</th>
          <th>Tên sản phẩm</th>
          <th>Danh mục</th>
          <th>Số lượng tồn kho</th>
        </tr>
      </thead>
      <tbody id="warehouse-list">
        <!-- Danh sách kho hàng sẽ được render tại đây -->
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
let currentWarehousePage = 1;

// Fetch warehouse data from the API
function fetchWarehouseItems(page = 1) {
  currentWarehousePage = page;
  const token = localStorage.getItem('token');

  fetch(`http://127.0.0.1:8000/api/warehouse?page=${page}`, {
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
    renderWarehouseList(data.data);
    renderWarehousePagination(data);
  })
  .catch(error => console.error('Lỗi:', error));
}

// Render warehouse list
function renderWarehouseList(items) {
  const warehouseList = document.getElementById('warehouse-list');
  warehouseList.innerHTML = '';
  if (items && items.length > 0) {
    items.forEach(item => {
      const warehouseRow = `
        <tr>
          <td>${item.product_id}</td>
          <td>${item.product_name}</td>
          <td>${item.category_name}</td>
          <td>${item.quantity}</td>
          <td>
            <button class="btn btn-primary btn-sm" onclick="editWarehouseItem(${item.product_id})">Cập nhật</button>
          </td>
        </tr>
      `;
      warehouseList.innerHTML += warehouseRow;
    });
  } else {
    warehouseList.innerHTML = '<tr><td colspan="6" class="text-center">Không có mặt hàng nào trong kho</td></tr>';
  }
}

// Render pagination
function renderWarehousePagination(data) {
  const pagination = document.querySelector('.pagination');
  pagination.innerHTML = '';

  if (data.prev_page_url) {
    pagination.innerHTML += `
      <li class="page-item">
        <a class="page-link" href="javascript:void(0)" onclick="fetchWarehouseItems(${currentWarehousePage - 1})">&laquo;</a>
      </li>
    `;
  }

  for (let i = 1; i <= data.last_page; i++) {
    pagination.innerHTML += `
      <li class="page-item ${i === currentWarehousePage ? 'active' : ''}">
        <a class="page-link" href="javascript:void(0)" onclick="fetchWarehouseItems(${i})">${i}</a>
      </li>
    `;
  }

  if (data.next_page_url) {
    pagination.innerHTML += `
      <li class="page-item">
        <a class="page-link" href="javascript:void(0)" onclick="fetchWarehouseItems(${currentWarehousePage + 1})">&raquo;</a>
      </li>
    `;
  }
}

// Edit warehouse item
function editWarehouseItem(itemId) {
  window.location.href = `/warehouse/update/${itemId}`; // Đường dẫn đến trang cập nhật kho hàng
}

// Fetch warehouse items on page load
document.addEventListener('DOMContentLoaded', function() {
  fetchWarehouseItems();
});
</script>
@include('layouts.endadmin')
