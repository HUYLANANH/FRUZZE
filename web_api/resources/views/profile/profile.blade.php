@include('layouts.header')
<main class="main-content">
    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">TÀI KHOẢN CỦA BẠN</h2>
                        <ul>
                            <li><a href="/index">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
                            <li>Tài Khoản Của Bạn</li>
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
                    <form id="profile-form">
                        <h2 class="text-center mb-4">Thông Tin Tài Khoản</h2>
                        <div id="alert" class="alert d-none" role="alert"></div>

                        <div class="login-form">
                            <div class="row">
                                <!-- Full Name -->
                                <div class="col-md-12">
                                    <label for="full_name">Họ và tên</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" disabled />
                                </div>

                                <!-- Username -->
                                <div class="col-md-12">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" disabled />
                                </div>

                                <!-- Email -->
                                <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" disabled />
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" disabled />
                                </div>

                                <!-- Birth Year -->
                                <div class="col-md-6">
                                    <label for="birth_year">Ngày sinh</label>
                                    <input type="date" id="birth_year" name="birth_year" class="form-control" disabled />
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <label for="address">Địa chỉ</label>
                                    <textarea id="address" name="address" class="form-control" rows="3" disabled></textarea>
                                </div>

                                <!-- Buttons -->
                                <div class="col-12 d-flex justify-content-between mt-3">
                                    <button type="button" id="edit-profile" class="btn btn-primary">Sửa Thông Tin</button>
                                    <button type="button" id="change-password" class="btn btn-secondary">Đổi mật khẩu</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    async function fetchProfile() {
            const token = localStorage.getItem('token');

            try {
                const response = await fetch('http://127.0.0.1:8000/api/auth/profile', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                });
                if (!response.ok) throw new Error('Failed to fetch profile data');
                const data = await response.json();

                // Populate form fields with the data
                document.getElementById('full_name').value = data.full_name || '';
                document.getElementById('username').value = data.username || '';
                document.getElementById('email').value = data.email || '';
                document.getElementById('phone_number').value = data.phone_number || '';
                document.getElementById('birth_year').value = data.birth_year || '';
                document.getElementById('address').value = data.address || '';
            } catch (error) {
                showAlert('danger', 'Failed to load profile. Please try again.');
            }
        }

        async function saveProfile() {
        const token = localStorage.getItem('token');
        const data = {
            full_name: document.getElementById('full_name').value,
            username: document.getElementById('username').value,
            email: document.getElementById('email').value,
            phone_number: document.getElementById('phone_number').value,
            birth_year: document.getElementById('birth_year').value,
            address: document.getElementById('address').value
        };

        try {
            const response = await fetch('http://127.0.0.1:8000/api/auth/profile', {
                method: 'PATCH',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) throw new Error('Failed to update profile');
            showAlert('success', 'Profile updated successfully.');
        } catch (error) {
            showAlert('danger', 'Failed to update profile. Please try again.');
        }
    }
    document.getElementById('change-password').addEventListener('click', function () {
    window.location.href = '/change-password'; // URL của trang đổi mật khẩu
});

        // Function to show alerts
        function showAlert(type, message) {
            const alertBox = document.getElementById('alert');
            alertBox.className = `alert alert-${type}`;
            alertBox.textContent = message;
            alertBox.classList.remove('d-none');
        }

        // Initialize the form with user data
        document.addEventListener('DOMContentLoaded', fetchProfile);

        document.getElementById('edit-profile').addEventListener('click', function () {
        const isEditing = this.textContent === 'Lưu Thay Đổi';
        const fields = document.querySelectorAll('#profile-form input, #profile-form textarea');

        fields.forEach(field => field.disabled = isEditing);
        this.textContent = isEditing ? 'Sửa Thông Tin' : 'Lưu Thay Đổi';

        if (isEditing) saveProfile();
    });

    document.getElementById('change-password').addEventListener('click', function () {
        document.getElementById('password-section').classList.remove('d-none');
    });

    document.getElementById('save-password').addEventListener('click', changePassword);

    document.getElementById('cancel-password').addEventListener('click', function () {
        document.getElementById('password-section').classList.add('d-none');
    });

    </script>

@include('layouts.footer')