<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherUsage extends Model
{
    use HasFactory;
    protected $table = 'voucher_usages';
    protected $fillable = [
        'name',
        'user_id',
        'usage_count',
    ];
    public function voucherType()
    {
        return $this->belongsTo(VoucherType::class, 'name', 'name');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function voucher()
    {
        return $this->hasOneThrough(
            Voucher::class,         // 1. Mô hình mục tiêu muốn truy cập (Voucher)
            VoucherType::class,     // 2. Mô hình trung gian (VoucherType)
            'name',                 // 3. Khóa ngoại của mô hình trung gian (VoucherType) để liên kết với VoucherUsage
            'voucher_type_id',      // 4. Khóa ngoại của mô hình mục tiêu (Voucher) mà bạn muốn lấy thông tin
            'name',                 // 5. Khóa ngoại của mô hình hiện tại (VoucherUsage) để liên kết với mô hình trung gian
            'id'                    // 6. Khóa chính trong mô hình trung gian (VoucherType) để liên kết với mô hình mục tiêu
        );
    }



}
