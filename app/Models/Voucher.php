<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = [
        'name',
        'start_date',
        'expired_date',
        'voucher_type_id',
        'voucher_quantity',
        'index',
    ];
    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class, 'voucher_type_id', 'id');
    }

    public function usages()
{
    return $this->hasManyThrough(
        VoucherUsage::class,      // 1. Mô hình mục tiêu mà bạn muốn lấy thông tin (VoucherUsage)
        VoucherType::class,       // 2. Mô hình trung gian (VoucherType)
        'id',                     // 3. Khóa chính trong mô hình trung gian (VoucherType) để kết nối với mô hình hiện tại
        'name',                   // 4. Khóa ngoại trong mô hình mục tiêu (VoucherUsage) để liên kết với mô hình trung gian
        'voucher_type_id',       // 5. Khóa ngoại trong mô hình hiện tại (Voucher) để liên kết với mô hình trung gian
        'name'                   // 6. Khóa ngoại trong mô hình trung gian (VoucherType) để kết nối với mô hình mục tiêu
    );
}

}
