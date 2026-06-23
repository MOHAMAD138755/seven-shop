<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $fillable = [
        'name',
        'english_name',
    ];

    public static function getCategoryVersion()
    {
        return Cache::remember('categories_version', 86400, function () {
            return 1;
        });
    }

    private static function incrementCategoryVersion()
    {
        Cache::increment('categories_version');
    }

    public static function getAllCached($perPage = 10)
    {
        $page = request()->get('page', 1);

        $version = self::getCategoryVersion();

        $cacheKey = "v{$version}_p{$perPage}_page_{$page}";

        return Cache::remember($cacheKey, 86400, function () use ($perPage) {
            return self::with('products')->paginate($perPage);
        });
    }

    protected static function booted()
    {
        static::saved(fn() => self::incrementCategoryVersion());
        static::deleted(fn() => self::incrementCategoryVersion());
        static::created(fn() => self::incrementCategoryVersion());
        static::updated(fn() => self::incrementCategoryVersion());
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
