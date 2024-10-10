<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    use HasFactory;
    protected $table = 'voucher_types';
    protected $fillable = [
        'name',
        'discount',
        'min_spend',
        'customer_usage_limit',
        'discount_type',
    ];
    public function vouchers()
    {
        return $this->hasMany(Voucher::class, 'voucher_type_id', 'id');
    }
    public function usages()
    {
        return $this->hasMany(VoucherUsage::class, 'name', 'name');
    }

}
