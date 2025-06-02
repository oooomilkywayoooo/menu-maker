<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    // リレーション
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
