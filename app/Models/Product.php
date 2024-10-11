<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory,SoftDeletes;
    public $asYouType = true;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'slug',
        'name',
        'image',
        'image_list',
        'short_description',
        'description',
        'old_price',
        'price',
        'details',
        'min_price',
        'max_price',
        'has_variation',
        'brand_id',
        'category_id',
        'status',
        'views',
        'meta_title',
        'meta_description',
        'featured',
        'stock_qty'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function variation_combinations()
    {
        return $this->hasMany(ProductVariationCombination::class);
    }
    public function without_variation_combinations()
    {
        $withoutVariationIds  = Variations::pluck('id')->toArray();
        return $this->hasMany(ProductVariationCombination::class)->whereIn('variation_id',$withoutVariationIds);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
