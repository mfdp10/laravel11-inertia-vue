<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    //relationship one to many polimorphic
    public function pictures()
    {
        return $this->morphMany(Picture::class, "pictureable");
    }
}
