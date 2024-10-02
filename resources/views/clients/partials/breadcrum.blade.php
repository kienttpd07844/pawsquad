<div class="inner-page-banner">
    <div class="breadcrumb-vec-btm">
        <img class="img-fluid" src="{{ asset('assets/clients/images/bg/inner-banner-btm-vec.png') }}" alt="Breadcrumb">
    </div>
    <div class="container">
        <div class="row justify-content-center align-items-center text-center">
            <div class="col-lg-6 align-items-center d-flex justify-content-center flex-column">
                <div class="banner-content text-center">
                    <h1>{{ $title }}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                            @foreach($breadcrumbs as $breadcrumb)
                                @if (!$loop->last)
                                    <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                                @else
                                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                                @endif
                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img d-lg-block d-none">
                    <div class="banner-img-bg">
                        <img class="img-fluid" src="{{ asset('assets/clients/images/bg/inner-banner-vec.png') }}" alt="Breadcrumb">
                    </div>
                    <img class="img-fluid" src="{{ asset('assets/clients/images/bg/inner-banner-img.png') }}" alt="Breadcrumb">
                </div>
            </div>
        </div>
    </div>
</div>
