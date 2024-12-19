@include('layouts.header')

<!-- Begin Main Content Area -->
<main class="main-content">
    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">ĐĂNG KÝ</h2>
                        <ul>
                            <li><a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
                            <li>Đăng Ký</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="login-register-area section-space-y-axis-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <form id="registerForm" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title text-center">Đăng Ký</h4>
                            <div class="row">
                                <!-- Họ và tên -->
                                <div class="col-md-12">
                                    <label for="full_name">Họ và tên*</label>
                                    <input type="text" id="full_name" name="full_name" placeholder="Họ và tên" required />
                                </div>

                                <!-- Username -->
                                <div class="col-md-12">
                                    <label for="username">Username*</label>
                                    <input type="text" id="username" name="username" placeholder="Nhập username" required />
                                </div>

                                <!-- Email -->
                                <div class="col-md-12">
                                    <label for="email">Email*</label>
                                    <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required />
                                </div>

                                <!-- Ngày sinh -->
                                <div class="col-md-6">
                                    <label for="birth_year">Ngày sinh*</label>
                                    <input type="date" id="birth_year" name="birth_year" required />
                                </div>

                                <!-- Số điện thoại -->
                                <div class="col-md-6">
                                    <label for="phone_number">Số điện thoại*</label>
                                    <input type="tel" id="phone_number" name="phone_number" placeholder="Nhập số điện thoại" required />
                                </div>

                                <!-- Địa chỉ -->
                                <div class="col-md-12">
                                    <label for="address">Địa chỉ*</label>
                                    <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required />
                                </div>

                                <!-- Mật khẩu -->
                                <div class="col-md-6">
                                    <label for="password">Mật khẩu*</label>
                                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required />
                                </div>

                                <!-- Xác nhận mật khẩu -->
                                <div class="col-md-6">
                                    <label for="password_confirmation">Xác nhận mật khẩu*</label>
                                    <input type="password" id="password_confirm" name="password" placeholder="Nhập lại mật khẩu" required />
                                </div>

                                <!-- Thông báo lỗi -->
                                <div id="errorMessage" class="col-12 text-center text-danger d-none">
                                    <!-- Lỗi sẽ hiển thị ở đây -->
                                </div>

                                <!-- Nút Đăng Ký -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0 w-100" type="submit">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Main Content Area End Here -->

<script>
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault(); // Ngăn chặn hành động mặc định của form

    // Lấy dữ liệu từ form
    const full_name = document.getElementById('full_name').value.trim();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone_number = document.getElementById('phone_number').value.trim();
    const birth_year = document.getElementById('birth_year').value;
    const password = document.getElementById('password').value.trim();
    const password_confirmation = document.getElementById('password_confirm').value.trim();
    const address = document.getElementById('address').value.trim(); // Lấy dữ liệu từ trường address

    const errorMessage = document.getElementById('errorMessage'); 

    // Kiểm tra mật khẩu xác nhận
    if (password !== password_confirmation) {
        document.getElementById('errorMessage').textContent = 'Mật khẩu không khớp!';
        document.getElementById('errorMessage').classList.remove('d-none');
        return;
    }
    if (birth_year) {
        console.log('Ngày sinh (yyyy-mm-dd):', birth_year);

    } else {
        console.log('Ngày sinh chưa được nhập');
    }

    try {
        // Gửi yêu cầu đến API đăng ký
        const response = await fetch('http://127.0.0.1:8000/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                // Authorization: 'Bearer ' + localStorage.getItem('token')  // Token nếu cần
            },
            body: JSON.stringify({ full_name, username, email, phone_number, birth_year, password, address }) // Gửi thêm address
        });

        if (response.ok) {
            const data = await response.json();
            console.log('Đăng ký thành công:', data);
            // Điều hướng người dùng sau khi đăng ký thành công
            window.location.href = '/login'; // Điều hướng đến trang đăng nhập
        } else {
            // In mã lỗi và thông điệp lỗi từ backend ra console
            const error = await response.json();
            console.error('Mã lỗi:', response.status); // In mã lỗi HTTP
            errorMessage.textContent = error.errors || error.message || 'Đã xảy ra lỗi.';
            errorMessage.classList.remove('d-none');
        }
    } catch (error) {
        console.error('Lỗi:', error);
        errorMessage.textContent = 'Đã xảy ra lỗi. Vui lòng thử lại.';
        errorMessage.classList.remove('d-none');
    }
});

</script>

@include('layouts.footer')
