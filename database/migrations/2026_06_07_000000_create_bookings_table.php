<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_booking')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('paket_wisata_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_berangkat');
            $table->integer('jumlah_peserta');
            $table->decimal('total_harga', 12, 2);
            $table->text('catatan')->nullable();
            $table->enum('status', ['Pending', 'Dikonfirmasi', 'Berlangsung', 'Selesai', 'Ditolak'])->default('Pending');
            $table->text('alasan_tolak')->nullable();
            $table->boolean('pembayaran_diterima')->default(false);
            $table->timestamp('pembayaran_diterima_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};