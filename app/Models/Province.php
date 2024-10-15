<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    public $table = "provinces";
    public $fillable=[
        'code',
        'name',
        'full_name',
        'code_name',
    ];
    public function districts()
    {
        return $this->hasMany(District::class, 'province_code', 'code');
    }
}
