@extends('layouts.clients')
@section('content')
@include('clients.partials.breadcrum', [
    'breadcrumbs' => [['name' => 'Lỗi', 'url' => ""]],
    'title' => 'Lỗi',
])
    <div class="error-page mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-wrapper">
                        <div class="error-img">
                            <img class="img-fluid" style="display: flex;
                            margin: 0 auto;
                            width: 60%;" src="{{asset('assets/clients/images/bg/error-img.png')}}" alt="404">
                        </div>
                    </div>
                    <div class="error-content-area">
                        <h2>Lỗi</h2>
                        <p>Trang này không tồn tại hoặc đường dẫn đã bị thay đổi. Vui lòng quay lại sau.</p>
                        <div class="error-btn">
                            <a class="primary-btn1" href="{{ route('home') }}"><img src="{{asset('assets/clients/images/icon/home-icon.svg')}}" alt>
                                Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
