@extends('layouts.clients')
<style>
    .block-brand {
        background: white;
        margin-bottom: 10px;
        padding: 5px;
    }


    .gallery-img {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .gallery-img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
</style>
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Thương hiệu', 'url' => '#']],
        'title' => 'Thương hiệu',
    ])


    <div class="gallery-pages pt-120 mb-120">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row grid g-4">
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/alkin-1-300x300.webp') }}" data-fancybox="gallery"
                                class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/alkin-1-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/augustpet-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/augustpet-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/bayer-300x300.webp') }}" data-fancybox="gallery"
                                class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/bayer-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/bbn-300x300.webp') }}" data-fancybox="gallery"
                                class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/brand/bbn-300x300.webp') }}"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/bioline.webp') }}" data-fancybox="gallery"
                                class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid" src="{{ asset('assets/clients/images/brand/bioline.webp') }}"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/bobo-3-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/bobo-3-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/cats-best-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/cats-best-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/Elite-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/Elite-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/joyce-dolls-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/joyce-dolls-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/logopedigree-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/logopedigree-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/mkb-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/mkb-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-4 grid-item d-flex block-brand">
                            <a href="{{ asset('assets/clients/images/brand/naturecore-300x300.webp') }}"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="{{ asset('assets/clients/images/brand/naturecore-300x300.webp') }}" alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="load-more-btn">
                        <a class="primary-btn1" href="#">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
