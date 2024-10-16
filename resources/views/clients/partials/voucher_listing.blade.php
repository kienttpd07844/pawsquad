@if ($coupons && $coupons->isNotEmpty())
    @foreach ($coupons as $coupon)
        <div class="voucher-container mb-3
        @if (Auth::check() && $coupon->usages()->where('user_id', auth()->user()->id)->exists())
            voucher-card-disabled
        @endif">
            <div class="voucher-main-content">
                <div class="voucher-info">
                    {{ $coupon->voucherType->name }}
                </div>
                <div class="voucher-details">
                    <div class="d-flex m-0 flex flex-column">
                        <div class="voucher-text">
                            Giảm giá
                            @if ($coupon->voucherType->discount_type === 'percentage')
                                {{ $coupon->voucherType->discount }}%
                            @elseif ($coupon->voucherType->discount_type === 'flat')
                                {{ format_cash($coupon->voucherType->discount) }}
                            @endif
                        </div>
                        @if ($coupon->voucherType->min_spend)
                            <div class="voucher-text">Đơn tối thiểu
                                {{ format_cash($coupon->voucherType->min_spend, true) }}</div>
                        @endif
                        <div class="voucher-hr"></div>
                        <div class="d-flex justify-content-between mt-0">
                            <div class="flex-column">
                                <div class="voucher-expiration">NBĐ:
                                    {{ \Carbon\Carbon::parse($coupon->start_date)->format('d-m-Y H:i') }}
                                </div>
                                <div class="voucher-expiration">HSD:
                                    {{ \Carbon\Carbon::parse($coupon->expired_date)->format('d-m-Y H:i') }}
                                </div>
                            </div>
                            <div class="flex-column  text-end">
                                <p class="voucher-expiration">SL: {{ $coupon->voucher_quantity }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="voucher-flex-end ">
                    <div class="d-flex align-items-center flex-column voucher_select">
                        <input type="checkbox" name="voucher_code" class="voucher-button m-0" aria-label="" role="checkbox"
                             tabindex="0" value="{{ $coupon->voucherType->name }}"
                            @if (Auth::check() && $coupon->usages()->where('user_id', auth()->user()->id)->exists()) disabled @endif
                            onclick="updateCouponInput(this.value)"  @if (request()->cookie('coupon_code') == $coupon->voucherType->name) checked  @endif >
                    </div>
                </div>
            </div>
            <div class="voucher-label voucher-discount">
                <svg class="voucher-arrow voucher-icon" width="6" height="6" viewBox="0 0 6 6" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="izn8vl oHnnYi">
                    <path
                        d="M1.50391 0.716797L2.50977 2.46973L3.53516 0.716797H4.8291L3.22754 3.30957L4.89258 6H3.59863L2.52441 4.17383L1.4502 6H0.151367L1.81152 3.30957L0.214844 0.716797H1.50391Z"
                        fill="#EE4D2D"></path>
                </svg>
                <div>{{ $coupon->voucherType->customer_usage_limit }}</div>
            </div>
            <div class="voucher-footer">
                <div class="voucher-bg" style="border-right: 0.0625rem dashed rgb(232, 232, 232); background: #F46F30;">
                </div>
            </div>
        </div>
    @endforeach
@else
        <p class="text-center">Không có mã nào</p>
@endif
