<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name . '-' . uniqid());
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name . '-' . uniqid());
        });
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
