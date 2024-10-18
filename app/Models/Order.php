<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $table = "orders";
    public $fillable = [
        'total_amount',
        'user_id',
        'order_date',
        'coupon_id',
        'order_status',
        'shipment_status',
        'rating_id',
        'payment_method',
        'payment_id',
        'address_id',
        'note',
        'coupon_discount_amount',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function orderItems()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function scopeIsDelivered($query)
    {
        return $query->where('shipment_status', 'DELIVERED');
    }
    public function scopeIsOutForDelivery($query)
    {
        return $query->where('shipment_status', 'SHIPPED');
    }
    public function scopeIsPlacedOrPending($query)
    {
        return $query->where('shipment_status', 'ORDERPLACE');
    }
    public function scopeIsCancel($query)
    {
        return $query->where('order_status', 'CANCEL')->orWhere('shipment_status','RETURNED');
    }
    public function orderUpdates()
    {
        return $this->hasMany(OrderUpdate::class, 'order_id', 'id');
    }
}
