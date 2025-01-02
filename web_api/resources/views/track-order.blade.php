<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Order</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #04702c;
            color: #fff;
            text-transform: uppercase;
        }
        tbody tr:hover {
            background-color: #f1f5f9;
        }
        .status {
            font-weight: bold;
            text-transform: capitalize;
        }
        .status-preparing {
            color: orange;
        }
        .status-shipping {
            color: blue;
        }
        .status-delivered {
            color: green;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
        }
        .pagination a.active {
            background-color: #04702c;
            color: #fff;
        }
    </style>
</head>
<body>
    <main>
        <h1>THEO DÕI ĐƠN HÀNG</h1>
        <table>
            <thead>
                <tr>
                    <th>MÃ ĐƠN HÀNG</th>
                    <th>SẢN PHẨM</th>
                    <th>GIÁ</th>
                    <th>NGÀY ĐẶT HÀNG</th>
                    <th>TRẠNG THÁI ĐƠN HÀNG</th>
                </tr>
            </thead>
            <tbody id="order-list">
                <!-- Orders will be loaded dynamically -->
            </tbody>
        </table>
        <div class="pagination" id="pagination">
            <!-- Pagination will be loaded dynamically -->
        </div>
    </main>

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
        console.log(response); // Kiểm tra response
        if (!response.ok) {
            throw new Error('Failed to fetch orders');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Kiểm tra dữ liệu trả về
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
                            <td>${order.product_name || 'N/A'}</td>
                            <td>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(order.total_price)}</td>
                            <td>${new Date(order.created_at).toLocaleDateString()}</td>
                            <td class="status ${statusClass}">${order.status}</td>
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
    </script>
</body>
</html>
