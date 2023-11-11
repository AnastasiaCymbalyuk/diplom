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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('hall_id');
            $table->string('time');
            $table->integer('movie_id');
            $table->timestamps();
            $table->index('hall_id', 'session_hall_idx');
            $table->foreign('hall_id', 'session_hall_fk')->on('halls')->references('id')->onDelete('cascade');
            $table->foreign('movie_id', 'session_movie_fk')->on('movies')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
