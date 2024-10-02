@extends('layouts.clients')
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Giới thiệu', 'url' => '#']],
        'title' => 'Giới thiệu',
    ])


    <div class="h1-story-area two mb-120 pt-120">
        <div class="container">
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-6">
                    <div class="section-title1">
                        <span>
                            <img src="{{ asset('assets/clients/images/icon/section-vec-l1.svg') }}" alt>
                            Giới thiệu về PawSquad
                            <img src="{{ asset('assets/clients/images/icon/section-vec-r1.svg') }}" alt>
                        </span>
                        <h2>Tìm hiểu về PawSquad</h2>
                    </div>
                    <div class="story-content">
                        <p>
                            Tại PawSquad, chúng tôi tin rằng thú cưng là một phần không thể thiếu trong gia đình. Chúng tôi
                            đã dành nhiều năm nghiên cứu và phát triển những sản phẩm và dịch vụ tốt nhất cho thú cưng của
                            bạn.
                            Với đội ngũ chuyên gia giàu kinh nghiệm, chúng tôi cam kết mang đến cho thú cưng của bạn những
                            sản phẩm an toàn và chất lượng nhất.
                        </p>
                        <p>
                            Chúng tôi không chỉ cung cấp thức ăn và đồ chơi mà còn tổ chức các hoạt động giải trí và chăm
                            sóc sức khỏe cho thú cưng.
                            Mỗi sản phẩm của chúng tôi đều được kiểm tra kỹ lưỡng để đảm bảo rằng chúng đáp ứng được nhu cầu
                            dinh dưỡng và tinh thần của thú cưng.
                        </p>
                        <div class="story-title-reviews w-100">
                            <h3 style="max-width:100%!important">Chúng tôi tin rằng quy trình làm việc có thể <span>tăng
                                    cường</span> tư duy.</h3>
                        </div>
                        <p>
                            Đến với PawSquad, bạn không chỉ mua sắm cho thú cưng mà còn là một phần của cộng đồng yêu thú
                            cưng.
                            Chúng tôi luôn lắng nghe ý kiến của khách hàng để cải thiện dịch vụ và sản phẩm, từ đó mang đến
                            trải nghiệm tốt nhất cho bạn và thú cưng của bạn.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-center justify-content-center  d-lg-block d-none">
                    <div class="story-img d-flex justify-content-center align-items-center" style="height: 100%;">
                        <img class="img-fluid" style="transform: scaleX(-1);"
                            src="{{ asset('assets/clients/images/bg/dog-bg.png') }}" alt="DOG BG">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h2-services-area mb-120">
        <div class="services-btm">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 d-lg-block d-none">
                        <div class="services-img mt-5">
                            <div class="services-img-bg">
                                <img src="{{ asset('assets/clients/images/icon/h2-services-img-bg.svg') }}"
                                    alt="Background Image">
                            </div>
                            <img class="img-fluid" src="{{ asset('assets/clients/images/bg/h3-banner-img-dog.png') }}"
                                alt="Service Image">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="services-content ">
                            <div class=" d-flex justify-content-lg-center justify-content-center ">
                                <img src="{{ asset('assets/clients/images/icon/section-sl-no.svg') }}"
                                    class="d-flex justify-content-center align-items-center" alt="Section Number">
                            </div>
                            <h2>Dịch vụ chăm sóc thú cưng</h2>
                            <p>
                                Tại PawSquad, chúng tôi hiểu rằng mỗi thú cưng đều có nhu cầu riêng. Với nhiều năm kinh
                                nghiệm
                                trong ngành, chúng tôi cam kết cung cấp những dịch vụ chăm sóc tốt nhất cho thú cưng của
                                bạn.
                                Đội ngũ chuyên gia của chúng tôi luôn sẵn sàng đáp ứng mọi yêu cầu của bạn, từ chế độ dinh
                                dưỡng đến chăm sóc sức khỏe.
                            </p>
                            <div class="author-area">
                                <div class="author-quat">
                                    <p>
                                        <sup><img src="{{ asset('assets/clients/images/icon/author-quat-icon.svg') }}"
                                                alt="Quote Icon"></sup>
                                        Chúng tôi tin rằng mỗi thú cưng đều xứng đáng nhận được sự chăm sóc và tình yêu
                                        thương,
                                        và chúng tôi luôn nỗ lực để mang đến điều đó.
                                    </p>
                                </div>
                                <div class="author-name-deg">
                                    <h4>Trung Kiên</h4>
                                    <span>PawSquad</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
