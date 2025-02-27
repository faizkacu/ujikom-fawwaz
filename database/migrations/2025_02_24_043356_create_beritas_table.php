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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->foreignId('foto_id')->nullable()->constrained('fotos')->onDelete('set null');
            $table->foreignId('created_by')->constrained('petugas')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('petugas')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('berita_kategori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berita_id')->constrained('beritas')->onDelete('cascade');
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
        Schema::dropIfExists('berita_kategori');
    }
};
