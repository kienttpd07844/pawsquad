@extends('layouts.clients')
@section('css')
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Sản phẩm yêu thích', 'url' => '']],
        'title' => 'Sản phẩm yêu thích',
    ])

    <div class="cart-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="eg-table table cart-table">
                            <thead>
                                <tr>
                                    <th>Xoá</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td data-label="Xoá">
                                        <div class="delete-icon">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </td>
                                    <td data-label="Hình">
                                        <img src="{{asset('assets/clients/images/bg/cart-01.png')}}" alt>
                                    </td>
                                    <td data-label="Tên"><a href="shop-details.html">Lồng ngủ cho mèo</a></td>
                                    <td data-label="Giá">200.000đ</td>
                                </tr>
                                <tr>
                                    <td data-label="Xoá">
                                        <div class="delete-icon">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </td>
                                    <td data-label="Hình">
                                        <img src="{{asset('assets/clients/images/bg/cart-02.png')}}" alt>
                                    </td>
                                    <td data-label="Tên"><a href="shop-details.html">Thức ăn cá hồi đóng hộp cho mèo.</a></td>
                                    <td data-label="Giá">50.000đ</td>
                                </tr>
                            </tbody>
                        </table>
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
