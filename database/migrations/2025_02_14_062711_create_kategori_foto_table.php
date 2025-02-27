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
        Schema::create('kategori_foto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foto_id')->constrained('fotos')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_foto');
    }
};
