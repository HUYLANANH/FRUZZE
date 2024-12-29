@include('layouts.header')
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.invoice-content {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.btn {
    display: inline-block;
    text-align: center;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    margin-top: 20px;
}

.btn:hover {
    background-color: #0056b3;
}

</style>
<main class="invoice-content">
        <h1>Hóa Đơn Thanh Toán</h1>
        <section class="invoice-details">
            <p><strong>Tên:</strong> <span id="invoice-name"></span></p>
            <p><strong>Địa chỉ:</strong> <span id="invoice-address"></span></p>
            <p><strong>Email:</strong> <span id="invoice-email"></span></p>
            <p><strong>Số điện thoại:</strong> <span id="invoice-phone"></span></p>
            <p><strong>Phương thức thanh toán:</strong> <span id="invoice-method"></span></p>
        </section>

        <section class="invoice-items">
            <h2>Chi tiết đơn hàng:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                    </tr>
                </thead>
                <tbody id="invoice-items">
                    <!-- Nội dung sẽ được tải vào đây -->
                </tbody>
            </table>
            <p><strong>Tổng cộng:</strong> <span id="invoice-total"></span> VNĐ</p>
        </section>

        <a href="/" class="btn">Quay về Trang chủ</a>
    </main>

    <script>
        // Lấy dữ liệu hóa đơn từ localStorage
        const invoiceData = JSON.parse(localStorage.getItem("invoiceData"));

        if (invoiceData) {
            // Hiển thị thông tin người nhận
            document.getElementById("invoice-name").textContent = invoiceData.name;
            document.getElementById("invoice-address").textContent = invoiceData.address;
            document.getElementById("invoice-email").textContent = invoiceData.email;
            document.getElementById("invoice-phone").textContent = invoiceData.phone;
            document.getElementById("invoice-method").textContent =
                invoiceData.paymentMethod === "cash" ? "Tiền mặt" : "Chuyển khoản";

            // Hiển thị chi tiết sản phẩm
            const itemsHtml = invoiceData.items
                .map(
                    (item) => `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.quantity}</td>
                    <td>${(item.price * item.quantity).toFixed(0)} VNĐ</td>
                </tr>
            `
                )
                .join("");
            document.getElementById("invoice-items").innerHTML = itemsHtml;

            // Hiển thị tổng cộng
            document.getElementById("invoice-total").textContent = invoiceData.total.toFixed(0);
        } else {
            alert("Không tìm thấy dữ liệu hóa đơn.");
            window.location.href = "/";
        }
    </script>

@include('layouts.footer')