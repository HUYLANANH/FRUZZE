@include('layouts.header')
<!-- Begin Main Content Area -->
<main class="main-content">
    <div
        class="breadcrumb-area breadcrumb-height"
        data-bg-image="assets/images/breadcrumb/bg/bg.png"
    >
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">ĐĂNG NHẬP ADMIN</h2>
                        <ul>
                            <li>
                                <a href="/"
                                   >Trang Chủ <i class="pe-7s-angle-right"></i
                                ></a>
                            </li>
                            <li>Đăng nhập Admin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" id="loginForm" class="login-form">
        <div class="login-register-area section-space-y-axis-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <form action="#">
                            <div class="login-form">
                                <h4 class="login-title">Đăng Nhập Admin</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="username">Tên đăng nhập</label>
                                        <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required />
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="password-user">Mật khẩu</label>
                                        <input type="password" id="password-user" name="password" placeholder="Nhập mật khẩu" required />
                                    </div>

                                    <!-- Error Message -->
                                    <span id="errorMessage" style="color: red; display: none;">Sai tên đăng nhập hoặc mật khẩu</span>
                                    <div class="col-md-4 pt-1 mt-md-0">
                        <div class="forgotton-password_info">
        <a href="/forgot-password" class="txt-cyan txt-14 right" id="forget-password" style ="color:blue">Quên mật khẩu</a>
                        </div>
                      </div>

                                    <div class="col-lg-12 pt-5">
                                        <button
                                            class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0" type="submit"
                                        >
                                            Đăng Nhập
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>

</main>
<!-- Main Content Area End Here -->

<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    // Xử lý form đăng nhập admin
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const password = document.getElementById('password-user').value;

        try {
            const response = await fetch('http://127.0.0.1:8000/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ username, password })
            });

            if (response.ok) {
                const data = await response.json();
                console.log('Login success:', data);
                const token = data.token
                console.log(token)
                localStorage.setItem('token', token);
                window.location.href = '/admin/dashboard';
            } else {
                document.getElementById('errorMessage').style.display = 'block';
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('errorMessage').innerText = 'Đã xảy ra lỗi. Vui lòng thử lại.';
            document.getElementById('errorMessage').style.display = 'block';
        }
    });

    // Xử lý form quên mật khẩu admin
    document.getElementById('forgotPasswordForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('email').value;

        try {
            const response = await fetch('http://127.0.0.1:8000/api/auth/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email })
            });

            if (response.ok) {
                alert('Yêu cầu đặt lại mật khẩu đã được gửi. Vui lòng kiểm tra email.');
            } else {
                document.getElementById('forgotPasswordMessage').style.display = 'block';
                document.getElementById('forgotPasswordMessage').innerText = 'Không thể gửi yêu cầu. Vui lòng thử lại.';
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('forgotPasswordMessage').style.display = 'block';
            document.getElementById('forgotPasswordMessage').innerText = 'Đã xảy ra lỗi. Vui lòng thử lại.';
        }
    });
</script>

@include('layouts.footer')
