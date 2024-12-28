@include('layouts.admin')

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
    <div class="container my-5">
      <h2 class="text-center mb-4">Bảng điều khiển Admin</h2>

      <div class="row">
        <div class="col-md-4">
          <div class="card card-stat">
            <div class="stat-label">Đơn hàng mới</div>
            <div class="stat-value" id="new-orders">0</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-stat">
            <div class="stat-label">Đơn hàng đang xử lý</div>
            <div class="stat-value" id="processing-orders">0</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-stat">
            <div class="stat-label">Đơn hàng hoàn thành</div>
            <div class="stat-value" id="completed-orders">0</div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Biểu đồ trạng thái đơn hàng</div>
            <div class="card-body">
              <canvas id="orderStatusChart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Danh sách đơn hàng mới</div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                  </tr>
                </thead>
                <tbody id="new-orders-table">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
  async function isAdmin() {
    const token = localStorage.getItem('token');
    if (!token) {
      return false;
    }

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

  async function fetchOrderStats() {
    const token = localStorage.getItem('token');
    try {
      const response = await fetch('/api/orders/stats', {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Lỗi khi lấy thống kê đơn hàng:', error);
      return null;
    }
  }

  async function fetchNewOrders() {
    const token = localStorage.getItem('token');
    try {
      const response = await fetch('/api/orders?status=new', {
        headers: {
          'Authorization': `Bearer ${token}`
        }
      });
      const data = await response.json();
      return data;
    } catch (error) {
      console.error('Lỗi khi lấy danh sách đơn hàng mới:', error);
      return null;
    }
  }

  async function renderDashboard() {
    if (await isAdmin()) {
      const orderStats = await fetchOrderStats();
      const newOrders = await fetchNewOrders();

      if (orderStats && newOrders) {
        document.getElementById('new-orders').textContent = orderStats.new_orders;
        document.getElementById('processing-orders').textContent = orderStats.processing_orders;
        document.getElementById('completed-orders').textContent = orderStats.completed_orders;

        const orderStatusChart = new Chart(document.getElementById('orderStatusChart'), {
          type: 'pie',
          data: {
            labels: ['Mới', 'Đang xử lý', 'Hoàn thành'],
            datasets: [{
              data: [orderStats.new_orders, orderStats.processing_orders, orderStats.completed_orders],
              backgroundColor: ['#ff6b6b', '#ffa94d', '#51cf66']
            }]
          }
        });

        const newOrdersTable = document.getElementById('new-orders-table');
        newOrders.forEach(order => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td>${order.id}</td>
            <td>${order.customer_name}</td>
            <td>${order.total_amount} VND</td>
            <td>${order.status}</td>
          `;
          newOrdersTable.appendChild(row);
        });
      }
    } else {
      alert('Bạn không có quyền truy cập trang này. Vui lòng đăng nhập với tài khoản admin.');
      window.location.href = '/admin/login';
    }
  }

  renderDashboard();
</script>