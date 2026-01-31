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
        Schema::create('specifications', function (Blueprint $table) {
        $table->id('id_spec');
        $table->foreignId('id_article')->constrained('articles')->cascadeOnDelete();
        $table->string('location');
        $table->string('ticket_price');
        $table->text('fasilitation')->nullable();
        $table->string('bundle')->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
