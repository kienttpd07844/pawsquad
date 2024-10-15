<strong>Họ tên: </strong>{{ $address->name }}
<br>
<strong>Số điện thoại: </strong>{{ $address->phone }}
<br>
@if ($address->address)
    <address class="fs-sm mb-0">
        {{ $address->address }}
    </address>
@endif
@if ($address->village->name != 'Khác')
    <strong>Thôn/Xóm: </strong>{{ $address->village->name }}
    <br>
@endif
<strong>Xã/Phường: </strong>{{ $address->ward->name }}
<br>
<strong>Quận/Huyện: </strong>{{ $address->district->name }}
<br>
<strong>Tỉnh/Thành phố: </strong>{{ $address->province->name }}
<br>
