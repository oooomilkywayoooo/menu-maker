<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    // リレーション
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function menuDay()
    {
        return $this->belongsTo(MenuDay::class);
    }

    protected $fillable = ['menu_day_id', 'recipe_id', 'day_of_week'];
}
