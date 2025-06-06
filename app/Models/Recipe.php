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

    protected $casts = [
        'materials' => 'array', // ← JSONとして扱う
    ];

    protected $fillable = [
        'name',
        'genre_id',
        'materials',
        'image_path',
        'memo',
        'favorite_flg',
    ];
}
