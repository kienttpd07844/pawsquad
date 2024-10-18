@extends('layouts.clients')
@section('css')
    <style>
        .form-check-input:checked {
            background: #F46F30 !important;
        }

        .form-inner:has(.select2Address) .error-help-block {
            position: absolute !important;
            top: 60px !important;
        }



        .tt-address-content .tt-address-info {
            width: 100%;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0);
        }

        .tt-address-content .tt-edit-address {
            right: 12px;
            top: 5px;
        }

        .addAddressModal .modal-header,
        .editAddressModal .modal-header,
        .deleteAddressModal .modal-header {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: white;
            padding: 10px;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: none !important;
        }

        .addAddressModal .modal-header h2,
        .editAddressModal .modal-header h2,
        .deleteAddressModal .modal-header h2 {
            margin-left: 15px;
        }

        .select2Address {
            display: block;
            width: 100%;
            transition: .3s ease;
            width: 100%;
            height: 45px;
            font-size: .875rem;
            font-weight: 400;
            color: #868686;
            font-family: var(--font-cabin);
            padding: 10px 20px;
            margin-right: 0;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
        }

        .addAddressModal input,
        .select2-search__field,
        .editAddressModal input {
            color: #868686 !important;
            background: white !important;
        }

        .label-input-field {
            position: relative;
            margin-top: 8px;
        }

        .label-input-field label {
            z-index: 1;
        }

        .label-input-field label {
            position: absolute;
            left: 14px;
            top: -12px;
            padding: 0 8px;
            background-color: #fff;
            font-weight: 600;
            font-size: 15px;
        }

        .label-input-field input,
        .label-input-field textarea,
        .label-input-field select {
            width: 100%;
            padding: 16px 24px;
            border-radius: 4px;
            border: 1px solid #e4e4e4;
            outline: 0;
        }

        .select2-container {
            width: auto;
            display: block;
            padding: 14px 24px;
            border-radius: 4px;
            border: 1px solid #e4e4e4;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 60px;
            right: 10px;
        }

        .select2-dropdown {
            top: -4px;
            border-color: #e4e4e4;
        }

        .select2-container--open .select2-dropdown {
            left: -1px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding: 0;
        }

        .select2-container--default .select2-selection--single {
            border: none;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border-color: #e4e4e4;
        }
    </style>
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Hoá đơn', 'url' => '']],
        'title' => 'Hoá đơn',
    ])
    <!--hoá đơn-->
    @if (!is_null($order))
        <section class="invoice-section pt-6 pb-120 mt-5">
            <div class="container">
                <div class="invoice-box bg-white rounded p-4 p-sm-6">
                    <div class="row g-5 justify-content-between">
                        <div class="col-lg-6">
                            <div class="invoice-title d-flex align-items-center">
                                <h3>Hoá đơn</h3>
                                <span class="badge rounded-pill fw-medium ms-3" style="background-color: {{ $order->order_status == 'PAID' ? '#f46f30' : ($order->order_status == 'PENDING' ? '#dc3545' : ($order->order_status == 'CANCELED' ? '#6c757d' : '#0d6efd')) }}; color: {{ $order->order_status == 'PAID' ? '#ffffff' : '#ffffff' }};">
                                    {{ getStatusOrder($order->order_status) }}
                                </span>
                            </div>
                            <table class="invoice-table-sm">
                                <tr>
                                    <td><strong>Mã hoá đơn</strong></td>
                                    <td>#{{ $order->id }}</td>
                                </tr>

                                <tr>
                                    <td><strong>Ngày khởi tạo</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-5 col-md-8">
                            <div class="text-lg-end">
                                <a href="{{ route('home') }}"><img src="{{ asset('assets/clients/images/logo/logo.png') }}"
                                        alt="logo" class="img-fluid" width="200"></a>
                            </div>
                            <div class="text-lg-end">
                                <a href="" class="primary-btn6 btn-xs mt-2 fs-6 p-2" style="font-size: 13px !important;">Xuất HĐ</a>
                            </div>
                        </div>
                    </div>
                    <span class="my-3 w-100 d-block border-top"></span>
                    <div class="row justify-content-between g-5">
                        <div class="col-xl-7 col-lg-6">
                            <div class="welcome-message">
                                <h5 class="mb-2 fw-bold">{{ auth()->user()->name }}</h5>
                                <p class="mb-0">
                                    Dưới đây là chi tiết đơn hàng của bạn. Chúng tôi cảm ơn bạn đã mua hàng.</p>

                                <p class="mb-0">Phương thức thanh toán:
                                    <span class="badge " style="background: #F46F30;">{{ $order->payment_method }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6">
                            @if ($order->address_id)
                                <div class="shipping-address d-flex justify-content-md-end">
                                    <div class="border-end pe-2">
                                        <h5 class="mb-2 fw-bold">Thông tin người nhận</h5>
                                        @php
                                            $shippingAddress = $order->address;
                                        @endphp
                                        <span>Tên: {{ $shippingAddress->name }}</span><br>
                                        <span>Số điện thoại: {{ $shippingAddress->phone }}</span><br>
                                        <span class="mb-0">{{ formatAddress($shippingAddress) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table invoice-table">
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                            </tr>
                            @php
                                $totalOrderAmount = 0;
                            @endphp
                            @foreach ($order->orderItems as $key => $item)
                                @php
                                    $product = $item->product_variation->productWithTrashed;
                                    $itemTotalPrice = $item->product_variation->price * $item->quantity;
                                    $totalOrderAmount += $itemTotalPrice;
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-nowrap">
                                        <div class="d-flex">
                                            <img src="{{ getImage($product->image) }}" alt="{{ $product->name }}"
                                                class="img-fluid product-item d-none">
                                            {{-- <div class="ms-2"> --}}
                                            <div class="">
                                                <span>{{ $product->name }}</span>
                                                <div>
                                                    @foreach (generateVariationOptions($item->product_variation->combinations) as $variation)
                                                        <span class="fs-xs">
                                                            {{ $variation['name'] }}:
                                                            @foreach ($variation['values'] as $value)
                                                                {{ $value['name'] }}
                                                            @endforeach
                                                            @if (!$loop->last)
                                                                ,
                                                            @endif
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ format_cash($item->product_variation->price) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ format_cash($item->product_variation->price * $item->quantity) }}</td>
                                </tr>
                            @endforeach


                        </table>
                    </div>
                    <div class="mt-4 table-responsive">
                        <table class="table footer-table">
                            <tr>
                                <td>
                                    <strong class="text-dark d-block text-nowrap">Phương thức thanh toán</strong>
                                    <span> {{ $order->payment_method }}</span>
                                </td>

                                <td>
                                    <strong class="text-dark d-block text-nowrap">Tổng tiền</strong>
                                    <span>{{ format_cash($totalOrderAmount) }}</span>
                                </td>
                                @if ($order->coupon_discount_amount > 0)
                                    <td>
                                        <strong class="text-dark d-block text-nowrap">Giảm giá</strong>
                                        @if ($order->coupon_discount_amount <= 100)
                                            <span>{{ $order->coupon_discount_amount }}%</span>
                                        @else
                                            <span>{{ format_cash($order->coupon_discount_amount) }}</span>
                                        @endif
                                    </td>
                                @endif

                                <td>
                                    <strong class="text-dark d-block text-nowrap">Thành tiền</strong>
                                    <span class="text-primary fw-bold"
                                        style="color: #F46F30!important">{{ format_cash($order->total_amount) }}</span>
                                </td>

                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--hoá đơn-->
@endsection
@section('js')
@endsection
