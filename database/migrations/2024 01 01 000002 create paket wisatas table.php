<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_wisatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi');
            $table->text('itinerary');
            $table->decimal('harga_per_orang', 12, 2);
            $table->string('destinasi');
            $table->integer('durasi_hari');
            $table->integer('min_peserta')->default(1);
            $table->integer('max_peserta')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_wisatas');
    }
};