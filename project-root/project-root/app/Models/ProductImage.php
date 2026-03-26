<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image_path)) {
            return filter_var($this->image_path, FILTER_VALIDATE_URL)
                ? $this->image_path
                : asset($this->image_path);
        }

        return 'https://via.placeholder.com/600x600?text=No+Image';
    }
}