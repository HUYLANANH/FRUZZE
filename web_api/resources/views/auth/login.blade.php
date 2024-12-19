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
                  <h2 class="breadcrumb-heading">ĐĂNG NHẬP</h2>
                  <ul>
                    <li>
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
                    </li>
                    <li>Đăng Nhập</li>
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
                    <h4 class="login-title">Đăng Nhập</h4>
                    <div class="row">
                      <div class="col-lg-12">
                        <label for="username">Tên đăng nhập*</label>
                        <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required/>
                      </div>
                      <div class="col-lg-12">
                        <label for="password-user">Mật khẩu</label>
                        <input type="password" id="password-user" name="password" placeholder="Nhập mật khẩu" required/>
                      </div>

            <!-- Error Message -->
            <span id="errorMessage" style="color: red; display: none;">Sai email hoặc mật khẩu</span>

                      <div class="col-md-8">
                      <div class="create-acc txt-center">
                    <span>Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="txt-cyan orange-link">Tạo tài khoản</a></span>
                    </div>
                      </div>

                    

                      <div class="col-md-4 pt-1 mt-md-0">
                        <div class="forgotton-password_info">
        <a href="/forgot-password" class="txt-cyan txt-14 right" id="forget-password">Quên mật khẩu</a>
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
      <!-- Main Content Area End Here -->'


      <script src="{{ asset('assets/js/main.js') }}"></script>
    <script> document.getElementById('loginForm').addEventListener('submit', async (e) => {
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
                    const token = data.token;
                  console.log(token);
                  localStorage.setItem('token', token);

                    // Chuyển hướng sau khi đăng nhập thành công
                    window.location.href = '/profile';
                } else {
                    // Hiển thị thông báo lỗi
                    document.getElementById('errorMessage').style.display = 'block';
                }
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('errorMessage').innerText = 'Đã xảy ra lỗi. Vui lòng thử lại.';
                document.getElementById('errorMessage').style.display = 'block';
            }
        });</script>

@include('layouts.footer')