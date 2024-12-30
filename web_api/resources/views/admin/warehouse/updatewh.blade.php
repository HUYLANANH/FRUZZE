@include('layouts.admin')

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
  <div class="container my-5">
    <h2 class="text-center mb-4">Cập nhật số lượng sản phẩm</h2>
    <form id="update-quantity-form" class="w-50 mx-auto">
      <div class="form-group mb-3">
        <label for="product-id">ID Sản phẩm</label>
        <input type="text" id="product-id" class="form-control" disabled>
      </div>
      <div class="form-group mb-3">
        <label for="product-quantity">Số lượng</label>
        <input type="number" id="product-quantity" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
  </div>
</div>
</main>

<script>
// Extract product ID from URL
function getProductIdFromUrl() {
  const urlPath = window.location.pathname;
  const segments = urlPath.split('/');
  return segments[segments.length - 1];
}

// Update product quantity
function updateProductQuantity() {
  const token = localStorage.getItem('token');
  const quantity = document.getElementById('product-quantity').value;
  const productId = document.getElementById('product-id').value;

  fetch(`http://127.0.0.1:8000/api/warehouse/${productId}`, {
    method: 'PATCH',
    headers: {
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ quantity })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Lỗi khi cập nhật số lượng: ' + response.status);
    }
    alert('Cập nhật thành công!');
    window.location.href = '/warehouse/show';
  })
  .catch(error => console.error('Lỗi:', error));
}

// Handle form initialization
const productId = getProductIdFromUrl();
document.getElementById('product-id').value = productId;

// Attach event listener
document.getElementById('update-quantity-form').addEventListener('submit', function(event) {
  event.preventDefault();
  updateProductQuantity();
});
</script>
