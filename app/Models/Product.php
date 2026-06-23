<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'count',
        'image',
        'slug',
        'category_id',
        'updated_at',
    ];
    public static function getBestSellers($limit = 4)
    {
        return self::select('products.*')
            ->join('order_items','products.id','=','order_items.product_id')
            ->selectRaw('sum(order_items.quantity ) as total_sold')
            ->groupBy('products.id')
            ->orderBy('total_sold','desc')
            ->limit($limit)
            ->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function orderitems()
    {
        return $this->hasMany(OrderItem::class,'product_id');
    }
}
