<?php

namespace App\Jobs;

use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Ward;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use GuzzleHttp\Promise;

class SaveAddressData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $dataChunk;
    protected $type;

    /**
     * Create a new job instance.
     *
     * @param array $dataChunk
     * @param string $type
     */
    public function __construct($dataChunk, $type)
    {
        $this->dataChunk = $dataChunk;
        $this->type = $type;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        switch ($this->type) {
            case 'provinces':
                foreach ($this->dataChunk as $provinceData) {
                    Province::updateOrCreate(
                        ['code' => $provinceData['code']],
                        [
                            'name' => $provinceData['name'],
                            'full_name' => $provinceData['name'],
                            'code_name' => $provinceData['codename']
                        ]
                    );
                }
                break;

            case 'districts':
                foreach ($this->dataChunk as $districtData) {
                    District::updateOrCreate(
                        ['code' => $districtData['code']],
                        [
                            'name' => $districtData['name'],
                            'full_name' => $districtData['name'],
                            'code_name' => $districtData['codename'],
                            'province_code' => $districtData['province_code']
                        ]
                    );
                }
                break;

            case 'wards':
                foreach ($this->dataChunk as $wardData) {
                    Ward::updateOrCreate(
                        ['code' => $wardData['code']],
                        [
                            'name' => $wardData['name'],
                            'full_name' => $wardData['name'],
                            'code_name' => $wardData['codename'],
                            'district_code' => $wardData['district_code']
                        ]
                    );
                }
                break;

            case 'villages':
                // Chunk dữ liệu xã thành từng phần nhỏ
                Ward::chunk(1000, function ($wards) {
                    foreach ($wards as $ward) {
                        // Gọi API để lấy dữ liệu thôn/xóm cho từng xã
                        $responseVillages = Http::withHeaders([
                            'Token' => '58af67f3bcefcda991ed65b85c909923b1b8303f',
                            'X-Client-Source' => 'S22746448',
                        ])->get('https://services.giaohangtietkiem.vn/services/address/getAddressLevel4', [
                            'province' => $ward->province->name,
                            'district' => $ward->district->name,
                            'ward_street' => $ward->name,
                        ]);

                        if ($responseVillages->successful()) {
                            $villagesData = $responseVillages->json();
                            if ($villagesData['success'] && isset($villagesData['data'])) {
                                $villages = $villagesData['data'];

                                foreach ($villages as $villageName) {
                                    // Kiểm tra xem thôn đã tồn tại chưa dựa vào tên và ward_code
                                    $existingVillage = Village::where('name', $villageName)
                                                              ->where('ward_code', $ward->code)
                                                              ->first();

                                    // Nếu không tồn tại thì lưu ngay
                                    if (!$existingVillage) {
                                        try {
                                            $village = Village::create([
                                                'name' => $villageName,
                                                'full_name' => $villageName,
                                                'code_name' => Str::slug($villageName, '_'),
                                                'ward_code' => $ward->code,
                                                'code' => null,
                                            ]);
                                            $village->code = $village->id;
                                            $village->save();

                                            // Log lưu thành công
                                            // Log::info('Lưu village id: ' . $village->id . ' tên: ' . $villageName . ' cho ward: ' . $ward->name);
                                        } catch (\Exception $e) {
                                            // Log lỗi nếu không thể lưu dữ liệu vào database
                                            Log::error('Lỗi khi lưu village: ' . $villageName . ' cho ward: ' . $ward->name . ' - ' . $e->getMessage());
                                        }
                                    }
                                }
                            } else {
                                Log::warning('Không có dữ liệu thôn/xóm từ API cho ward: ' . $ward->name);
                            }
                        } else {
                            Log::error('Lỗi khi lấy dữ liệu thôn/xóm từ API: ' . $responseVillages->body());
                        }
                    }
                });
                break;








                // Chunk dữ liệu thôn/xóm thành từng phần nhỏ
                                // collect($villages)->chunk(500)->each(function ($villageChunk) use ($ward) {
                                //     foreach ($villageChunk as $villageName) {
                                //         try {
                                //             $village = Village::create([
                                //                 'name' => $villageName,
                                //                 'full_name' => $villageName,
                                //                 'code_name' => Str::slug($villageName, '_'), // Sử dụng slug cho code_name
                                //                 'ward_code' => $ward->code,
                                //                 'code' => null
                                //             ]);
                                //             $village->code = $village->id;
                                //             $village->save();

                                //             // Log::info('Lưu village id: ' .  $village->id . ' tên: ' . $villageName . ' cho ward: ' . $ward->name);
                                //         } catch (\Exception $e) {
                                //             // Log lỗi nếu không thể lưu dữ liệu vào database
                                //             Log::error('Lỗi khi lưu village: ' . $villageName . ' cho ward: ' . $ward->name . ' - ' . $e->getMessage());
                                //         }
                                //     }
                                // });
        }
    }
}
