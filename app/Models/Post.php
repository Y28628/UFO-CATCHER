<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'store_name',
        'fee',
        'body',
        'series', 
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

