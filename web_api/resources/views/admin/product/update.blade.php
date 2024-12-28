@include('layouts.admin')

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
    <div class="container my-5">
      <h2 class="text-center mb-4">Sửa Sản Phẩm</h2>

      <form id="product-form">
        <div class="mb-3">
          <label for="productName" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="productName" required>
        </div>

        <div class="mb-3">
          <label for="productCategory" class="form-label">Danh mục</label>
          <input type="text" class="form-control" id="productCategory" required>
        </div>

        <div class="mb-3">
          <label for="productPrice" class="form-label">Giá</label>
          <input type="number" class="form-control" id="productPrice" required>
        </div>

        <div class="mb-3">
          <label for="productWeight" class="form-label">Trọng lượng (Gram)</label>
          <input type="number" class="form-control" id="productWeight" required>
        </div>

        <div class="mb-3">
          <label for="productThumbnail" class="form-label">Hình ảnh</label>
          <input type="file" class="form-control" id="productThumbnail" accept="image/*">
        </div>

        <input type="hidden" id="productId">
        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
      </form>
    </div>
  </main>
</div>

<script>
  // Lấy thông tin sản phẩm cần sửa từ URL
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('id');

  // Lấy thông tin sản phẩm từ API và hiển thị lên form
  fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
    headers: {
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  })
  .then(response => response.json())
  .then(data => {
    document.getElementById('productName').value = data.name;
    document.getElementById('productCategory').value = data.category_id;
    document.getElementById('productPrice').value = data.price;
    document.getElementById('productWeight').value = data.weight;
    document.getElementById('productId').value = data.id;
  })
  .catch(error => console.error('Lỗi:', error));

  // Xử lý form sửa sản phẩm
  document.getElementById('product-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const token = localStorage.getItem('token');
    const formData = new FormData();
    formData.append('name', document.getElementById('productName').value);
    formData.append('category_id', document.getElementById('productCategory').value);
    formData.append('price', document.getElementById('productPrice').value);
    formData.append('weight', document.getElementById('productWeight').value);
    formData.append('thumbnail', document.getElementById('productThumbnail').files[0]);

    fetch(`http://127.0.0.1:8000/api/product/${document.getElementById('productId').value}`, {
      method: 'PATCH',
      headers: {
        'Authorization': `Bearer ${token}`
      },
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Lỗi khi sửa sản phẩm: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      alert('Sản phẩm đã được sửa thành công!');
      window.location.href = '/product/get'; // Điều hướng đến trang danh sách sản phẩm
    })
    .catch(error => console.error('Lỗi:', error));
  });
</script>
