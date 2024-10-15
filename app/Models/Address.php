<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $table = "addresses";
    public $fillable=[
        'user_id',
        'name',
        'phone',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'village_id',
        'is_default',
    ];
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'code');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'code');
    }
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'code');
    }
}
