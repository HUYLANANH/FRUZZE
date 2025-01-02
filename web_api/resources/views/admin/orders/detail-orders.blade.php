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
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .widgets-title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            color: rgb(4, 46, 27);
            margin-bottom: 20px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }

        thead th {
            background-color: #04702c;
            color: #fff;
            padding: 12px;
            text-transform: uppercase;
        }

        tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        th,
        td {
            text-align: center;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            color: #fff;
            background-color: #04702c;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #035b1f;
        }

        a {
            color: #04702c;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <div class="flex flex-col items-center justify-start gap-6 p-6">
            <h1 class="widgets-title">CHI TIẾT ĐƠN HÀNG</h1>

            <div class="w-full rounded-lg border border-gray-300 bg-white shadow-xl p-6">
                <div class="w-full overflow-x-auto">
                    <table class="w-full table-auto text-sm text-center">
                        <thead>
                            <tr>
                                <th>Mã Chi Tiết</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody id="detail-order-list">
                            <!-- Dữ liệu sẽ được load từ API -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Load order details dynamically from API
        function loadOrderDetails(orderId) {
    fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
        method: 'GET',
        headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
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
        if (!data || !data.orderDetails || data.orderDetails.length === 0) {
            document.getElementById('detail-order-list').innerHTML = '<tr><td colspan="6" class="text-center">Không có chi tiết nào</td></tr>';
            return;
        }
        renderOrderDetails(data.orderDetails);
    })
    .catch(error => {
    console.error('Error:', error);
    document.getElementById('detail-order-list').innerHTML = '<tr><td colspan="6" class="text-center">Không tìm thấy đơn hàng</td></tr>';
});

}

        function renderOrderDetails(details) {
            const detailOrderList = document.getElementById('detail-order-list');
            detailOrderList.innerHTML = '';

            if (details && details.length > 0) {
                details.forEach(detail => {
                    const row = `
                        <tr class="border border-gray-300 text-center">
                            <td class="border border-gray-300 px-6 py-4">${detail.id}</td>
                            <td class="border border-gray-300 px-6 py-4">
                                <a href="/orders/${detail.order_id}/details">${detail.order_id}</a>
                            </td>
                            <td class="border border-gray-300 px-6 py-4">${detail.product_name}</td>
                            <td class="border border-gray-300 px-6 py-4">${detail.quantity}</td>
                            <td class="border border-gray-300 px-6 py-4">
                                ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(detail.price)}
                            </td>
                            <td class="border border-gray-300 px-6 py-4">
                                <button class="btn" onclick="viewInvoice(${detail.id})">Xem Hóa Đơn</button>
                            </td>
                        </tr>
                    `;
                    detailOrderList.innerHTML += row;
                });
            } else {
                detailOrderList.innerHTML = '<tr><td colspan="6" class="text-center">Không có chi tiết nào</td></tr>';
            }
        }

        function viewInvoice(detailId) {
            alert(`Xem hóa đơn cho chi tiết ID: ${detailId}`);
            // Implement your logic to view the invoice here
        }

        document.addEventListener('DOMContentLoaded', function() {
            const orderId = 1; // Replace with dynamic order ID if needed
            loadOrderDetails(orderId);
        });
    </script>
</body>
</html>
@include('layouts.endadmin')
