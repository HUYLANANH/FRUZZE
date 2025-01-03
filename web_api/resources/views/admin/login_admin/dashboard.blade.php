@include('layouts.admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Thống Kê</title>
<style>
    body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f6f9;
    color: #333;
}

main {
    margin-left: 200px; 
    flex-direction: column;
    align-items: center;
    padding: 20px;
}
.dashboard-header {
    display: flex;
    gap: 20px;
    width: 100%;
    justify-content: space-around;
    align-items: center;
}
.dashboard-title {
    font-size: 32px;
    font-weight: bold;
    color: #04702c;
    margin-bottom: 20px;
}
.dropdowns {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    width: 40%;
    font-size: 18px;
}
.dropdown {
    width: 150px;
    padding: 10px;
    background-color: #fff;
    display: flex;
    gap: 10px;
    font-size: 18px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);

}
.stat-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    width: 100%;
}

.stat-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.stat-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.stat-card p {
    font-size: 24px;
    font-weight: bold;
    color: #04702c;
}

.chart-container {
    width: 100%; /* Tăng chiều rộng */
    margin: 20px auto; /* Tạo khoảng cách tự động ở hai bên */
    height: auto; /* Để chiều cao tự động điều chỉnh theo nội dung */
    display: flex;
    margin-left: 0px;
}
.orderStatusChart {
    width: 40%;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.top-users-container {
    width: 60%;
    margin-left: 10px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.dashboard-title-2 {
    font-size: 24px;
    font-weight: bold;
    color: #04702c;
    margin-bottom: 20px;
    text-align: center;
}

.legend-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 20px;
    gap: 10px;
}

.legend-item {
    display: flex;
    align-items: center;
    margin-right: 15px;
}

.legend-item span {
    display: inline-block;
    width: 16px;
    height: 16px;
    margin-right: 5px;
    border-radius: 4px;
}

canvas {
    max-width: 100%;
    height: auto;
}

.top-users-table, .top-products-table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

.top-users-table th, .top-users-table td, .top-products-table th, .top-products-table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.top-users-table th, .top-products-table th {
    background-color: #04702c;
    color: #fff;
    font-weight: bold;
}

.top-users-table tr:hover, .top-products-table tr:hover {
    background-color: #f1f1f1;
}
.top-products-container {
    width: 100%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

</style>

</head>
<body>
    <main>
        <div class="dashboard-header">
            <h1 class="dashboard-title">Dashboard Thống Kê</h1>
            <div class="dropdowns">
                <div class="dropdown">
                    <label for="month-select">Tháng:</label>
                    <select id="month-select">
                        <option value="01" selected>Tháng 1</option>
                        <option value="02">Tháng 2</option>
                        <option value="03">Tháng 3</option>
                        <option value="04">Tháng 4</option>
                        <option value="05">Tháng 5</option>
                        <option value="06">Tháng 6</option>
                        <option value="07">Tháng 7</option>
                        <option value="08">Tháng 8</option>
                        <option value="09">Tháng 9</option>
                        <option value="10">Tháng 10</option>
                        <option value="11">Tháng 11</option>
                        <option value="12">Tháng 12</option>
                    </select>
                </div>
                <div class="dropdown">
                    <label for="year-select">Năm:</label>
                    <select id="year-select">
                        <option value="2024">2024</option>
                        <option value="2025" selected>2025</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="stat-grid">
            <div class="stat-card">
                <h3>Tổng Đơn Hàng Theo Tháng</h3>
                <p id="total-orders">0</p>
            </div>
            <div class="stat-card">
                <h3>Tổng Doanh Thu Theo Tháng</h3>
                <p id="total-revenue">0 VND</p>
            </div>
            <div class="stat-card">
                <h3>Doanh Thu Hôm Nay</h3>
                <p id="today-revenue">0 VND</p>
            </div>
            <div class="stat-card">
                <h3>Tổng Khách Hàng</h3>
                <p id="today-revenue">0 VND</p>
            </div>
        </div>

        <div class="chart-container">
           <div class="orderStatusChart"> <h3 class="dashboard-title-2">Biểu Đồ Trạng Thái Đơn Hàng</h3>
            <canvas id="orderStatusChart"></canvas>
        </div>

        <div class="top-users-container">
            <h3 class="dashboard-title-2">Top 5 Người Chi Tiêu Nhiều Nhất</h3>
            <table class="top-users-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Khách Hàng</th>
                        <th>Số Điện Thoại</th>
                        <th>Tổng Chi Tiêu</th>
                        <th>Tổng Số Đơn Hàng</th>
                    </tr>
                </thead>
                <tbody id="top-users-body">
                    <!-- Data will be populated here -->
                </tbody>
            </table>
        </div>
</div>
<div class="top-products-container">
            <h3 class="dashboard-title-2">Top 5 Sản Phẩm Bán Chạy Nhất</h3>
            <table class="top-products-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng Bán</th>
                        <th>Tồn Kho</th>
                    </tr>
                </thead>
                <tbody id="top-products-body"></tbody>
            </table>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Load initial data with default month and year
        loadDashboardData();
        loadTopSellingProducts();

        // Add event listeners for filtering
        document.getElementById('month-select').addEventListener('change', handleFilterChange);
        document.getElementById('year-select').addEventListener('change', handleFilterChange);
    });

    function handleFilterChange() {
        loadDashboardData();
    }

    function loadDashboardData() {
        const month = document.getElementById('month-select').value;
        const year = document.getElementById('year-select').value;

        loadDashboardStats(month, year);
        loadTopSpendingUsers(month, year);
    }

    function loadDashboardStats(month, year) {
        const headers = {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        };

        fetch(`http://127.0.0.1:8000/api/dashboard/total-revenue?month=${month}&year=${year}`, { headers })
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-revenue').innerText =
                    new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.total_revenue || 0);
            });

        fetch(`http://127.0.0.1:8000/api/dashboard/today-revenue`, { headers })
            .then(response => response.json())
            .then(data => {
                document.getElementById('today-revenue').innerText =
                    new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.today_revenue || 0);
            });

        fetch(`http://127.0.0.1:8000/api/dashboard/order-status-percentages`, { headers })
            .then(response => response.json())
            .then(data => renderOrderStatusChart(data));
    }

    function loadTopSpendingUsers(month, year) {
        const headers = {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        };

        fetch(`http://127.0.0.1:8000/api/dashboard/top-5-spending?month=${month}&year=${year}`, { headers })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('top-users-body');
                tbody.innerHTML = '';
                data.forEach((user, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.full_name}</td>
                            <td>${user.phone_number}</td>
                            <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(user.total_spent)}</td>
                            <td>${user.total_orders}</td>
                        </tr>
                    `;
                });
            });
    }

    let orderStatusChart = null; // Biến toàn cục để lưu trữ biểu đồ

    function renderOrderStatusChart(statusPercentages) {
        const ctx = document.getElementById('orderStatusChart').getContext('2d');
        if (orderStatusChart) {
            orderStatusChart.destroy();
        }
        const labels = Object.keys(statusPercentages);
        const data = Object.values(statusPercentages);

        orderStatusChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(151, 156, 160, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw.toFixed(2)}%`;
                            }
                        }
                    }
                }
            }
        });
    }

    function loadTopSellingProducts() {
    const headers = {
      'Authorization': `Bearer ${localStorage.getItem('token')}`
    };

    fetch('http://127.0.0.1:8000/api/dashboard/top-5-selling?month=${month}&year=${year}', { headers })
      .then(response => response.json())
      .then(data => {
        const tbody = document.getElementById('top-products-body');
        tbody.innerHTML = '';
        data.forEach((product, index) => {
          tbody.innerHTML += `
            <tr>
              <td>${index + 1}</td>
              <td>${product.name}</td>
              <td>${product.price}</td>
              <td>${product.total_sold}</td>
              <td>${product.quantity}</td>
            </tr>
          `;
        });
      })
      .catch(error => {
        console.error('Fetch error:', error);
      });
}

</script>
</body>
</html>
@include('layouts.endadmin')