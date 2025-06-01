<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 料理名
            $table->foreignId('genre_id'); // ジャンルID
            $table->json('materials'); // 材料
            $table->string('image_path'); // 画像パス
            $table->text('memo'); // 料理メモor参考サイトURL
            $table->boolean('favorite_flg')->default(false); // デフォルトは「お気に入りじゃない」
            $table->timestamps(); // 作成日・更新日
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
