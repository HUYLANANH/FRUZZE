@include('layouts.admin')

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
  <div class="container my-5">
    <h2 class="text-center mb-4">Thêm Sản Phẩm Mới</h2>

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
  <input type="file" class="form-control" id="productThumbnail" accept="image/*" required>
    </div>
      <button type="submit" class="btn btn-success">Tạo sản phẩm</button>
    </form>
  </div>
</div>
</main>

<script>
// Thêm hàm xác thực quyền
async function isAdmin() {
    const token = localStorage.getItem('token');
    if (!token) {
      return false;
    }

    // Gửi request lên server để xác thực quyền
    try {
      const response = await fetch('/api/auth/check-admin', {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
      const data = await response.json();
      return data.is_admin;
    } catch (error) {
      console.error('Lỗi khi xác thực quyền:', error);
      return false;
    }
  }

  document.getElementById('product-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    if (await isAdmin()) {
      const token = localStorage.getItem('token');
      const formData = new FormData();
      formData.append('name', document.getElementById('productName').value);
      formData.append('category_id', document.getElementById('productCategory').value);
      formData.append('price', document.getElementById('productPrice').value);
      formData.append('weight', document.getElementById('productWeight').value);
      formData.append('thumbnail', document.getElementById('productThumbnail').files[0]);

      fetch('http://127.0.0.1:8000/api/product', {
        method: 'POST',
        headers: {
          'Authorization': `Bearer ${token}`
        },
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          if (response.status === 403) { // Lỗi phân quyền
            alert('Bạn không có quyền thực hiện thao tác này. Vui lòng đăng nhập lại.');
            window.location.href = '/admin/login'; // Điều hướng đến trang đăng nhập
          } else {
            throw new Error('Lỗi khi tạo sản phẩm: ' + response.status);
          }
        }
        return response.json();
      })
      .then(data => {
        alert('Sản phẩm đã được tạo thành công!');
        window.location.href = '/product/get'; // Điều hướng đến trang danh sách sản phẩm
      })
      .catch(error => console.error('Lỗi:', error));
    } else {
      alert('Bạn không có quyền thực hiện thao tác này. Vui lòng đăng nhập với tài khoản admin.');
      window.location.href = '/admin/login'; // Điều hướng đến trang đăng nhập
    }
  });

</script>