@include('layouts.admin')
<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
    <div class="container my-5">
      <h2 class="text-center mb-4">Cập nhật số lượng sản phẩm</h2>

      <form id="update-warehouse-form">
        <div class="mb-3">
          <label for="product_id" class="form-label">ID Sản phẩm</label>
          <input type="text" class="form-control" id="product_id" name="product_id" readonly>
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="name" name="name" readonly>
        </div>
        <div class="mb-3">
          <label for="quantity" class="form-label">Số lượng tồn kho</label>
          <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
      </form>
    </div>
  </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('product_id');

  if (!productId) {
    alert('Không tìm thấy ID sản phẩm.');
    window.location.href = '/warehouse/show'; // Quay về trang quản lý kho
  }

  // Fetch product details
  const token = localStorage.getItem('token');
  fetch(`http://127.0.0.1:8000/api/warehouse/${productId}`, {
    method: 'GET',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    }
  })
    .then(response => {
      if (!response.ok) {
        throw new Error('Lỗi khi lấy thông tin sản phẩm: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      document.getElementById('product_id').value = data.product_id;
      document.getElementById('name').value = data.name;
      document.getElementById('quantity').value = data.quantity;
    })
    .catch(error => {
      console.error('Lỗi:', error);
      alert('Không thể tải thông tin sản phẩm.');
      window.location.href = '/warehouse/show'; // Quay về trang quản lý kho
    });

  // Handle update form submission
  document.getElementById('update-warehouse-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const updatedQuantity = document.getElementById('quantity').value;

    fetch(`http://127.0.0.1:8000/api/warehouse/${productId}`, {
      method: 'PUT',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ quantity: parseInt(updatedQuantity) })
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Lỗi khi cập nhật số lượng: ' + response.status);
        }
        alert('Cập nhật số lượng thành công!');
        window.location.href = '/warehouse/show'; // Quay về trang quản lý kho
      })
      .catch(error => {
        console.error('Lỗi:', error);
        alert('Đã xảy ra lỗi khi cập nhật số lượng.');
      });
  });
});
</script>
@include('layouts.endadmin')
