@extends('layouts.clients')
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Dịch vụ lưu trú', 'url' => '#']],
        'title' => 'Dịch vụ lưu trú',
    ])


    <div class="h1-story-area two mb-120 pt-120">
        <div class="container">
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-12">
                    <div class="section-title1">
                        <span>
                            <img src="{{ asset('assets/clients/images/icon/section-vec-l1.svg') }}" alt>
                            Dịch vụ lưu trú
                            <img src="{{ asset('assets/clients/images/icon/section-vec-r1.svg') }}" alt>
                        </span>
                        <h2>Tìm hiểu về dịch vụ lưu trú</h2>
                    </div>
                    <div class="story-content">
                        <p>
                            Dịch vụ lưu trú trông giữ chó mèo PawSquad tự hào là khách sạn chó mèo hiện đại, thân
                            thiện nhất tại thành phố. Với những dụng cụ chăm sóc cho mèo hiện đại, đội ngũ nhân viên được
                            huấn luyện nghiệp vụ tốt, đây sẽ là nơi để bạn an tâm gửi gắm thú cưng trong những ngày bận việc
                            hoặc đi công tác xa.

                            Với tình yêu thương đặc biệt với những “ông hoàng, bà thượng”, các dịch vụ lưu trú PawSquad đã
                            chuẩn bị một môi trường đa dạng, thoải mái để phục vụ thú cưng.
                        </p>
                        <br>
                        <p>
                            <h4>PawSquad luôn sẵn có:</h4>
                            <ul>
                                <li>Có đầy đủ không gian, ánh sáng tự nhiên cho thú cưng hoạt động.</li>
                                <li>Camera giám sát 24/24.</li>
                                <li>Nhân viên vệ sinh túc trực 24/7 để chăm sóc và dọn vệ sinh.</li>
                                <li>Khách sạn thú cưng có nhân viên y tế theo dõi sức khỏe của các bé thường xuyên.</li>
                                <li>Nguồn thức ăn được cung cấp đầy đủ, chế độ ăn đa dạng để các bé thấy ngon miệng.</li>
                                <li>Các bé còn được tập thể dục đều đặn hàng ngày để nâng cao sức khỏe.</li>
                                <li>Các khu vực spa, tắm, vệ sinh, grooming… luôn sẵn sàng để hỗ trợ các bé, giúp các bé thoải mái khi lưu trú tại đây.</li>
                                <li>"Con sen" chăm sóc đều là những người yêu thương thú cưng hết mực và đã có kinh nghiệm lâu năm trong việc chăm sóc và trông giữ chó mèo.</li>
                                <li>Hệ thống khử mùi, hút mùi và lọc ẩm được trang bị hiện đại.</li>
                                <li>Chúng tôi luôn có ghi chú đầy đủ về tình trạng sức khỏe, thức ăn ưa thích, đồ chơi của các bé để tiện cho việc chăm sóc tốt nhất khi các bé ở đây.</li>
                                <li>Giờ nhận và đón thú cưng linh động.</li>
                            </ul>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
