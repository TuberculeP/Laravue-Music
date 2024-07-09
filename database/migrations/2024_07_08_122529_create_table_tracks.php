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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->boolean('visible')->default(true);
            $table->string('artist');
            $table->string('image')->nullable();
            $table->string('album');
            $table->string('title');
            $table->string('music');
            $table->integer('play_count')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_tracks');
    }
};
