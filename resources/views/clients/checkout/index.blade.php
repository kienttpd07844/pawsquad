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
        'breadcrumbs' => [['name' => 'Thanh toán', 'url' => '']],
        'title' => 'Thanh toán',
    ])
    <div class="checkout-section pt-120 pb-120 ">
        <div class="container">
            <form action="{{ route('checkout.complete') }}" method="POST" id="payment_info">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="form-wrap box--shadow bg-white">
                            <h4 class="title-25 mb-20">Danh sách địa chỉ</h4>
                            <div class="row">
                                <div class="col-12 mb-3 label-input-field form-inner">
                                    @if ($addresses && $addresses->isNotEmpty())
                                        <label for="addressWallet">Chọn Địa Chỉ Lưu</label>
                                        <select id="addressWallet" class="select2Address w-100" name="address_wallet"
                                            autocomplete="off" role="presentation">
                                            <option value="" disabled selected>Chọn Địa Chỉ Đã Lưu</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->id }}" data-name="{{ $address->name }}"
                                                    data-phone="{{ $address->phone }}"
                                                    data-province="{{ $address->province->code }}"
                                                    data-district="{{ $address->district->code }}"
                                                    data-ward="{{ $address->ward->code }}"
                                                    data-village="{{ $address->village->code }}"
                                                    data-address="{{ $address->address }}">{{ formatAddress($address) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @else
                                        <label for="addressWallet">Bạn chưa lưu địa chỉ nào</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-wrap box--shadow mb-30 bg-white mt-2">
                            <h4 class="title-25 mb-20">Thông tin </h4>
                            <div id="addressModal" class="addressModal">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="label-input-field form-inner">
                                            <label>Họ và tên</label>
                                            <input type="text" name="name" placeholder="Họ và tên"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="label-input-field form-inner">
                                            <label>Số điện thoại</label>
                                            <input type="text" name="phone" placeholder="Nhập số điện thoại"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="label-input-field form-inner">
                                            <label>Tỉnh/Thành phố</label>
                                            <select class="select2Address w-100" name="province_id" autocomplete="off"
                                                role="presentation">
                                                <option value="">Chọn Tỉnh/Thành phố</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province->code }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="label-input-field form-inner">
                                            <label>Quận/Huyện</label>
                                            <select class="select2Address w-100" name="district_id" autocomplete="off"
                                                role="presentation">
                                                <option value="" selected disabled>Chọn Quận/Huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="label-input-field form-inner">
                                            <label>Phường/Xã</label>
                                            <select class="select2Address w-100" name="ward_id" autocomplete="off"
                                                role="presentation">
                                                <option value="" selected disabled>Chọn Phường/Xã</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="label-input-field form-inner">
                                            <label>Thôn/Xóm</label>
                                            <select class="select2Address w-100" name="village_id" autocomplete="off"
                                                role="presentation">
                                                <option value="" selected disabled>Chọn Thôn/Xóm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="label-input-field form-inner">
                                            <label>Số nhà/đường</label>
                                            <input type="text" name="address" placeholder="Nhập số nhà/đường"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="label-input-field form-inner">
                                            <textarea name="message" placeholder="Ghi chú cho Shop (nếu có)" rows="6">{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <aside class="col-lg-5">
                        <div class="added-product-summary mb-30 bg-white">
                            <h5 class="title-25 checkout-title">
                                Tóm tắt đơn hàng
                            </h5>
                            <ul class="added-products scrollbar"
                                style="max-height:350px;overflow-y: auto; overflow-x: hidden;">
                                @if ($carts && $carts->isNotEmpty())
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        <li class="single-product d-flex justify-content-start">
                                            <div class="product-img h-100">
                                                <img src="{{ getImage($cart->product_variation->product->image) }}"
                                                    alt="{{ $cart->product_variation->product->name }}"
                                                    style="width: 60px;height: 60px;">
                                            </div>
                                            <div class="product-info">
                                                <h5 class="product-title mb-2"><a
                                                        href="{{ route('product.detail', ['slug' => $cart->product_variation->product->slug]) }}">{{ $cart->product_variation->product->name }}</a>
                                                </h5>
                                                <div class="product-total d-flex align-items-center">
                                                    @if (generateVariationOptions($cart->product_variation->combinations))
                                                        @foreach (generateVariationOptions($cart->product_variation->combinations) as $variation)
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
                                                    @else
                                                        <span class="fs-xs"></span>
                                                    @endif
                                                </div>
                                                <strong>
                                                    <span
                                                        class="product-price">{{ format_cash($cart->product_variation->price) }}
                                                        x {{ $cart->quantity }}</span>
                                                </strong>
                                            </div>
                                        </li>
                                        @php
                                            $total += $cart->product_variation->price * $cart->quantity;
                                        @endphp
                                    @endforeach
                                @endif
                            </ul>
                        </div>



                        @if (getCoupon() != '')
                            @if (getCouponDiscount(getSubTotal($carts, false), getCoupon()) > 0)
                                <div class="summery-card cost-summery mb-30">
                                    <table class="table cost-summery-table">
                                        <thead>
                                            <tr>
                                                <th>Tổng</th>
                                                <th>{{ format_cash(getSubTotal($carts, false)) }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="tax">Giảm giá</td>
                                                <?php
                                                $formattedAmount = null;
                                                $voucherType = \App\Models\VoucherType::where('name', getCoupon())->first();
                                                $formattedAmount = '';
                                                if ($voucherType->discount_type === 'flat') {
                                                    $formattedAmount = format_cash($voucherType->discount);
                                                } else {
                                                    $formattedAmount = $voucherType->discount . '%';
                                                }
                                                ?>
                                                <td>-
                                                    {{ $formattedAmount }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                        <div class="summery-card total-cost mb-30">
                            <table class="table cost-summery-table total-cost">
                                <thead>
                                    <tr>
                                        <th>Thành tiền</th>
                                        <th>
                                            @if (getCoupon() != '')
                                                {{ format_cash(getCouponDiscount(getSubTotal($carts, false), getCoupon())) }}
                                            @else
                                                {{ format_cash(getSubTotal($carts, false)) }}
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="payment-form bg-white">
                            <div class="payment-methods mb-50">
                                <div class="form-check payment-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="vnpay"
                                        value="VNPAY" checked>
                                    <label class="form-check-label" for="VNPAY">
                                        Thanh toán qua ngân hàng
                                    </label>
                                    <p class="para">Sử dụng VNPAY</p>
                                </div>
                                <div class="form-check payment-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                        value="COD">
                                    <label class="form-check-label" for="cod">
                                        Thanh toán khi nhận hàng
                                    </label>
                                    <p class="para">Thanh toán bằng tiền mặt khi giao hàng.</p>
                                </div>
                            </div>
                            <div class="place-order-btn">
                                @csrf
                                <button type="submit" class="primary-btn1 lg-btn">Thanh toán</button>
                            </div>
                        </div>
                    </aside>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\CheckoutFormRequest', '#payment_info') !!}

    <script>
        "use strict";
        var parent = '.addressModal';

        function addressModalSelect2(parent = '.addressModal') {
            // Hủy khởi tạo Nice Select nếu đã khởi tạo
            if ($('.select2Address').hasClass('nice-select')) {
                $('.select2Address').niceSelect('destroy');
            }

            $('.select2Address').select2({
                dropdownParent: $(parent),
                language: 'vi',
                width: '100%'
            });

        }

        $(document).ready(function() {
            addressModalSelect2();
        });

        $(document).on('select2:select', 'select[name="address_wallet"]', function(e) {
            var selectedOption = $(this).find('option:selected');
            var name = selectedOption.data('name');
            var phone = selectedOption.data('phone');
            var province = selectedOption.data('province');
            var district = selectedOption.data('district');
            var ward = selectedOption.data('ward');
            var village = selectedOption.data('village');
            console.log(district, ward, village)
            var address = selectedOption.data('address');
            $('input[name="name"]').val(name);
            $('input[name="phone"]').val(phone);
            $('input[name="address"]').val(address);
            if (province) {
                $('select[name="province_id"]').val(province).trigger('change');
            }
            if (district) {
                getDistrict(province, district);
            }
            if (ward) {
                getWard(district, ward);
            }
            if (village) {
                getVillage(ward, village);
            }
        });



        $(document).on('select2:select', 'select[name="province_id"]', function(e) {
            var province_id = e.params.data.id;
            if (province_id) {
                resetFields(['district_id', 'ward_id', 'village_id']);
                getDistrict(province_id);
            }
        });

        // Hàm lấy dữ liệu Quận/Huyện theo Province ID
        function getDistrict(province_id, selectedDistrict = null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.getDistrict') }}",
                type: 'POST',
                data: {
                    province_id: province_id
                },
                success: function(response) {
                    var $districtSelect = $('select[name="district_id"]');
                    $districtSelect.html(response);
                    addressModalSelect2(parent)
                    if (selectedDistrict) {
                        $districtSelect.val(selectedDistrict).trigger('change');
                    }
                },
                error: function(xhr) {
                    console.error('Error:', xhr); // Kiểm tra lỗi
                }
            });
        }




        //  lấy Phường/Xã khi chọn Huyện
        $(document).on('select2:select', 'select[name="district_id"]', function(e) {
            var district_id = e.params.data.id;
            if (district_id) {
                resetFields(['ward_id', 'village_id']);
                getWard(district_id);
            }
        });



        //  lấy Phường/Xã
        function getWard(district_id, selectedWard = null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.getWard') }}",
                type: 'POST',
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    var $ward_id = $('select[name="ward_id"]');
                    $ward_id.html(response);
                    addressModalSelect2(parent)
                    if (selectedWard) {
                        $ward_id.val(selectedWard).trigger('change');
                    }
                }
            });
        }

        //  lấy Thôn/Xóm chọn Xã
        $(document).on('select2:select', 'select[name="ward_id"]', function(e) {
            var ward_id = e.params.data.id;
            if (ward_id) {
                resetFields(['village_id']);
                getVillage(ward_id);
            }
        });

        //  lấy Thôn/Xóm
        function getVillage(ward_id, selectedVillage = null) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: "{{ route('address.getVillage') }}",
                type: 'POST',
                data: {
                    ward_id: ward_id
                },
                success: function(response) {
                    var $village_id = $('select[name="village_id"]');
                    $village_id.html(response);
                    addressModalSelect2(parent);
                    if (selectedVillage) {
                        $village_id.val(selectedVillage).trigger('change');
                    }
                }
            });
        }

        function resetFields(fields) {
            fields.forEach(function(field) {
                var placeholder = '';
                switch (field) {
                    case 'district_id':
                        placeholder = 'Chọn Quận/Huyện';
                        break;
                    case 'ward_id':
                        placeholder = 'Chọn Phường/Xã';
                        break;
                    case 'village_id':
                        placeholder = 'Chọn Thôn/Xóm';
                        break;
                    default:
                        placeholder = 'Chọn...';
                }
                $('select[name="' + field + '"]').html('<option value="">' + placeholder + '</option>');
            });
        }
    </script>
@endsection
