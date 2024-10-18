<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $table="order_details";
    public $fillable=[
        'quantity',
        'product_variation_id',
        'order_id'
    ];
    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class,'product_variation_id','id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
