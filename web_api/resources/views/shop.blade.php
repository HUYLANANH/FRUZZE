@include('layouts.header')

<div class="main-wrapper">
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
                  <h2 class="breadcrumb-heading">CỬA HÀNG</h2>
                  <ul>
                    <li>
                      <a href="/"
                        >Trang Chủ <i class="pe-7s-angle-right"></i
                      ></a>
                    </li>
                    <li>Cửa Hàng</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="shop-area section-space-y-axis-100">
          <div class="container">
            <div class="row">
              <div class="col-lg-3 order-lg-1 order-2 pt-10 pt-lg-0">
                <div class="sidebar-area">
                  <div class="widgets-searchbox mb-9">
                    <form id="widgets-searchbox" action="#">
                      <input
                        class="input-field"
                        type="text"
                        placeholder="Tìm Kiếm Sản Phẩm"
                      />
                      <button class="widgets-searchbox-btn" type="submit">
                        <i class="pe-7s-search"></i>
                      </button>
                    </form>
                  </div>
                  <div class="widgets-area mb-9">
                    <h2 class="widgets-title mb-5">Lọc Theo</h2>
                    <div class="widgets-item">
                      <ul class="widgets-checkbox">
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="refine-item"
                          />
                          <label class="label-checkbox mb-0" for="refine-item"
                            >Đang giảm giá
                            <span>4</span>
                          </label>
                        </li>
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="refine-item-2"
                            checked
                          />
                          <label class="label-checkbox mb-0" for="refine-item-2"
                            >Mới
                            <span>4</span>
                          </label>
                        </li>
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="refine-item-3"
                          />
                          <label class="label-checkbox mb-0" for="refine-item-3"
                            >Còn hàng
                            <span>4</span>
                          </label>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="widgets-area widgets-filter mb-9">
                    <h2 class="widgets-title mb-5">Lọc theo giá tiền</h2>
                    <div class="price-filter">
                      <div id="slider-range"></div>
                      <div class="price-slider-amount">
                        <button class="btn btn-primary btn-secondary-hover">
                          Lọc
                        </button>
                        <div class="label-input position-relative">
                          <label>Giá : </label>
                          <input
                            type="text"
                            id="amount"
                            name="price"
                            placeholder="Nhập giá mong muốn"
                          />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="widgets-area mb-9">
                    <h2 class="widgets-title mb-5">Trọng Lượng</h2>
                    <div class="widgets-item">
                      <ul class="widgets-checkbox">
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="size-selection-1"
                          />
                          <label
                            class="label-checkbox mb-0"
                            for="size-selection-1"
                            >50 Gram</label
                          >
                        </li>
                        <li>
                          <input
                            class="input-checkbox"
                            type="checkbox"
                            id="size-selection-2"
                            checked
                          />
                          <label
                            class="label-checkbox mb-0"
                            for="size-selection-2"
                            >100 Gram</label
                          >
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="widgets-area mb-9">
                    <h2 class="widgets-title mb-5">Sản Phẩm Được Đánh Giá Cao</h2>
                    <div class="widgets-item">
                      <div class="swiper-container widgets-list-slider">
                        <div class="swiper-wrapper">
                          <div class="swiper-slide">
                            <div class="product-list-item">
                              <div class="product-img img-zoom-effect">
                                <a href="/detail-shop">
                                  <img
                                    class="img-full"
                                    src="assets/images/product/small-size/1-1-112x124.jpg"
                                    alt="Product Images"
                                  />
                                </a>
                              </div>
                              <div class="product-content">
                                <a
                                  class="product-name"
                                  href="/detail-shop"
                                  >Dried Lemon Green</a
                                >
                                <div class="price-box pb-1">
                                  <span class="new-price">$80.00</span>
                                </div>
                                <div class="rating-box-wrap">
                                  <div class="rating-box">
                                    <ul>
                                      <li><i class="pe-7s-star"></i></li>
                                      <li><i class="pe-7s-star"></i></li>
                                      <li><i class="pe-7s-star"></i></li>
                                      <li><i class="pe-7s-star"></i></li>
                                      <li><i class="pe-7s-star"></i></li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="widgets-area">
                    <h2 class="widgets-title mb-5">Thẻ</h2>
                    <div class="widgets-item">
                      <ul class="widgets-tags">
                        <li>
                          <a href="javascript:void(0)">Sầu riêng</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Mít</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Chuối</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Xoài</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Thanh long</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Dứa</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Đào</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Kiwi</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Măng cụt</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Sữa chua</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)">Mix</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-9 order-lg-2 order-1">
                <div class="product-topbar">
                  <ul>
                    <li class="product-view-wrap">
                      <ul class="nav" role="tablist">
                        <li class="grid-view" role="presentation">
                          <a
                            id="grid-view-tab"
                            data-bs-toggle="tab"
                            href="#grid-view"
                            role="tab"
                            aria-selected="true"
                          >
                            <i class="fa fa-th"></i>
                          </a>
                        </li>
                        <li class="list-view" role="presentation">
                          <a
                            class="active"
                            id="list-view-tab"
                            data-bs-toggle="tab"
                            href="#list-view"
                            role="tab"
                            aria-selected="true"
                          >
                            <i class="fa fa-th-list"></i>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li class="page-count">
                      <span>23</span> Sản phẩm được tìm thấy trong tổng cộng <span>50</span> sản phẩm
                    </li>
                    <li class="short">
                      <select class="nice-select wide rounded-0">
                        <option value="1">Sắp xếp theo mặc định</option>
                        <option value="3">Sắp xếp theo xếp hạng</option>
                        <option value="4">Sắp xếp theo mới nhất</option>
                        <option value="5">Sắp xếp theo giá cao đến thấp</option>
                        <option value="6">Sắp xếp theo giá thấp đến cao</option>
                      </select>
                    </li>
                  </ul>
                </div>
                <div class="tab-content text-charcoal pt-8">
                  <div
                    class="tab-pane fade"
                    id="grid-view"
                    role="tabpanel"
                    aria-labelledby="grid-view-tab"
                  >
                    <div class="product-grid-view row">
                      <div class="col-lg-4 col-sm-6">
                        <div class="product-item">
                          <div class="product-img img-zoom-effect">
                            <a href="/detail-shop">
                              <img
                                class="img-full"
                                src="assets/images/product/medium-size/1-1-270x300.jpg"
                                alt="Product Images"
                              />
                            </a>
                            <div class="product-add-action">
                              <ul>
                                <li>
                                  <a href="/cart">
                                    <i class="pe-7s-cart"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="/wishlist">
                                    <i class="pe-7s-like"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="product-content">
                            <a class="product-name" href="/detail-shop"
                              >Green Vegetable</a
                            >
                            <div class="price-box pb-1">
                              <span class="new-price">$80.00</span>
                            </div>
                            <div class="rating-box">
                              <ul>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-sm-6 pt-6 pt-sm-0">
                        <div class="product-item">
                          <div class="product-img img-zoom-effect">
                            <a href="/detail-shop">
                              <img
                                class="img-full"
                                src="assets/images/product/medium-size/1-2-270x300.jpg"
                                alt="Product Images"
                              />
                            </a>
                            <div class="product-add-action">
                              <ul>
                                <li>
                                  <a href="/cart">
                                    <i class="pe-7s-cart"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="/wishlist">
                                    <i class="pe-7s-like"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="product-content">
                            <a class="product-name" href="single-product.html"
                              >Lemon Juice</a
                            >
                            <div class="price-box pb-1">
                              <span class="new-price">$80.00</span>
                            </div>
                            <div class="rating-box">
                              <ul>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div
                    class="tab-pane fade show active"
                    id="list-view"
                    role="tabpanel"
                    aria-labelledby="list-view-tab"
                  >
                    <div class="product-list-view with-sidebar row">
                      <div class="col-12">
                        <div class="product-item">
                          <div class="product-img img-zoom-effect">
                            <a href="single-product.html">
                              <img
                                class="img-full"
                                src="assets/images/product/medium-size/1-1-270x300.jpg"
                                alt="Product Images"
                              />
                            </a>
                            <div class="product-add-action">
                              <ul>
                                <li>
                                  <a href="cart.html">
                                    <i class="pe-7s-cart"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="wishlist.html">
                                    <i class="pe-7s-like"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="product-content align-self-center">
                            <a
                              class="product-name pb-2"
                              href="single-product.html"
                              >Cow Milk & Meat</a
                            >
                            <div class="price-box pb-1">
                              <span class="new-price">$80.00</span>
                            </div>
                            <div class="rating-box pb-2">
                              <ul>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                              </ul>
                            </div>
                            <p class="short-desc mb-0">
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 pt-6">
                        <div class="product-item">
                          <div class="product-img img-zoom-effect">
                            <a href="single-product.html">
                              <img
                                class="img-full"
                                src="assets/images/product/medium-size/1-2-270x300.jpg"
                                alt="Product Images"
                              />
                            </a>
                            <div class="product-add-action">
                              <ul>
                                <li>
                                  <a href="/cart">
                                    <i class="pe-7s-cart"></i>
                                  </a>
                                </li>
                                <li>
                                  <a href="/wishlist">
                                    <i class="pe-7s-like"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                          <div class="product-content align-self-center">
                            <a
                              class="product-name pb-2"
                              href="/detail-shop"
                              >Black Pepper Grains</a
                            >
                            <div class="price-box pb-1">
                              <span class="new-price">$80.00</span>
                            </div>
                            <div class="rating-box pb-2">
                              <ul>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                                <li><i class="pe-7s-star"></i></li>
                              </ul>
                            </div>
                            <p class="short-desc mb-0">
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pagination-area pt-10">
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                          <span class="fa fa-chevron-left"></span>
                        </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                          <span class="fa fa-chevron-right"></span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      <!-- Main Content Area End Here -->

@include('layouts.footer')
