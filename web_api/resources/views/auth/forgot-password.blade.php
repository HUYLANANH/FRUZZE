@include('layouts.header')

<!-- Begin Main Content Area -->
<main class="main-content">
    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">QUÊN MẬT KHẨU</h2>
                        <ul>
                            <li><a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
                            <li>Quên Mật Khẩu</li>
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
                    <!-- Step 1: Gửi OTP -->
                    <form id="sendOtpForm" method="POST">
                        @csrf
                        <div class="login-form" id="step1">
                            <h4 class="login-title text-center">Quên Mật Khẩu</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="contact">Nhập địa chỉ email đã đăng ký*</label>
                                    <input type="text" id="email" name="email" placeholder="Nhập email" required />
                                </div>
                                <div id="errorMessageStep1" class="col-12 text-center text-danger d-none"></div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0 w-100" type="submit">
                                        Gửi OTP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Step 2: Xác nhận OTP -->
                    <form id="verifyOtpForm" method="POST" class="d-none">
                        @csrf
                        <div class="login-form" id="step2">
                            <h4 class="login-title text-center">Xác Nhận OTP</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="otp">Mã OTP*</label>
                                    <input type="text" id="otp" name="otp" placeholder="Nhập mã OTP" required />
                                </div>
                                <div id="errorMessageStep2" class="col-12 text-center text-danger d-none"></div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0 w-100" type="submit">
                                        Xác Nhận OTP
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Step 3: Đặt lại mật khẩu -->
<form id="resetPasswordForm" method="POST" class="d-none">
    @csrf
    <div class="login-form" id="step3">
        <h4 class="login-title text-center">Đặt Lại Mật Khẩu</h4>
        <div class="row">
            <div class="col-md-12">
                <label for="new_password">Mật khẩu mới*</label>
                <input type="password" id="new_password" name="new_password" placeholder="Nhập mật khẩu mới" required />
            </div>
            <div class="col-md-12">
                <label for="confirm_password">Xác nhận mật khẩu mới*</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required />
            </div>
            <div id="errorMessageStep3" class="col-12 text-center text-danger d-none"></div>
            <div class="col-12 mt-3">
                <button class="btn btn-custom-size lg-size btn-secondary btn-primary-hover rounded-0 w-100" type="submit">
                    Đặt Lại Mật Khẩu
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
    // Step 1: Gửi OTP
    document.getElementById('sendOtpForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value.trim();
        const errorMessage = document.getElementById('errorMessageStep1');

        try {
            const response = await fetch('/api/forgot-password/send-otp', {  
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email })
            });

            if (response.ok) {
                document.getElementById('step1').classList.add('d-none');
                document.getElementById('verifyOtpForm').classList.remove('d-none');
            } else {
                const error = await response.json();
                errorMessage.textContent = error.message || 'Đã xảy ra lỗi.';
                errorMessage.classList.remove('d-none');
                console.error('Error Response:', error);
            }
        } catch (error) {
            errorMessage.textContent = 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
            errorMessage.classList.remove('d-none');
            console.error('Error:', error);
        }
    });

    // Step 2: Xác nhận OTP
    document.getElementById('verifyOtpForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const email = document.getElementById('email').value.trim();
        const otp = document.getElementById('otp').value.trim();
        const errorMessage = document.getElementById('errorMessageStep2');

        try {
            const response = await fetch('/api/forgot-password/verify-otp', { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ email, otp })
            });

            if (response.ok) {
                const data = await response.json();
                const resetToken = data.reset_token;
                console.log(resetToken);
                localStorage.setItem('resetToken', resetToken);
                document.getElementById('step2').classList.add('d-none');
                document.getElementById('resetPasswordForm').classList.remove('d-none');
            } else {
                const error = await response.json();
                errorMessage.textContent = error.message || 'Mã OTP không chính xác hoặc đã hết hạn.';
                errorMessage.classList.remove('d-none');
            }
        } catch (error) {
            errorMessage.textContent = 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
            errorMessage.classList.remove('d-none');
        }
    });

    // Step 3: Đặt lại mật khẩu
document.getElementById('resetPasswordForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const password = document.getElementById('new_password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();
    const email = document.getElementById('email').value.trim(); // Lấy email từ form trước đó
    const errorMessage = document.getElementById('errorMessageStep3');

    if (password !== confirmPassword) {
        errorMessage.textContent = 'Mật khẩu xác nhận không khớp!';
        errorMessage.classList.remove('d-none');
        return;
    }

    const reset_token = localStorage.getItem('resetToken');  // Lấy reset token từ localStorage

    if (!reset_token) {
        errorMessage.textContent = 'Đã có lỗi xảy ra. Vui lòng thử lại.';
        errorMessage.classList.remove('d-none');
        return;
    }

    try {
        // Gửi yêu cầu PATCH đến API
        const response = await fetch('http://127.0.0.1:8000/api/forgot-password/reset-password', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({password, email, reset_token})
        });

        if (response.ok) {
            alert('Mật khẩu đã được thay đổi thành công.');
            // Xóa token cũ khỏi localStorage (nếu có)
            localStorage.removeItem('resetToken');
            // Chuyển hướng người dùng đến trang đăng nhập
            window.location.href = '/login';
        } else {
            // Xử lý lỗi
            const error = await response.json();
            errorMessage.textContent = error.error || 'Đã có lỗi xảy ra.';
            errorMessage.classList.remove('d-none');
        }
    } catch (error) {
        errorMessage.textContent = 'Đã xảy ra lỗi. Vui lòng thử lại sau.';
        errorMessage.classList.remove('d-none');
    }
});

</script>

@include('layouts.footer')
