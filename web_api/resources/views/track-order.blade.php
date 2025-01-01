@include('layouts.header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Orders</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            color: #333;
        }

        main {
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            color: #04702c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #04702c;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f5f9;
        }

        .status {
            font-weight: bold;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .status.preparing {
            background-color: #ffc107; /* Màu vàng */
            color: #fff;
        }

        .status.shipping {
            background-color: #17a2b8; /* Màu xanh dương */
            color: #fff;
        }

        .status.delivered {
            background-color: #28a745; /* Màu xanh lá cây */
            color: #fff;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
            transition: 0.3s;
        }

        .pagination a:hover {
            background-color: #04702c;
            color: #fff;
        }

        .pagination .active {
            background-color: #04702c;
            color: #fff;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <main>
        <h1>Theo dõi đơn hàng của bạn</h1>
        <div class="order-container">
            <table>
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Thành tiền</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                    <!-- Nội dung sẽ được load qua API -->
                </tbody>
            </table>
            <div class="pagination" id="pagination">
                <!-- Pagination sẽ được tạo động -->
            </div>
        </div>
    </main>
</body>
</html>
<script>
    let currentPage = 1;

    // Lấy user_id từ Local Storage
    const currentUserId = localStorage.getItem('user_id');

    if (!currentUserId) {
        alert('Vui lòng đăng nhập để xem đơn hàng của bạn.');
        window.location.href = '/login'; // Điều hướng tới trang đăng nhập
    }

    // Load danh sách đơn hàng từ API
    function loadOrders(page = 1) {
        currentPage = page;

        fetch(`http://127.0.0.1:8000/api/orders?page=${page}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`, // Token từ Local Storage
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Không thể tải đơn hàng.');
            }
            return response.json();
        })
        .then(data => {
            const userOrders = data.data.filter(order => order.customer_id == currentUserId); // Lọc đơn hàng theo user_id
            renderOrderList(userOrders); // Hiển thị danh sách đơn hàng
            renderPagination(data);     // Hiển thị phân trang
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Không thể tải danh sách đơn hàng. Vui lòng thử lại sau.');
        });
    }

    // Hiển thị danh sách đơn hàng
    function renderOrderList(orders) {
        const orderList = document.getElementById('order-list');
        orderList.innerHTML = '';

        if (orders.length > 0) {
            orders.forEach(order => {
                const row = `
                    <tr>
                        <td>${order.id}</td>
                        <td>${new Date(order.created_at).toLocaleDateString()}</td>
                        <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(order.total_price)}</td>
                        <td>
                            <span class="status ${order.status.toLowerCase()}">
                                ${order.status}
                            </span>
                        </td>
                        <td>
                            <a href="/order-details/${order.id}" class="text-blue-500 hover:underline">Xem chi tiết</a>
                        </td>
                    </tr>
                `;
                orderList.innerHTML += row;
            });
        } else {
            orderList.innerHTML = '<tr><td colspan="5" class="text-center">Bạn chưa đặt đơn hàng nào.</td></tr>';
        }
    }

    // Hiển thị phân trang
    function renderPagination(data) {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        if (data.prev_page_url) {
            pagination.innerHTML += `
                <a href="javascript:void(0)" onclick="loadOrders(${currentPage - 1})">&laquo;</a>
            `;
        }

        for (let i = 1; i <= data.last_page; i++) {
            pagination.innerHTML += `
                <a href="javascript:void(0)" class="${i === currentPage ? 'active' : ''}" onclick="loadOrders(${i})">${i}</a>
            `;
        }

        if (data.next_page_url) {
            pagination.innerHTML += `
                <a href="javascript:void(0)" onclick="loadOrders(${currentPage + 1})">&raquo;</a>
            `;
        }
    }

    // Tải dữ liệu khi trang được load
    document.addEventListener('DOMContentLoaded', function () {
        loadOrders();
    });
</script>
@include('layouts.footer')
