<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariationValues extends Model
{
    use HasFactory, SoftDeletes;
    public $table = "variation_values";
    protected $fillable = [
        'variation_id',
        'name',
        'status',
    ];
    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }
    public function variation()
    {
        return $this->belongsTo(Variations::class, 'variation_id', 'id');
    }
}
