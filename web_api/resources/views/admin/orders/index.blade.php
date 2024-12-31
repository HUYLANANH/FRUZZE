@include('layouts.admin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Đơn Hàng</title>
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
                table-layout: flex;

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

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .pagination a:hover,
        .pagination span.active {
            background-color: #04702c;
            color: #fff;
            border-color: #04702c;
        }
        .order-status {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        color: #333;
        background-color: #fff;
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        appearance: none;
    }
    .order-status {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        color: #fff; /* Màu chữ trắng */
        background-color: #ccc; /* Màu mặc định */
        width: 100%;
        box-sizing: border-box;
        text-align: center;
        appearance: none;
    }

    /* Màu sắc cho từng trạng thái */
    .order-status option[value="preparing"] {
        background-color:rgb(101, 171, 212); /* Cam - Đang chuẩn bị */
        color: #fff;
    }

    .order-status option[value="shipping"] {
        background-color:rgb(237, 182, 119); /* Xanh da trời - Đang vận chuyển */
        color: #fff;
    }

    .order-status option[value="delivered"] {
        background-color:rgb(111, 210, 111); /* Xanh lá cây - Giao hàng thành công */
        color: #fff;
    }

    /* Thay đổi màu nền dropdown dựa trên giá trị */
    .order-status.preparing {
        background-color:rgb(84, 198, 230);
    }

    .order-status.shipping {
        background-color:rgb(219, 178, 106);
    }

    .order-status.delivered {
        background-color:rgb(106, 206, 106);
    }
    .btn-success {
        background-color:rgb(17, 88, 33); /* Màu xanh lá */
        border-color:rgb(13, 71, 27);
    }

    .btn-warning {
        background-color: #fd7e14; /* Màu cam */
        border-color: #fd7e14;
    }
    .order-status:hover,
    .order-status:focus {
        border-color: #04702c;
        outline: none;
    }
    </style>
</head>
<body>
    <main>
        <div class="flex flex-col items-center justify-start gap-6 p-6">
            <div class="flex items-center justify-between w-full mb-8">
                <div class="text-4xl font-semibold text-gray-800 text-align:center">
                    <h1 class="widgets-title mb-5"> <b>&emsp;&emsp;&emsp;&emsp;DANH SÁCH ĐƠN HÀNG</b> </h1>
                </div>
            </div>

            <div class="w-full rounded-lg border border-gray-300 bg-white shadow-xl p-6">
                <div class="w-full overflow-x-auto">
                    <table class="w-full table-auto text-sm text-center">
                        <thead>
                            <tr>
                                <th>Chọn&emsp;&emsp;</th>
                                <th>Mã đơn hàng&emsp;&emsp;</th>
                                <th>Khách hàng&emsp;&emsp;</th>
                                <th>Thành tiền&emsp;&emsp;</th>
                                <th>Ngày đặt hàng&emsp;&emsp;</th>
                                <th>Hành động&emsp;&emsp;</th>
                                <th>Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody id="order-list">
                            <!-- Dữ liệu sẽ được load từ API -->
                        </tbody>
                    </table>
                </div>
                <div class="pagination" id="pagination">
                    <!-- Pagination -->
                </div>
            </div>
        </div>
    </main>
</body>
</html>


<script>
    let currentPage = 1;

    function loadOrders(page = 1) {
        currentPage = page;
        fetch(`http://127.0.0.1:8000/api/order?page=${page}`, {
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
            alert('Failed to load orders. Please try again later.');
        });
    }

    function renderOrderList(orders) {
    const orderList = document.getElementById('order-list');
    orderList.innerHTML = '';

    if (orders && orders.length > 0) {
        orders.forEach(order => {
            let actionButton = '';
            // Kiểm tra trạng thái đơn hàng để quyết định nút hành động
            if (order.status === 'Chưa xác nhận') {
                actionButton = `<button class="btn btn-primary" onclick="confirmOrder(${order.id})">Xác nhận</button>`;
            } else if (order.status === 'Đã xác nhận' && order.status !== 'Đang vận chuyển') {
                actionButton = `<button class="btn btn-warning" onclick="shipOrder(${order.id})" id="shipButton${order.id}">Xuất kho</button>`;
            }
            // Nếu trạng thái là 'Đang vận chuyển', không hiển thị nút 'Xuất kho' nữa
            else if (order.status === 'Đang vận chuyển') {
                actionButton = `<button class="btn btn-warning" disabled>Đã xuất kho</button>`;
            }

            const row = `
                <tr class="border border-gray-300 text-center">
                    <td class="border border-gray-300 px-6 py-4">
                        <input type="checkbox">
                    </td>
                    <td class="border border-gray-300 px-6 py-4">
                        <a href="detail-orders/${order.id}" class="text-blue-600 hover:underline">
                            ${order.id}
                        </a>
                    </td>
                    <td class="border border-gray-300 px-6 py-4">${order.username || 'N/A'}</td>
                    <td class="border border-gray-300 px-6 py-4">
                        ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(order.total_price)}
                    </td>
                    <td class="border border-gray-300 px-6 py-4">
                        ${new Date(order.created_at).toLocaleDateString()}
                    </td>
                    <td class="border border-gray-300 px-6 py-4">
                        ${actionButton}
                    </td>
                    <td class="border border-gray-300 px-6 py-4">${order.status || 'N/A'}</td>
                </tr>
            `;
            orderList.innerHTML += row;
        });
    } else {
        orderList.innerHTML = '<tr><td colspan="7" class="text-center">Không có đơn hàng nào</td></tr>';
    }
}
    function getActionButton(order) {
    // Điều kiện để hiển thị nút
    if (order.status === 'Chưa xác nhận') {
        return `<button class="btn btn-success" onclick="confirmOrder(${order.id})">Xác nhận</button>`; // Màu xanh lá
    } else if (order.status === 'Đã xác nhận') {
        return `<button class="btn btn-warning" onclick="shipOrder(${order.id})">Xuất kho</button>`; // Màu cam
    }
    return ''; // Không hiển thị nút nếu trạng thái không phải là 'Chưa xác nhận' hoặc 'Đang vận chuyển'
}

    function confirmOrder(orderId) {
  if (confirm('Bạn có chắc muốn xác nhận đơn hàng này không?')) {
    fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
        method: 'PATCH',
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ status: 'Đã xác nhận' })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Failed to confirm order');
      }
      return response.json();
    })
    .then(data => {
      alert('Đơn hàng đã được xác nhận thành công!');
      loadOrders(currentPage); // Tải lại danh sách đơn hàng
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Không thể xác nhận đơn hàng. Vui lòng thử lại.');
    });
  }
}

    function shipOrder(orderId) {
        if (confirm('Bạn có chắc muốn xuất kho đơn hàng này không?')) {
            fetch(`http://127.0.0.1:8000/api/order/${orderId}`, {
                method: 'PATCH',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: 'Đang vận chuyển' })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to ship order');
                }
                return response.json();
            })
            .then(data => {
                alert('Đơn hàng đã được chuyển sang trạng thái "Đang vận chuyển"!');
                loadOrders(currentPage);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Không thể xuất kho đơn hàng. Vui lòng thử lại.');
            });
        }
    }

    function renderPagination(data) {
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = '';

        if (data.prev_page_url) {
            pagination.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadOrders(${currentPage - 1})">&laquo;</a>
                </li>
            `;
        }

        for (let i = 1; i <= data.last_page; i++) {
            pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="loadOrders(${i})">${i}</a>
                </li>
            `;
        }

        if (data.next_page_url) {
            pagination.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="loadOrders(${currentPage + 1})">&raquo;</a>
                </li>
            `;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadOrders();
    });
</script>
@include('layouts.endadmin')
