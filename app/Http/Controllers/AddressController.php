<?php

namespace App\Http\Controllers;

use App\Jobs\SaveAddressData;
use App\Models\Address;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function fetchAndSaveAddresses()
    {
        DB::beginTransaction(); // Bắt đầu transaction

        try {
            // $responseProvinces = Http::get('https://provinces.open-api.vn/api/p/?depth=3');
            // $provinces = $responseProvinces->json();

            // // Chia nhỏ và đẩy vào queue
            // collect($provinces)->chunk(500)->each(function ($provinceChunk) {
            //     SaveAddressData::dispatch($provinceChunk, 'provinces'); // Đẩy vào queue
            // });

            // $responseDistricts = Http::get('https://provinces.open-api.vn/api/d/?depth=3');
            // $districts = $responseDistricts->json();

            // collect($districts)->chunk(500)->each(function ($districtChunk) {
            //     SaveAddressData::dispatch($districtChunk, 'districts'); // Đẩy vào queue
            // });

            // $responseWards = Http::get('https://provinces.open-api.vn/api/w/?depth=3');
            // $wards = $responseWards->json();

            // collect($wards)->chunk(500)->each(function ($wardChunk) {
            //     SaveAddressData::dispatch($wardChunk, 'wards'); // Đẩy vào queue
            // });
            SaveAddressData::dispatch(null, 'villages');

            DB::commit(); // Commit transaction nếu thành công
            return response()->json(['message' => 'Dữ liệu đã được đẩy vào queue để xử lý!'], 200);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback nếu có lỗi
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
    private function validateAddress(Request $request)
    {
        // Lấy tỉnh
        $province = Province::where('code', $request->province_id)->first();
        if (!$province) {
            return 'Tỉnh không hợp lệ';
        }

        // Lấy huyện
        $district = $province->districts()->where('code', $request->district_id)->first();
        if (!$district) {
            return 'Huyện không hợp lệ';
        }

        // Lấy xã
        $ward = $district->wards()->where('code', $request->ward_id)->first();
        if (!$ward) {
            return 'Xã không hợp lệ';
        }

        // Lấy thôn
        $village = $ward->villages()->where('code', $request->village_id)->first();
        if (!$village) {
            return 'Thôn không hợp lệ';
        }

        return true; // Tất cả đều hợp lệ
    }
    public function store(Request $request)
    {
        $validationResult = $this->validateAddress($request);
        if ($validationResult !== true) {
            return redirect()->back()->with(noti($validationResult, 'error'));
        }
        $userId = auth()->user()->id;
        $address                = new Address;
        $address->user_id       = $userId;
        $address->name       = $request->name;
        $address->phone       = $request->phone;
        $address->province_id    = $request->province_id;
        $address->district_id      = $request->district_id;
        $address->ward_id       = $request->ward_id;
        $address->village_id       = $request->village_id;

        if ($request->is_default == 1) {
            $prevDefault = Address::where('user_id', $userId)->where('is_default', 1)->first();
            if (!is_null($prevDefault)) {
                $prevDefault->is_default = 0;
                $prevDefault->save();
            }
        }
        $address->is_default    = $request->is_default;
        $address->address       = $request->address;
        $address->save();
        return redirect()->route('account')->with(noti('Thêm thông tin địa chỉ thành công', 'success'));
    }

    # Sửa địa chỉ
    public function edit(Request $request)
    {
        $address = Address::where('user_id', auth()->user()->id)->where('id', $request->addressId)->first();
        if ($address) {
            $province = Province::all();
            // Lấy danh sách quận/huyện dựa trên tỉnh
            $district = District::where('province_code', $address->province_id)->get();
            // Lấy danh sách xã/phường dựa trên quận/huyện
            $ward = Ward::where('district_code', $address->district_id)->get();
            // Lấy danh sách thôn/xóm dựa trên xã/phường
            $village = Village::where('ward_code', $address->ward_id)->get();
            return getRender('clients.partials.addressEditForm', [
                'name' => $address->name,
                'phone' => $address->phone,
                'address' => $address,
                'provinces' => $province,
                'districts' => $district,
                'wards' => $ward,
                'villages' => $village,
            ]);
        }
        return redirect()->back()->with(noti('Không tìm thấy thông tin địa chỉ', 'error'));
    }


    # cập nhật địa chỉ
    public function update(Request $request)
    {
        $validationResult = $this->validateAddress($request);
        if ($validationResult !== true) {
            return redirect()->back()->with(noti($validationResult, 'error'));
        }
        $userId   = auth()->user()->id;
        $address  = Address::where('user_id', $userId)->where('id', $request->id)->first();

        $address->name       = $request->name;
        $address->phone       = $request->phone;
        $address->province_id    = $request->province_id;
        $address->district_id      = $request->district_id;
        $address->ward_id       = $request->ward_id;
        $address->village_id       = $request->village_id;
        if ($request->is_default == 1) {
            $prevDefault = Address::where('user_id', $userId)->where('is_default', 1)->first();
            if (!is_null($prevDefault)) {
                $prevDefault->is_default = 0;
                $prevDefault->save();
            }
        }
        $address->is_default    = $request->is_default;
        $address->address       = $request->address;
        $address->save();
        return redirect()->route('account')->with(noti('Cập nhật thông tin địa chỉ thành công', 'success'));
    }

    # xoá địa chỉ
    public function delete($id)
    {
        $user = auth()->user();
        Address::where('user_id', $user->id)->where('id', $id)->delete();
        return redirect()->route('account')->with(noti('Xoá thông tin địa chỉ thành công', 'success'));
    }
    public function getDistrict(Request $request)
    {
        $html = '<option value="">' . "Chọn Quận/Huyện" . '</option>';

        District::where('province_code', $request->province_id)->chunk(100, function ($districts) use (&$html) {
            foreach ($districts as $district) {
                $html .= '<option value="' . $district->code . '">' . $district->name . '</option>';
            }
        });

        return response($html);
    }


    public function getWard(Request $request)
    {
        $html = '<option value="">' . 'Chọn Phường/Xã' . '</option>';

        Ward::where('district_code', $request->district_id)->chunk(100, function ($wards) use (&$html) {
            foreach ($wards as $ward) {
                $html .= '<option value="' . $ward->code . '">' . $ward->name . '</option>';
            }
        });

        return response($html);
    }
    public function getVillage(Request $request)
    {
        $html = '<option value="">' . 'Chọn Thôn/Xóm' . '</option>';

        Village::where('ward_code', $request->ward_id)->chunk(100, function ($villages) use (&$html) {
            foreach ($villages as $village) {
                $html .= '<option value="' . $village->code . '">' . $village->name . '</option>';
            }
        });

        return response($html);
    }
}
