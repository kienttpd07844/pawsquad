<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Brand extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'brands';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'meta_title',
        'meta_description',
        'status'
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            if ($category->id == self::defaultBrand()->id) {
                throw new \Exception("Không thể xoá nhãn hàng này.");
            }
            $defaultBrand = self::defaultBrand();
            // Chuyển sản phẩm thuộc nhãn hàng sang nhãn hàng mặc định
            $category->products()->update(['brand_id' => $defaultBrand->id]);
        });
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
    public static function defaultBrand()
    {
        return self::firstOrCreate(['slug' => 'uncategorized'], [
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'logo' => 'public/assets/clients/uploads/13-09-2024/abf94830_nSTKZ6jEZm.webp',
            'status' => 0,
        ]);
    }

}
