<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Create
        static::creating(function ($category) {
            $category->slug = self::generateSlug($category->name);
        });

        // Update
        static::updating(function ($category) {
            $category->slug = self::generateSlug($category->name);
        });
    }

    protected static function generateSlug($name)
    {
        $slug = Str::slug($name);

        // cek slug yang sama
        $count = self::where('slug', 'LIKE', "$slug%")->count();

        return $count ? $slug . '-' . ($count + 1) : $slug;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
