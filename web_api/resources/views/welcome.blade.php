<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | PING Cosmetics</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/assets/images/logo/colored-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="header-wrapper white fixed">
        <div class="header-container flex">
            <div class="logo-site">
                <a href="/" class="logo">
                    <img src="assets/color-logo.svg" alt="logo">
                </a>
            </div>
            <div class="page-header">
                <h2 class="section-txt-title">Đăng nhập</h2>
            </div>
        </div>
    </div>

    <div class="login-wrapper">
        <div class="login">
            <div class="txt-divider">Đăng nhập</div>
            <br>
            <!-- Form -->
            <form id="loginForm" class="login-form">
                <!-- Email -->
                <label for="username" style="font-weight: 400;">Tên đăng nhập</label><br>
                <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required><br><br>


                <!-- Password -->
                <label for="password-user" style="font-weight: 400;">Mật khẩu</label><br>
                <input type="password" id="password-user" name="password" placeholder="Nhập mật khẩu" required><br><br>

                <!-- Error Message -->
                <span id="errorMessage" style="color: red; display: none;">Sai email hoặc mật khẩu</span>

                <!-- Submit Button -->
                <button class="btn-login txt-uppercase" type="submit">Đăng nhập</button>
            </form>
            <br>
            <a href="" class="txt-cyan txt-14 right" id="forget-password">Quên mật khẩu</a><br>
            <hr style="width: 70%; height: 1px; background-color: var(--black); border: none; margin: 20px auto;">
            <div class="create-acc txt-center">
                <span>Bạn chưa có tài khoản? <a href="" class="txt-cyan orange-link">Tạo tài khoản</a></span>
            </div>
        </div>
    </div>

    <footer style="background-color: white; color: var(--cyan);">
        <div class="footer-copyright txt-center" style="font-weight: 400;">
            Copyright by PING Cosmetics - Based in Ho Chi Minh City
        </div>
        <div class="footer-hotline txt-center">Hotline: 012345678</div>
    </footer>

    <!-- JavaScript -->
    <script src="https://kit.fontawesome.com/6594d9651c.js" crossorigin="anonymous"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Chặn hành vi submit mặc định

            // Lấy dữ liệu từ form
            const username = document.getElementById('username').value;
            const password = document.getElementById('password-user').value;

            try {
                // Gửi request đến API
                const response = await fetch('http://127.0.0.1:8000/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF Token
                    },
                    body: JSON.stringify({ username, password })
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Login success:', data);

                    // Chuyển hướng sau khi đăng nhập thành công
                    window.location.href = '/dashboard';
                } else {
                    // Hiển thị thông báo lỗi
                    document.getElementById('errorMessage').style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('errorMessage').innerText = 'Đã xảy ra lỗi. Vui lòng thử lại.';
                document.getElementById('errorMessage').style.display = 'block';
            }
        });
    </script>
</body>

</html>
