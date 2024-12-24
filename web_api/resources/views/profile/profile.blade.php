@include('layouts.header')
<main class="main-content">
    <div class="breadcrumb-area breadcrumb-height" data-bg-image="assets/images/breadcrumb/bg/bg.png">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12">
                    <div class="breadcrumb-item">
                        <h2 class="breadcrumb-heading">TÀI KHOẢN CỦA BẠN</h2>
                        <ul>
                            <li><a href="/">Trang Chủ <i class="pe-7s-angle-right"></i></a></li>
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
                                <!-- Avatar -->
                                <div class="col-md-12 text-center mb-4">
                                    <img id="avatar" src="assets/images/meme-meo-bua-6.png" alt="Avatar" class="img-thumbnail rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>

                                <!-- Full Name -->
                                <div class="col-md-6">
                                    <label for="full_name">Họ và tên</label>
                                    <input type="text" id="full_name" name="full_name" class="form-control" disabled />
                                </div>

                                <!-- Username -->
                                <div class="col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" disabled />
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" disabled />
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6">
                                    <label for="phone_number">Số điện thoại</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control" disabled />
                                </div>

                                <!-- Giới tính -->
                                <div class="col-md-6">
                                    <label for="gender">Giới tính</label>
                                    <select name="gender" class="form-select" id="gender" disabled >
                                        <option value="male">Nam</option>
                                        <option value="female">Nữ</option>
                                        <option value="other">Khác</option>
                                    </select>
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
// Hàm lấy thông tin người dùng từ backend và đổ vào form
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

        if (!response.ok) throw new Error('Không thể tải dữ liệu hồ sơ');
        
        const data = await response.json();

        // Gán dữ liệu vào form
        document.getElementById('full_name').value = data.full_name || '';
        document.getElementById('username').value = data.username || '';
        document.getElementById('email').value = data.email || '';
        document.getElementById('phone_number').value = data.phone_number || '';
        document.getElementById('birth_year').value = data.birth_year || '';
        document.getElementById('address').value = data.address || '';
        document.getElementById('gender').value = data.gender || '';
        document.getElementById('avatar').value = data.avatar || '';

        // Cập nhật ảnh avatar nếu có

        } catch (error) {
            showAlert('danger', 'Không thể tải thông tin hồ sơ. Vui lòng thử lại.');
        }
}

// Hàm lưu hồ sơ người dùng sau khi chỉnh sửa
async function saveProfile() {
    const token = localStorage.getItem('token');

    // Lấy dữ liệu từ form
    const formData = {
        full_name: document.getElementById('full_name').value,
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        phone_number: document.getElementById('phone_number').value,
        birth_year: document.getElementById('birth_year').value,
        address: document.getElementById('address').value,
        gender: document.getElementById('gender').value,
    };

    try {
        const response = await fetch('http://127.0.0.1:8000/api/auth/update-profile', {
            method: 'PATCH',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData) // stringify object formData
        });

        const responseData = await response.json();
        if (!response.ok) throw new Error(responseData.message || 'Cập nhật thất bại');
        showAlert('success', 'Hồ sơ đã được cập nhật thành công.');
    } catch (error) {
        showAlert('danger', error.message || 'Cập nhật hồ sơ thất bại. Vui lòng thử lại.');
    }
}



// Hiển thị thông báo
function showAlert(type, message) {
    const alertBox = document.getElementById('alert');
    alertBox.className = `alert alert-${type}`;
    alertBox.textContent = message;
    alertBox.classList.remove('d-none');
}

// Tải dữ liệu hồ sơ khi trang được load
document.addEventListener('DOMContentLoaded', fetchProfile);

// Xử lý nút "Sửa Thông Tin"
document.getElementById('edit-profile').addEventListener('click', function() {
    const isEditing = this.textContent === 'Lưu Thay Đổi';
    const fields = document.querySelectorAll('#profile-form input, #profile-form textarea,  #profile-form select');

    // Chuyển đổi trạng thái chỉnh sửa
    fields.forEach(field => field.disabled = isEditing);
    this.textContent = isEditing ? 'Sửa Thông Tin' : 'Lưu Thay Đổi';

    // Nếu đang lưu thay đổi, gọi hàm saveProfile
    if (isEditing) saveProfile();
});

    </script>

@include('layouts.footer')