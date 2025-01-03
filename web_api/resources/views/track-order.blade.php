@include('layouts.header')
<style>
    /* Container cho pagination */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

/* Các link trang */
.pagination a {
    margin: 0 5px;
    padding: 8px 12px;
    font-size: 14px;
    text-decoration: none;
    color: #333;
    border: 1px solid #ddd;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
}

/* Hover effect cho các trang */
.pagination a:hover {
    background-color: #bac34e;
    color: white;
}

/* Trang hiện tại */
.pagination a.active {
    background-color: #bac34e;
    color: white;
    font-weight: bold;
}

/* Arrow buttons */
.pagination a:hover {
    background-color: #bac34e;
    color: white;
}

.pagination a:focus {
    outline: none;
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    border-radius: 8px;
}

.close-button {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-button:hover,
.close-button:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

</style>
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
                  <h2 class="breadcrumb-heading">TÀI KHOẢN CỦA TÔI</h2>
                  <ul>
                    <li>
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
                    </li>
                    <li>Tài Khoản Của Tôi</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="account-page-area section-space-y-axis-100">
          <div class="container">
            <div class="row">
              <div class="col-lg-3">
                <ul
                  class="nav myaccount-tab-trigger"
                  id="account-page-tab"
                  role="tablist"
                >
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="account-dashboard-tab"
                      data-bs-toggle="tab"
                      href="#account-dashboard"
                      role="tab"
                      aria-controls="account-dashboard"
                      aria-selected="true"
                      >Bảng Điều Khiển</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="account-orders-tab"
                      data-bs-toggle="tab"
                      href="#account-orders"
                      role="tab"
                      aria-controls="account-orders"
                      aria-selected="false"
                      >Đơn Hàng</a
                    >
                  </li>
                  <li class="nav-item">
                    <a
                        class="nav-link"
                        id="account-logout-tab"
                        href="javascript:void(0);"
                        role="tab"
                        aria-selected="false"
                        onclick="logout()"
                    >
                        Đăng Xuất
                    </a>
                </li>
                </ul>
              </div>
              <div class="col-lg-9">
                <div
                  class="tab-content myaccount-tab-content"
                  id="account-page-tab-content"
                >
                  <div
                    class="tab-pane fade show active"
                    id="account-dashboard"
                    role="tabpanel"
                    aria-labelledby="account-dashboard-tab"
                  >
                    <div class="myaccount-dashboard">
                      <p>
                        Xin Chào ! 
                      </p>
                      <p>
                        Từ bảng điều khiển tài khoản của bạn, bạn có thể xem các
                        đơn hàng gần đây,
                        <a href="/change-password"
                          >chỉnh sửa mật khẩu <a href="/profile"
                          > và thông tin tài khoản của bạn</a
                        >.
                      </p>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="account-orders"
                    role="tabpanel"
                    aria-labelledby="account-orders-tab"
                  >
                    <div class="myaccount-orders">
                      <h4 class="small-title">ĐƠN HÀNG CỦA TÔI</h4>
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>MÃ ĐƠN HÀNG</th>
                              <th>NGÀY</th>
                              <th>TRẠNG THÁI</th>
                              <th>TỔNG CỘNG</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody id="order-list">
                <!-- Orders will be loaded dynamically -->
                          </tbody>
                        </table>
                      </div>
                      <div class="pagination" id="pagination">
                        <!-- Pagination will be loaded dynamically -->
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<div id="orderDetailModal" class="modal">
  <div class="modal-content">
    <span class="close-button">&times;</span>
    <h4>Chi Tiết Đơn Hàng</h4>
    <div id="order-detail-content">
      <!-- Chi tiết đơn hàng sẽ được hiển thị tại đây -->
    </div>
    
    <div class="modal-footer">
      <button id="completeOrderButton" class="btn btn-success" style="display: none;">Xác nhận đã nhận đơn</button>
      <button id="cancelOrderButton" class="btn btn-danger" style="display: none;">Hủy đơn</button>
    </div>
  </div>
</div>
      </main>
      <!-- Main Content Area End Here -->

<script>
let currentPage = 1;

function loadOrders(page = 1) {
    currentPage = page;
    fetch(`http://127.0.0.1:8000/api/my-order?page=${page}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch orders');
        }
        return response.json();
    })
    .then(data => {
        renderOrderList(data.data);
        renderPagination(data);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Không thể tải danh sách đơn hàng. Vui lòng thử lại sau.');
    });
}

function renderOrderList(orders) {
    const orderList = document.getElementById('order-list');
    orderList.innerHTML = '';

    if (orders && orders.length > 0) {
        orders.forEach(order => {
            const statusClass = `status-${order.status.replace(/\s+/g, '-').toLowerCase()}`;
            const row = `
                <tr>
                    <td>${order.id}</td>
                    <td>${new Date(order.created_at).toLocaleDateString()}</td>
                    <td class="status ${statusClass}">${order.status}</td>
                    <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(order.total_price)}</td>
                    <td>
                      <a
                        href="javascript:void(0)"
                        class="btn btn-secondary btn-primary-hover"
                        onclick="viewOrderDetail(${order.id})"
                      >
                        <span>Xem</span>
                      </a>
                    </td>
                </tr>
            `;
            orderList.innerHTML += row;
        });
    } else {
        orderList.innerHTML = '<tr><td colspan="5">No orders found</td></tr>';
    }
}

function renderPagination(data) {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';

    if (data.prev_page_url) {
        pagination.innerHTML += `<a href="#" onclick="loadOrders(${currentPage - 1})">&laquo;</a>`;
    }

    for (let i = 1; i <= data.last_page; i++) {
        pagination.innerHTML += `<a href="#" class="${i === currentPage ? 'active' : ''}" onclick="loadOrders(${i})">${i}</a>`;
    }

    if (data.next_page_url) {
        pagination.innerHTML += `<a href="#" onclick="loadOrders(${currentPage + 1})">&raquo;</a>`;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    loadOrders();
});

function viewOrderDetail(orderId) {
    const token = localStorage.getItem('token');
    if (!token) {
        alert('Vui lòng đăng nhập để xem chi tiết đơn hàng.');
        return;
    }

    fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Failed to fetch order details');
        }
        return response.json();
    })
    .then(data => {
        showOrderDetailModal(data);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Không thể tải chi tiết đơn hàng. Vui lòng thử lại sau.');
    });
}

function showOrderDetailModal(orderData) {
    const modal = document.getElementById('orderDetailModal');
    const closeButton = document.querySelector('.close-button');
    const content = document.getElementById('order-detail-content');
    const completeOrderButton = document.getElementById('completeOrderButton');
    const cancelOrderButton = document.getElementById('cancelOrderButton');

    // Reset lại sự kiện trước khi thêm mới
    completeOrderButton.replaceWith(completeOrderButton.cloneNode(true));
    cancelOrderButton.replaceWith(cancelOrderButton.cloneNode(true));

    const updatedConfirmOrderBtn = document.getElementById('completeOrderButton');
    const updatedCancelOrderBtn = document.getElementById('cancelOrderButton');

    // Tính tổng tiền trước khi giảm giá
    let orderTotal = 0;
    let productDetailsHTML = '';
    orderData.order_details.forEach(item => {
        const itemTotalPrice = parseFloat(item.price) * item.quantity;
        orderTotal += itemTotalPrice;

        productDetailsHTML += ` 
            <tr>
                <td>${item.product_name}</td>
                <td>${item.quantity}</td>
                <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(parseFloat(item.price))}</td>
                <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(itemTotalPrice)}</td>
            </tr>
        `;
    });

    const discount = 0.10;
    const discountAmount = orderTotal * discount;
    const totalAfterDiscount = orderTotal - discountAmount;

    content.innerHTML = `
        <div>
            <h5>Hóa Đơn #${orderData.id}</h5>
            <p><strong>Ngày đặt hàng:</strong> ${new Date(orderData.created_at).toLocaleDateString()}</p>
            <p><strong>Trạng thái:</strong> ${orderData.status}</p>
            <p><strong>Địa chỉ giao hàng:</strong> ${orderData.address_ship}</p>
            <p><strong>Phương thức thanh toán:</strong> ${orderData.payment_method === 1 ? 'Tiền mặt' : 'Thẻ'}</p>
            <h6>Chi Tiết Sản Phẩm:</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tạm tính</th>
                    </tr>
                </thead>
                <tbody>
                    ${productDetailsHTML}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Tổng cộng</strong></td>
                        <td><strong>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(orderTotal)}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Giảm giá (10%)</strong></td>
                        <td><strong>- ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(discountAmount)}</strong></td>
                    </tr>
                    <tr>
                        <td colspan="3"><strong>Tổng tiền</strong></td>
                        <td><strong>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(totalAfterDiscount)}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    `;

    // Hiển thị nút hủy đơn cho tất cả trạng thái trừ đã hủy
    if (orderData.status !== 'Đã hủy' && orderData.status !== 'Hoàn tất' && orderData.status !== 'Đang vận chuyển') {
      updatedCancelOrderBtn.style.display = 'inline-block';

      updatedCancelOrderBtn.addEventListener('click', function() {
          cancelOrder(orderData.id); // Gọi API hủy đơn
      });
    } else {
        updatedCancelOrderBtn.style.display = 'none';
    }

    // Hiển thị nút "Xác nhận đã nhận đơn" chỉ khi trạng thái là "Đang vận chuyển"
    if (orderData.status === "Đang vận chuyển") {
        updatedConfirmOrderBtn.style.display = 'inline-block';
        
        updatedConfirmOrderBtn.addEventListener('click', function() {
            completeOrder(orderData.id); // Gọi API hoàn tất đơn
        });
    } else {
        updatedConfirmOrderBtn.style.display = 'none';
    }

    modal.style.display = 'block';

    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });
}

// Function to mark the order as "Hoàn tất"
function completeOrder(orderId) {
    const token = localStorage.getItem('token');
    if (!token) {
        alert('Vui lòng đăng nhập để xác nhận đơn hàng.');
        return;
    }

    console.log('Completing order for ID:', orderId);
    fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({
            status: 'Hoàn tất'
        }),
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                console.error('Error response:', err);
                throw new Error('Failed to complete the order');
            });
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);
        document.getElementById('orderDetailModal').style.display = 'none';
        loadOrders(currentPage); // Reload orders to reflect status change
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Không thể cập nhật trạng thái đơn hàng. Vui lòng thử lại sau.');
    });
}

// Function to mark the order as "Đã hủy"
function cancelOrder(orderId) {
    const token = localStorage.getItem('token');
    if (!token) {
        alert('Vui lòng đăng nhập để hủy đơn hàng.');
        return;
    }

    console.log('Cancelling order for ID:', orderId);
    fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({
            status: "Đã hủy"
        }),
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                console.error('Error response:', err);
                throw new Error('Failed to cancel the order');
            });
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);
        document.getElementById('orderDetailModal').style.display = 'none';
        loadOrders(currentPage); // Reload orders to reflect status change
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Không thể cập nhật trạng thái đơn hàng. Vui lòng thử lại sau.');
    });
}

function logout() {
    // Xóa token khỏi localStorage
    localStorage.removeItem('token');

    // Chuyển hướng về trang chủ hoặc trang đăng nhập
    window.location.href = '/login'; // Hoặc bạn có thể thay đổi đường dẫn này tùy thuộc vào nhu cầu của mình
}


</script>
@include('layouts.footer')
