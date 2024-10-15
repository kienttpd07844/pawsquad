<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public $table = "districts";
    public $fillable=[
        'code',
        'name',
        'full_name',
        'code_name',
        'province_code',
    ];
     // District thuộc về một Province
     public function province()
     {
         return $this->belongsTo(Province::class, 'province_code', 'code');
     }

     // District có nhiều Wards
     public function wards()
     {
         return $this->hasMany(Ward::class, 'district_code', 'code');
     }
}
