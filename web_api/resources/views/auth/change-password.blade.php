@include('layouts.header')

<!-- Begin Main Content Area -->
<main class="main-content">

    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">ĐỔI MẬT KHẨU</h2>
                        <ul>
                            <li><a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
                            <li>Đổi Mật Khẩu</li>
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
                <form id="change-password-form">
                    <h2 class="text-center mb-4">Đổi Mật Khẩu</h2>
                    <div id="alert" class="alert d-none" role="alert"></div>

                    <div class="login-form">
                        <div class="row">
                            <!-- Mật khẩu hiện tại -->
                            <div class="col-md-12">
                                <label for="old_password">Mật khẩu hiện tại</label>
                                <input type="password" id="old_password" name="old_password" class="form-control" required />
                            </div>

                            <!-- Mật khẩu mới -->
                            <div class="col-md-12">
                                <label for="new_password">Mật khẩu mới</label>
                                <input type="password" id="new_password" name="new_password" class="form-control" required />
                            </div>

                            <!-- Nhập lại mật khẩu mới -->
                            <div class="col-md-12">
                                <label for="confirm_password">Nhập lại mật khẩu mới</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required />
                            </div>

                            <!-- Nút Lưu và Hủy -->
                            <div class="col-12 d-flex justify-content-between mt-3">
                                <button type="button" id="save-password" class="btn btn-primary">Lưu mật khẩu</button>
                                <button type="button" id="cancel-password" class="btn btn-secondary">Hủy</button>
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
    async function changePassword() {
        const token = localStorage.getItem('token');
        const old_password = document.getElementById('old_password').value;
        const new_password = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        // Kiểm tra mật khẩu mới và xác nhận
        if (new_password !== confirmPassword) {
            showAlert('danger', 'Mật khẩu mới và xác nhận không khớp.');
            return;
        }

        try {
            const response = await fetch('http://127.0.0.1:8000/api/auth/change-password', {
                method: 'PATCH',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ old_password, new_password })
            });

            if (!response.ok) {
                const errorData = await response.json();
                const message = errorData.message || 'Đổi mật khẩu thất bại.';
                throw new Error(message);
            }

            showAlert('success', 'Đổi mật khẩu thành công!');
            document.getElementById('change-password-form').reset();

            // Điều hướng về trang đăng nhập sau khi đổi mật khẩu thành công
            setTimeout(() => {
                window.location.href = '/login'; // Đảm bảo rằng đường dẫn '/login' là trang đăng nhập của bạn
            }, 2000); // Đợi 2 giây trước khi chuyển trang
        } catch (error) {
            showAlert('danger', error.message);
        }
    }

    // Hiển thị thông báo
    function showAlert(type, message) {
        const alertBox = document.getElementById('alert');
        alertBox.className = `alert alert-${type}`;
        alertBox.textContent = message;
        alertBox.classList.remove('d-none');

        // Tự động ẩn thông báo sau 5 giây
        setTimeout(() => {
            alertBox.classList.add('d-none');
        }, 5000);
    }

    // Xử lý sự kiện khi nhấn nút Lưu
    document.getElementById('save-password').addEventListener('click', changePassword);

    // Xử lý sự kiện khi nhấn nút Hủy
    document.getElementById('cancel-password').addEventListener('click', function () {
        window.history.back(); // Quay lại trang trước đó
    });
</script>

@include('layouts.footer')
