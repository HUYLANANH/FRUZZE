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
                  <h2 class="breadcrumb-heading">LIÊN HỆ</h2>
                  <ul>
                    <li>
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
                    </li>
                    <li>Liên Hệ</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Begin Shipping Area -->
        <div class="shipping-area section-space-y-axis-100">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-6">
                <div class="shipping-item">
                  <div class="shipping-img">
                    <img
                      src="assets/images/shipping/icon/plane.png"
                      alt="Shipping Icon"
                    />
                  </div>
                  <div class="shipping-content">
                    <h5 class="title">Miễn Phí Vận Chuyển</h5>
                    <p class="short-desc mb-0">
                      FRUZZE cung cấp dịch cụ vận chuyển miễn phí
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 pt-6 pt-md-0">
                <div class="shipping-item">
                  <div class="shipping-img">
                    <img
                      src="assets/images/shipping/icon/earphones.png"
                      alt="Shipping Icon"
                    />
                  </div>
                  <div class="shipping-content">
                    <h5 class="title">Hỗ Trợ Online</h5>
                    <p class="short-desc mb-0">
                      FRUZZE cung cấp dịch vụ hỗ trợ 24/7
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 pt-6 pt-lg-0">
                <div class="shipping-item">
                  <div class="shipping-img">
                    <img
                      src="assets/images/shipping/icon/shield.png"
                      alt="Shipping Icon"
                    />
                  </div>
                  <div class="shipping-content">
                    <h5 class="title">Thanh Toán An Toàn</h5>
                    <p class="short-desc mb-0">
                      FRUZZE cam kết thanh toán an toàn, bảo mật
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Shipping Area End Here -->

        <div class="contact-with-map">
          <div class="contact-map">
            <iframe
              class="contact-map-size"
              src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d16201.982723320076!2d106.80157401348819!3d10.86401380601776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sen!2s!4v1733914832388!5m2!1sen!2s"
              allowfullscreen=""
              loading="lazy"
            ></iframe>
          </div>
          <div class="contact-form-area section-space-bottom-100">
            <div class="container">
              <div class="contact-form-wrap">
                <form
                  id="contact-form"
                  class="contact-form"
                  action=""
                  method="post"
                >
                  <h4 class="contact-form-title pb-2 mb-7">
                    Gửi tin nhắn cho chúng tôi
                  </h4>
                  <div class="form-field">
                    <input
                      type="text"
                      name="con_name"
                      id="con_name"
                      placeholder="Tên*"
                      class="input-field"
                    />
                  </div>
                  <div class="form-field mt-6">
                    <input
                      type="text"
                      name="con_email"
                      id="con_email"
                      placeholder="Email*"
                      class="input-field"
                    />
                  </div>
                  <div class="form-field mt-6">
                    <textarea
                      name="con_message"
                      id="con_message"
                      placeholder="Tin nhắn"
                      class="textarea-field"
                    ></textarea>
                  </div>
                  <div class="button-wrap mt-8">
                    <button
                      type="submit"
                      value="submit"
                      class="btn btn btn-custom-size lg-size btn-primary btn-secondary-hover rounded-0"
                      name="submit"
                    >
                      Gửi
                    </button>
                    <p class="form-messege mt-5 mb-0"></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- Main Content Area End Here -->

@include('layouts.footer')