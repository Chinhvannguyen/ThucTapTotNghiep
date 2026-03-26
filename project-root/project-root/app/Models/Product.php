<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'price',
        'sale_price',
        'stock',
        'thumbnail',
        'short_description',
        'description',
        'care_instructions',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getFinalPriceAttribute(): float
    {
        return (float) ($this->sale_price ?: $this->price);
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            return filter_var($this->thumbnail, FILTER_VALIDATE_URL)
                ? $this->thumbnail
                : asset($this->thumbnail);
        }

        $primaryImage = $this->images->firstWhere('is_primary', true);

        if ($primaryImage && !empty($primaryImage->image_path)) {
            return filter_var($primaryImage->image_path, FILTER_VALIDATE_URL)
                ? $primaryImage->image_path
                : asset($primaryImage->image_path);
        }

        return 'https://via.placeholder.com/600x600?text=No+Image';
    }
}