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
        Schema::create('fotos', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file');
            $table->foreignId('galeri_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->nullable()->constrained('petugas')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('petugas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos');
    }
};
