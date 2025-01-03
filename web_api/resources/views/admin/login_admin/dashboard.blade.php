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

        .dashboard-title {
            font-size: 32px;
            font-weight: bold;
            color: #04702c;
            margin-bottom: 20px;
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
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #04702c;
        }

        .chart-container {
            width: 20%;
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dashboard-title {
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

        .top-users-table {
            width: 100%;
            margin-top: 30px;
            background-color: #fff;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .top-users-table th, .top-users-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .top-users-table th {
            background-color: #04702c;
            color: #fff;
            font-weight: bold;
        }

        .top-users-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <main>
        <h1 class="dashboard-title">Dashboard Thống Kê</h1>

        <div class="stat-grid">
            <div class="stat-card">
                <h3>Tổng Đơn Hàng</h3>
                <p id="total-orders">0</p>
            </div>
            <div class="stat-card">
                <h3>Tổng Doanh Thu</h3>
                <p id="total-revenue">0 VND</p>
            </div>
            <div class="stat-card">
                <h3>Doanh Thu Hôm Nay</h3>
                <p id="today-revenue">0 VND</p>
            </div>
        </div>

        <div class="chart-container">
            <h3 class="dashboard-title">Biểu Đồ Trạng Thái Đơn Hàng</h3>
            <canvas id="orderStatusChart"></canvas>
        </div>

        <h3 class="dashboard-title">Top 5 Người Chi Tiêu Nhiều Nhất</h3>
        <table class="top-users-table">
            <thead>
                <tr>
                    <th>Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Tổng Chi Tiêu</th>
                    <th>Tổng Số Đơn Hàng</th>
                </tr>
            </thead>
            <tbody id="top-users-body">
                <!-- Dữ liệu sẽ được chèn ở đây -->
            </tbody>
        </table>
    </main>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadDashboardStats();
        loadTopSpendingUsers();
    });

    function loadDashboardStats() {
        const headers = {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        };

        fetch('http://127.0.0.1:8000/api/dashboard/total_revenue', { headers })
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-revenue').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.total_revenue || 0);
            })
            .catch(error => console.error('Failed to fetch total revenue:', error));

        fetch('http://127.0.0.1:8000/api/dashboard/today-revenue', { headers })
            .then(response => response.json())
            .then(data => {
                document.getElementById('today-revenue').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.today_revenue || 0);
            })
            .catch(error => console.error('Failed to fetch today revenue:', error));

        fetch('http://127.0.0.1:8000/api/dashboard/order-status-percentages', { headers })
            .then(response => response.json())
            .then(data => {
                renderOrderStatusChart(data);
            })
            .catch(error => console.error('Failed to fetch order status percentages:', error));

        fetch('http://127.0.0.1:8000/api/dashboard/total-orders', { headers })
            .then(response => response.json())
            .then(data => {
                document.getElementById('total-orders').innerText = data.total_orders || 0;
            })
            .catch(error => console.error('Failed to fetch total orders:', error));
    }

    function loadTopSpendingUsers() {
        const headers = {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        };

        fetch('http://127.0.0.1:8000/api/dashboard/top-5-spending', { headers })
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('top-users-body');
                tbody.innerHTML = '';
                data.forEach(user => {
                    const row = `
                        <tr>
                            <td>${user.full_name}</td>
                            <td>${user.phone_number}</td>
                            <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(user.total_spent)}</td>
                            <td>${user.total_orders}</td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            })
            .catch(error => console.error('Failed to fetch top spending users:', error));
    }

    function renderOrderStatusChart(statusPercentages) {
        const ctx = document.getElementById('orderStatusChart').getContext('2d');
        const labels = Object.keys(statusPercentages);
        const data = Object.values(statusPercentages);

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
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
                                return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@include('layouts.endadmin')
