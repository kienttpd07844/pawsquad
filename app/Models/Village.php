<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;
    public $table="villages";
    public $fillable=[
        'code',
        'name',
        'full_name',
        'code_name',
        'ward_code'
    ];
}
