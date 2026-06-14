<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::dropIfExists('stickers');
        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete();
            $table->string('section'); // country, panini, cocacola, history
            $table->string('number'); // 00, FWC 1, CC1, ARG 1, etc.
            $table->string('name');
            $table->boolean('is_owned')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('stickers');
    }
};