<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderUpdate extends Model
{
    use HasFactory;

    public $table="order_updates";
    public $fillable=[
        'order_id',
        'user_id',
        'note'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
