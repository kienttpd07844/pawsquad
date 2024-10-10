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
}
