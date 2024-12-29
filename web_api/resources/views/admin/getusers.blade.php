@include('layouts.admin')

<div class="main-wrapper">
  <!-- Begin Main Content Area -->
  <main class="main-content">
    <div class="container my-5">
      <h2 class="text-center mb-4">Danh sách người dùng</h2>

      <div class="mb-3">
        <button class="btn btn-success" onclick="checkAdminAndAddUser()">Thêm người dùng</button>
      </div>

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

// Kiểm tra quyền admin
async function checkAdmin() {
  const token = localStorage.getItem('token');
  if (!token) {
    return false;
  }
  
  try {
    const response = await fetch('/api/auth/login', {
      headers: {
        'Authorization': `Bearer ${token}`
      }
    });
    const data = await response.json();
    return data.is_admin;
  } catch (error) {
    console.error('Lỗi khi xác thực quyền:', error);
    return false;
  }
}

// Fetch user data from the API
async function fetchUsers(page = 1) {
  currentPage = page;
  const token = localStorage.getItem('token');

  try {
    const response = await fetch(`http://127.0.0.1:8000/api/admin/all-users/2?page=${page}`, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
      }
    });

    if (!response.ok) {
      throw new Error('Lỗi khi lấy dữ liệu: ' + response.status);
    }

    const data = await response.json();
    renderUserList(data.data);
    renderPagination(data);
  } catch (error) {
    console.error('Lỗi:', error);
  }
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
          <td>${user.role_id === 1 ? 'Admin' : 'Người dùng'}</td>
        </tr>
      `;
      userList.innerHTML += userRow;
    });
  } else {
    userList.innerHTML = '<tr><td colspan="9" class="text-center">Không có người dùng nào</td></tr>';
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

// Kiểm tra quyền admin và thêm người dùng
async function checkAdminAndAddUser() {
  const isAdmin = await checkAdmin();
  if (isAdmin) {
    window.location.href = '/user/add'; // Đường dẫn đến trang tạo người dùng
  } else {
    alert('Bạn không có quyền thực hiện hành động này.');
    window.location.href = '/admin/login'; // Đường dẫn đến trang đăng nhập admin
  }
}

// Fetch users on page load
document.addEventListener('DOMContentLoaded', function() {
  fetchUsers(currentPage);
});
</script>

@include('layouts.endadmin')
