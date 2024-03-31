<?php

namespace App\Models;

use App\Enums\IsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => IsActiveEnum::class,
    ];

    //relationship one to one polimorphic
    public function image()
    {
        return $this->morphOne(Image::class, "imageable");
    }
}
