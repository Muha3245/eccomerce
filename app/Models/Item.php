<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'main_image', 'price', 'quantity',
        'sizes', 'additional_information', 'description',
        'subcategory_id'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function itemImages() // Changed from `images` to `itemImages` for consistency
    {
        return $this->hasMany(ItemImage::class);
    }
}


