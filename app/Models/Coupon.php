<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code','type','max_discount_amount','min_order_amount',
        'usage_limit','used_count','start_at','expires_at','is_active'
    ];
}
