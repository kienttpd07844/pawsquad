<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'image',
        'slug',
        'parent_id',
        'views',
        'status',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'views' => 'integer',
        'status' => 'integer',
        'parent_id' => 'integer'
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            // Ngăn không cho xoá danh mục mặc định
            if ($category->id == self::defaultCategory()->id) {
                throw new \Exception("Không thể xoá danh mục này.");
            }
            // Chuyển danh mục con sang danh mục mặc định
            $defaultCategory = self::defaultCategory();
            $category->children()->update(['parent_id' => $defaultCategory->id]);

            // Chuyển sản phẩm thuộc danh mục sang danh mục mặc định
            $category->products()->update(['category_id' => $defaultCategory->id]);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public static function defaultCategory()
    {
        return self::firstOrCreate(['slug' => 'uncategorized'], [
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'image' => 'public/assets/clients/uploads/13-09-2024/abf94830_nSTKZ6jEZm.webp',
            'status' => 0,
        ]);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
