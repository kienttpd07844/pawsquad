<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    public $table ="wards";
    public $fillable=[
        'code',
        'name',
        'full_name',
        'code_name',
        'district_code'
    ];
     // Ward thuộc về một District
     public function district()
     {
         return $this->belongsTo(District::class, 'district_code', 'code');
     }

     public function villages()
     {
         return $this->hasMany(Village::class, 'ward_code', 'code');
     }
     public function province()
     {
         return $this->hasOneThrough(Province::class, District::class, 'code', 'code', 'district_code', 'province_code');
     }
}
