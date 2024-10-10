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
        return $this->hasManyThrough(VoucherUsage::class, VoucherType::class, 'id', 'name', 'voucher_type_id', 'name');
    }
}
