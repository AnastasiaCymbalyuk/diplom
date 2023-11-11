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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('place_id');
            $table->integer('session_id');
            $table->string('date');
            $table->string('type');
            $table->integer('price');
            $table->integer('row');
            $table->integer('place');
            $table->string('qr');
            $table->timestamps();
            $table->foreign('place_id', 'ticket_place_fk')->on('places')->references('id')->onDelete('cascade');
            $table->foreign('session_id', 'ticket_session_fk')->on('sessions')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
