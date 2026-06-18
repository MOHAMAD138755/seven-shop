<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id','user_id','total_price','status','address','created_at'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
