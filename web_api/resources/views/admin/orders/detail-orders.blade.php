@include('layouts.admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng</title>
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
            padding: 20px;
        }

        .detail-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .detail-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #04702c;
        }

        .detail-item {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .detail-item span {
            font-weight: bold;
            color: #555;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #04702c;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #035c25;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f6f9;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <main>
        <div class="detail-container">
            <h1 class="detail-title">Chi Tiết Đơn Hàng</h1>

            <div class="detail-item">
                <span>Mã đơn hàng:</span> <span id="order-id"></span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody id="order-details"></tbody>
            </table>

            <a href="javascript:history.back()" class="btn-back">Quay lại</a>
        </div>
    </main>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const orderId = window.location.pathname.split('/').pop();

    fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Không thể tải chi tiết đơn hàng');
        }
        return response.json();
    })
    .then(order => {
        // Hiển thị thông tin đơn hàng
        document.getElementById('order-id').textContent = order.id || 'N/A';

        const orderDetails = document.getElementById('order-details');
        if (Array.isArray(order.order_details)) {
            if (order.order_details.length === 0) {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.colSpan = 5;
                emptyCell.textContent = 'Không có sản phẩm nào trong đơn hàng';
                emptyRow.appendChild(emptyCell);
                orderDetails.appendChild(emptyRow);
            } else {
                order.order_details.forEach(detail => {
                    const row = document.createElement('tr');

                    const orderIdCell = document.createElement('td');
                    orderIdCell.textContent = detail.order_id || 'N/A';
                    row.appendChild(orderIdCell);

                    const productNameCell = document.createElement('td');
                    productNameCell.textContent = detail.product_name || 'N/A';
                    row.appendChild(productNameCell);

                    const quantityCell = document.createElement('td');
                    quantityCell.textContent = detail.quantity || 'N/A';
                    row.appendChild(quantityCell);

                    const priceCell = document.createElement('td');
                    priceCell.textContent = detail.price ? new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(detail.price) : 'N/A';
                    row.appendChild(priceCell);

                    const createdAtCell = document.createElement('td');
                    createdAtCell.textContent = detail.created_at ? new Date(detail.created_at).toLocaleDateString() : 'N/A';
                    row.appendChild(createdAtCell);

                    orderDetails.appendChild(row);
                });
            }
        } else {
            console.error('Dữ liệu chi tiết đơn hàng không hợp lệ');
            const errorRow = document.createElement('tr');
            const errorCell = document.createElement('td');
            errorCell.colSpan = 5;
            errorCell.textContent = 'Lỗi: Dữ liệu chi tiết đơn hàng không hợp lệ';
            errorRow.appendChild(errorCell);
            orderDetails.appendChild(errorRow);
        }
    })
    .catch(error => {
        console.error('Lỗi:', error);
        alert('Không thể tải chi tiết đơn hàng. Vui lòng thử lại sau.');
    });
});


    </script>
</body>
</html>
