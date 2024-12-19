@include('layouts.header')

      <!-- Begin Error 404 Area -->
      <div class="error-404-area section-space-top-100">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="error-404-content">
                <h1 class="title mb-5">404</h1>
                <h2 class="sub-title mb-4">Không tìm thấy trang này!</h2>
                <p class="short-desc mb-7">
                  Có vẻ như không tìm thấy gì ở vị trí này. Hãy thử thứ khác
                  hoặc bạn có thể quay lại trang chủ bằng cách nhấp vào nút bên
                  dưới!
                </p>
                <div class="button-wrap">
                  <a
                    class="btn btn-custom-size lg-size btn-primary btn-secondary-hover rounded-0"
                    href="/index"
                    >Về trang chủ</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Error 404 Area End Here -->

@include('layouts.footer')