<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner',
        'shop_name',
        'phone',
        'email',
        'address',
        'description',
        'fb_link',
        'ins_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
