<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
    use HasFactory;
    public $asYouType = true;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
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
        'featured'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
