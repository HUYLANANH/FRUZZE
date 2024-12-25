<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - FRUZZE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            background-color: #f0f2f5;
        }
       
        aside {
            width: 150px;
            background-color: #fff;
            padding: 20px;
            height: 100vh;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            position: fixed;
        }
        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 40px; /* Kích thước logo */
            margin-right: 10px;
        }
        nav {
            margin-top: 10px;
            margin: auto; 
            text-align: center;
        }
        nav h3 {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        nav a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px 0;
            transition: background 0.3s;
        }
        nav a:hover {
            background-color: #f0f0f0;
        }
        main {
            margin-left: 270px; /* Để tránh bị che bởi sidebar */
            padding: 20px;
            flex-grow: 1;
            background-color: #ffffff;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>



    <aside>
        <div class="logo">
            <a href="/">
                <img src="/images/logo.png" alt="Logo">

                <span class="text-lg font-semibold tracking-tighter text-black">Frenzy</span>
            </a>
        </div>
        <nav>
            <h3>ADMIN</h3>
            <ul>
                <ul>
                    <a>Dashboard</a>
    </ul>
                <ul>
                    <a href="#" onclick="fetchProducts()">Sản phẩm</a>
                </ul>
                <ul>
                    <a>Đơn hàng</a>
                </ul>
                <ul>
                    <a>Người dùng</a>
                </ul>
                <ul>
                    <a>Cài đặt</a>
                </ul>
            </ul>
    
        </nav>
    </aside>


</body>
</html>
<script>
    function fetchProducts() {
        fetch('http://127.0.0.1:8000/product/get')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                // Xử lý dữ liệu sản phẩm ở đây, ví dụ: hiển thị trong một bảng
            })
            .catch(error => {
                console.error('Có lỗi xảy ra:', error);
            });
    }
</script>