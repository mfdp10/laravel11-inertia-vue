<?php

namespace App\Models;

use App\Enums\IsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => IsActiveEnum::class,
    ];

    //relationship one to many polimorphic
    public function pictures()
    {
        return $this->morphMany(Picture::class, "pictureable");
    }

    //Many to many relationship
    public function product_categories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
}
