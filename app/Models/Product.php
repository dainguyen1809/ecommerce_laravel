<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumb_image',
        'vendor',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',
        'sku',
        'price',
        'offer_price',
        'quantity',
        'video_link',
        'short_description',
        'long_description',
        'product_type',
        'status',
        'seo_title',
        'seo_description',
    ];
}
