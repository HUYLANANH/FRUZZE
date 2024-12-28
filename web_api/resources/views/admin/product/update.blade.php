@include('layouts.admin')

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
    <div class="container my-5">
      <h2 class="text-center mb-4">Sửa Sản Phẩm</h2>

      <form id="product-form">
        <div class="mb-3">
          <label for="productName" class="form-label">Tên sản phẩm</label>
          <input type="text" class="form-control" id="productName" placeholder="Loading..." required>
        </div>

        <div class="mb-3">
          <label for="productCategory" class="form-label">Danh mục</label>
          <input type="text" class="form-control" id="productCategory" placeholder="Loading..." required>
        </div>

        <div class="mb-3">
          <label for="productPrice" class="form-label">Giá</label>
          <input type="number" class="form-control" id="productPrice" placeholder="Loading..." required>
        </div>

        <div class="mb-3">
          <label for="productWeight" class="form-label">Trọng lượng (Gram)</label>
          <input type="number" class="form-control" id="productWeight" placeholder="Loading..." required>
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
  const pathArray = window.location.pathname.split('/');
  const productId = pathArray[pathArray.length - 1];
console.log(productId);
  // Lấy thông tin sản phẩm từ API và hiển thị placeholder
  fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
    headers: {
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    }
  })
  .then(response => response.json())
  .then(data => {
    console.log(data.name);
    document.getElementById('productName').placeholder = data.name;
    document.getElementById('productCategory').placeholder = data.category_id; // Nếu muốn hiển thị tên danh mục, cần thay đổi API trả về
    document.getElementById('productPrice').placeholder = data.price;
    document.getElementById('productWeight').placeholder = data.weight;
    document.getElementById('productId').value = data.id;
  })
  .catch(error => console.error('Lỗi:', error));

  // Xử lý form sửa sản phẩm
  document.getElementById('product-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const token = localStorage.getItem('token');
    console.log("toekn",token);
    const formData = new FormData();
    formData.append('name', document.getElementById('productName').value);
    formData.append('category_id', document.getElementById('productCategory').value);
    formData.append('price', document.getElementById('productPrice').value);
    formData.append('weight', document.getElementById('productWeight').value);

    const productId = document.getElementById('productId').value; // Đảm bảo bạn lấy đúng productId

    fetch(`http://127.0.0.1:8000/api/product/${productId}`, {
      method: 'PATCH',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        name: document.getElementById('productName').value,
        category_id: document.getElementById('productCategory').value,
        price: document.getElementById('productPrice').value,
        weight: document.getElementById('productWeight').value
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
