<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuDay extends Model
{
    // リレーション
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}
