<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alat_id')->constrained('alats')->cascadeOnDelete();
            $table->string('nama_peminjam');
            $table->unsignedInteger('jumlah');
            $table->date('tanggal_pinjam');
            $table->string('status')->default('dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};