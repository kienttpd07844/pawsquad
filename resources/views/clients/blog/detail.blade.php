@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [
            ['name' => 'Bài viết', 'url' => "{{ route('blog') }}"],
            ['name' => 'Tin ABC', 'url' => ''],
        ],
        'title' => 'Tin ABC',
    ])
    <div class="blog-details-pages pt-120 mb-120">
        <div class="container">
            <div class="row g-lg-4 gy-5 justify-content-center mb-70">
                <div class="col-lg-8">
                    <div class="blog-details-wrap mb-120">
                        <div class="post-thum">
                            <img class="img-fluid" src="{{ asset('assets/clients/images/blog/blog-dt-img.png') }}"
                                alt="blog-dt-img">
                            <div class="category">
                                <a href="blog-grid.html">Tìm hiểu</a>
                            </div>
                        </div>
                        <div class="blog-meta">
                            <ul>
                                <li><a href="blog-grid.html">29/09/2024 17:30</a></li>
                                <li><a href="blog-grid.html">By, Trung Kiên</a></li>
                            </ul>
                        </div>
                        <h2 class="post-title">Những Màu Lông Cơ Bản Của Giống Chó Alaska Malamute</h2>
                        <div class="post-content">
                            <p> Không chỉ chó Alaska mà hầu hết những giống chó tuyết kéo xe đều sở hữu bộ lông siêu dày và
                                rậm rạp. Bộ lông có tác dụng giữ nhiệt, đặc biệt không thấm nước, giúp bảo vệ Alaska trong
                                thời tiết giá lạnh tại vùng cực Bắc. Ngoài ra, bộ lông cũng được ví như tấm áo choàng, giúp
                                tôn lên vẻ đẹp của chó Alaska, khiến chúng trở nên quyến rũ, sang chảnh và quý phái hơn.
                                <br>
                                Cấu tạo bộ lông chó Alaska gồm 2 lớp với đặc điểm như sau:
                                <br>
                                Lớp bên trong là lông tơ bao phủ toàn bộ cơ thể, rất mềm mượt, chiều dài lông chỉ từ 2-3cm.
                                Chúng có tác dụng giữ nhiệt cho cơ thể chó Alaska chống chịu với cái lạnh.
                                <br>
                                Lớp lông ngoài dài, dày, rậm rạp và thô cứng. Chúng không bao phù toàn bộ cơ thể mà tập
                                trung nhiều nhất ở phần cổ, vai, lưng và đuôi. Lớp lông ngoài không thấm nước, thuận lợi khi
                                chó Alaska di chuyển dưới trời mưa tuyết để kéo xe.
                                <br>
                                Chó Alaska dù sở hữu màu lông gì thì lông phần mặt, bụng và bốn chân phải luôn có màu trắng.
                                Những màu khác đều bị coi là khuyết điểm và không được công nhận. Đây là đặc điểm nổi bật
                                nhất giúp bạn phân biệt được chó Alaska thuần chủng và lai tạp chỉ bằng mắt thường.
                                <br>
                                Ngoài ra, đối với những chú chó có 2 màu lông pha trộn như: xám trắng, nâu đỏ, agouti, …thì
                                màu sắc lông thường sẽ nhạt dần từ trên lưng xuống đến bụng.
                                <br>
                                Chó Alaska có bao nhiêu màu lông cơ bản?
                                <br>
                                Màu lông chó Alaska thực sự đa dạng, trải dài từ những gam màu tối cho đến gam màu sáng. Mỗi
                                màu lại giúp chó Alaska có những nét đẹp riêng. Từ đơn giản, bình dị cho đến sang chảnh,
                                quyến rũ. Cùng Sieupet.com liệt kê một số màu lông phổ biến của chó Alaska nhé!
                                <br>
                                Chó Alaska màu lông đen – trắng
                                <br>
                                Đây là màu lông phổ biến nhất của chó Alaska. Chiếm hơn 70% tổng số màu lông tại nước ta
                                hiện nay. Màu đen – trắng phổ biến nên đem lại cho người nhìn cảm giác gần gũi, thân thiết.
                                Màu lông này cũng khiến chó Alaska trông hiền lành, thân thiện và dễ thương hơn rất nhiều.
                                Tuy nhiên lại có phần trông hơi ngốc nghếch.
                                <br>
                                Chó Alaska màu lông xám – trắng
                                <br>
                                Chó Alaska sở hữu màu lông xám – trắng cũng chiếm số lượng lớn tại Việt Nam. Màu xám cũng
                                khiến chú chó của bạn trông quyến rũ, tinh tế và huyền bí hơn so với màu đen – trắng. Đây
                                được coi là màu lông yêu thích của giới trẻ và là màu hot trong năm nay.
                                <br>
                        </div>
                        <div class="blog-tag-social-area">
                            <div class="bolg-tag">
                                <ul>
                                    <li><a href="blog-grid.html">#cho</a></li>
                                    <li><a href="blog-grid.html">#cho dep</a></li>
                                </ul>
                            </div>
                            <div class="social-area">
                                <span>Chia sẻ:</span>
                                <ul class="social-link d-flex align-items-center">
                                    <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                    <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a>
                                    </li>
                                    <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="comment-area">
                        <div class="blog-comments mb-120">
                            <div class="comments-title">
                                <h2>Bình luận</h2>
                            </div>
                            <ul class="comment-list">
                                <li>
                                    <!-- Khung bình luận Facebook -->
                                    <div id="fb-root"></div>
                                    <div class="fb-comments" data-href="{{ url()->current() }}" data-width="100%"
                                        data-numposts="5"></div>

                                    <!-- Facebook SDK -->
                                    <script>
                                        (function(d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id)) return;
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src =
                                                "https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=YOUR_APP_ID&autoLogAppEvents=1";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));
                                    </script>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="single-widgets widget_search mb-30">
                            <form>
                                <div class="wp-block-search__inside-wrapper ">
                                    <input type="search" id="wp-block-search__input-1" class="wp-block-search__input"
                                        name="s" value placeholder="Nhập bài viết cần tìm" required>
                                    <button type="submit" class="wp-block-search__button">
                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.10227 0.0713005C1.983 0.760967 -1.22002 5.91264 0.44166 10.7773C1.13596 12.8 2.60323 14.471 4.55652 15.4476C6.38483 16.3595 8.59269 16.5354 10.5737 15.9151C11.4023 15.6559 12.6011 15.0218 13.2121 14.5126L13.3509 14.3969L16.1281 17.1695C19.1413 20.1735 18.9932 20.0531 19.4237 19.9698C19.6505 19.9281 19.9282 19.6504 19.9699 19.4236C20.0532 18.9932 20.1735 19.1413 17.1695 16.128L14.397 13.3509L14.5127 13.212C14.7858 12.8834 15.2394 12.152 15.4755 11.6614C17.0029 8.48153 16.3271 4.74159 13.7814 2.28379C11.9994 0.561935 9.52304 -0.257332 7.10227 0.0713005ZM9.38418 1.59412C11.0135 1.9135 12.4669 2.82534 13.4666 4.15376C14.0591 4.94062 14.4572 5.82469 14.6793 6.83836C14.8136 7.44471 14.8228 8.75925 14.7025 9.34708C14.3507 11.055 13.4713 12.4622 12.1336 13.4666C11.3467 14.059 10.4627 14.4571 9.44898 14.6793C8.80097 14.8228 7.48644 14.8228 6.83843 14.6793C4.78332 14.2303 3.0985 12.9389 2.20054 11.1337C1.75156 10.2312 1.54328 9.43503 1.49699 8.4445C1.36276 5.62566 3.01055 3.05677 5.6535 1.96904C6.10248 1.7839 6.8014 1.59412 7.28741 1.52932C7.74102 1.46452 8.92595 1.50155 9.38418 1.59412Z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="single-widgets widget_egns_categoris mb-30">
                            <div class="widget-title">
                                <h3>Chuyên mục</h3>
                            </div>
                            <ul class="wp-block-categoris-cloud">
                                <li><a href="blog-grid.html"><span>Tin tức</span> <span><span
                                                class="number-of-categoris">(30)</span><i
                                                class="bi bi-arrow-right-short"></i></span></a></li>
                                <li><a href="blog-grid.html"><span>Khuyến mãi</span> <span><span
                                                class="number-of-categoris">(18)</span><i
                                                class="bi bi-arrow-right-short"></i></span> </a></li>
                                <li><a href="blog-grid.html"><span>Kiến thức</span> <span><span
                                                class="number-of-categoris">(21)</span><i
                                                class="bi bi-arrow-right-short"></i></span> </a></li>
                                <li><a href="blog-grid.html"><span>Sự kiện</span> <span><span
                                                class="number-of-categoris">(25)</span><i
                                                class="bi bi-arrow-right-short"></i></span> </a></li>
                            </ul>
                        </div>
                        <div class="single-widgets widget_egns_recent_post mb-30">
                            <div class="widget-title">
                                <h3>Bài viết mới</h3>
                            </div>
                            <div class="recent-post-wraper">
                                <div class="widget-cnt mb-25">
                                    <div class="wi">
                                        <a href="blog-details.html"><img
                                                src="{{ asset('assets/clients/images/blog/blog-sidebar-1.png') }}"
                                                alt="image"></a>
                                    </div>
                                    <div class="wc">
                                        <a href="blog-grid.html">29/09/2024 17:23</a>
                                        <h6><a href="blog-details.html">Hướng dẫn huấn luyện chó đúng cách</a></h6>
                                    </div>
                                </div>
                                <div class="widget-cnt mb-25">
                                    <div class="wi">
                                        <a href="blog-details.html"><img
                                                src="{{ asset('assets/clients/images/blog/blog-sidebar-1.png') }}"
                                                alt="image"></a>
                                    </div>
                                    <div class="wc">
                                        <a href="blog-grid.html">29/09/2024 17:23</a>
                                        <h6><a href="blog-details.html">Hướng dẫn huấn luyện chó đúng cách</a></h6>
                                    </div>
                                </div>
                                <div class="widget-cnt mb-25">
                                    <div class="wi">
                                        <a href="blog-details.html"><img
                                                src="{{ asset('assets/clients/images/blog/blog-sidebar-1.png') }}"
                                                alt="image"></a>
                                    </div>
                                    <div class="wc">
                                        <a href="blog-grid.html">29/09/2024 17:23</a>
                                        <h6><a href="blog-details.html">Hướng dẫn huấn luyện chó đúng cách</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-widgets widget_egns_social">
                            <div class="widget-title">
                                <h3>Mạng xã hội</h3>
                            </div>
                            <ul class="social-link d-flex align-items-center">
                                <li><a href="https://www.facebook.com/"><i class="bx bxl-facebook"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="bx bxl-twitter"></i></a></li>
                                <li><a href="https://www.pinterest.com/"><i class="bx bxl-pinterest-alt"></i></a></li>
                                <li><a href="https://www.instagram.com/"><i class="bx bxl-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
