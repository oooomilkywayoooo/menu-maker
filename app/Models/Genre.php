<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // リレーション
    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
