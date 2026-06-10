<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content','user_id','product_id','parent_id','status','created_at','updated_at'
    ];
}
