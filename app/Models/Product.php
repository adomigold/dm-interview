<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'department_id',
        'category_id',
        'creator_id',
    ];

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->creator_id = auth()->id();
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFirstMediaUrlAttribute()
    {
        return $this->getMedia('product-images')->last()?->getUrl();
    }
    
}
