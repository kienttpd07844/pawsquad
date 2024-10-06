<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Variations extends Model
{
    use HasFactory,SoftDeletes;
    public $table="variations";
    protected $fillable = [
        'name',
        'status',
    ];
    public function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }
    public function variation_values()
    {
        return $this->hasMany(VariationValues::class,'variation_id','id');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            if ($category->id == self::defaultVariations()->id) {
                throw new \Exception("Không thể xoá biến thể này.");
            }
            // Chuyển biến thể con sang biến thể mặc định
            $defaultVariations = self::defaultVariations();
            $category->variation_values()->update(['variation_id' => $defaultVariations->id]);
        });
    }


    public static function defaultVariations()
    {
        return self::firstOrCreate(['id' => 1], [
            'name' => 'Uncategorized',
            'status' => 0,
        ]);
    }
}
