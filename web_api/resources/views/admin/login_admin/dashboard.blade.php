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
            display: flex;
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
            width: 100%;
            margin-top: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
            height: auto;
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
                <h3>Khách Hàng</h3>
                <p id="total-customers">0</p>
            </div>
            <div class="stat-card">
                <h3>Đơn Hàng Thành Công</h3>
                <p id="completed-orders">0</p>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="orderChart"></canvas>
        </div>
    </main>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        loadDashboardStats();
    });

    function loadDashboardStats() {
        fetch('http://127.0.0.1:8000/api/dashboard/stats', {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch dashboard stats');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('total-orders').innerText = data.total_orders || 0;
            document.getElementById('total-revenue').innerText = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.total_revenue || 0);
            document.getElementById('total-customers').innerText = data.total_customers || 0;
            document.getElementById('completed-orders').innerText = data.completed_orders || 0;

            renderOrderChart(data.order_stats);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load dashboard stats. Please try again later.');
        });
    }

    function renderOrderChart(orderStats) {
        const ctx = document.getElementById('orderChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: orderStats.map(stat => stat.date),
                datasets: [{
                    label: 'Đơn Hàng Mỗi Ngày',
                    data: orderStats.map(stat => stat.order_count),
                    backgroundColor: 'rgba(4, 112, 44, 0.2)',
                    borderColor: 'rgba(4, 112, 44, 1)',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                }
            }
        });
    }
</script>
