<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'name',
        'status',
    ];

    public function SubCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function ChildCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }
}
