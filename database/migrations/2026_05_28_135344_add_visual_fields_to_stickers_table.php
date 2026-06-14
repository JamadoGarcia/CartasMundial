<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stickers', function (Blueprint $table) {

            $table->string('rarity')
                ->default('common');

            $table->boolean('is_special')
                ->default(false);

            $table->string('background_color')
                ->nullable();

            $table->string('image_url')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('stickers', function (Blueprint $table) {

            $table->dropColumn([
                'rarity',
                'is_special',
                'background_color',
                'image_url',
            ]);
        });
    }
};