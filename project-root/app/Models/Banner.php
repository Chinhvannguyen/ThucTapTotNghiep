<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'image',
        'button_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            return filter_var($this->image, FILTER_VALIDATE_URL)
                ? $this->image
                : asset($this->image);
        }

        return 'https://via.placeholder.com/1200x500?text=Banner';
    }
}