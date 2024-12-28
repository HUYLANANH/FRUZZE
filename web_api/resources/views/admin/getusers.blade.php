@include('layouts.admin')

<div class="main-wrapper">
    <!-- Begin Main Content Area -->
    <main class="main-content">
        <div class="container my-5">
            <h2 class="text-center mb-4">Quản Lý Người Dùng</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Họ và tên</th>
                        <th>Năm sinh</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Giới tính</th>
                        <th>Vai trò</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    <!-- Danh sách người dùng sẽ được render tại đây -->
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center">
                    <!-- Pagination sẽ được render tại đây -->
                </ul>
            </nav>
        </div>
    </main>
</div>

<script>
    let currentPage = 1;

    // Fetch user data from the API
    function fetchUsers(page = 1) {
        currentPage = page;
        const token = localStorage.getItem('token');

        fetch(`http://127.0.0.1:8000/api/users?page=${page}`, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Lỗi khi lấy dữ liệu: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            renderUserList(data.data);
            renderPagination(data);
        })
        .catch(error => console.error('Lỗi:', error));
    }

    // Render user list
    function renderUserList(users) {
        const userList = document.getElementById('user-list');
        userList.innerHTML = '';
        if (users && users.length > 0) {
            users.forEach(user => {
                const userRow = `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.full_name}</td>
                        <td>${user.birth_year}</td>
                        <td>${user.phone_number}</td>
                        <td>${user.address}</td>
                        <td>${user.gender}</td>
                        <td>${user.role.name}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Xóa</button>
                        </td>
                    </tr>
                `;
                userList.innerHTML += userRow;
            });
        } else {
            userList.innerHTML = '<tr><td colspan="10" class="text-center">Không có người dùng nào</td></tr>';
        }
    }

    // Render pagination
    function renderPagination(data) {
        const pagination = document.querySelector('.pagination');
        pagination.innerHTML = '';

        if (data.prev_page_url) {
            pagination.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="fetchUsers(${currentPage - 1})">&laquo;</a>
                </li>
            `;
        }

        for (let i = 1; i <= data.last_page; i++) {
            pagination.innerHTML += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="javascript:void(0)" onclick="fetchUsers(${i})">${i}</a>
                </li>
            `;
        }

        if (data.next_page_url) {
            pagination.innerHTML += `
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" onclick="fetchUsers(${currentPage + 1})">&raquo;</a>
                </li>
            `;
        }
    }

    // Delete user
    function deleteUser(userId) {
        const confirmDelete = confirm('Bạn có chắc chắn muốn xóa người dùng này?');
        if (confirmDelete) {
            const token = localStorage.getItem('token');

            fetch(`http://127.0.0.1:8000/api/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Lỗi khi xóa người dùng: ' + response.status);
                }
                alert('Xóa người dùng thành công');
                fetchUsers(currentPage);
            })
            .catch(error => console.error('Lỗi:', error));
        }
    }

    // Fetch users on page load
    document.addEventListener('DOMContentLoaded', function() {
        fetchUsers();
    });
</script>
