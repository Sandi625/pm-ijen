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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama', 150);
            $table->string('email', 150)->unique();
            $table->string('nomor_telp', 20);
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_paket');
            $table->date('tanggal_pesan');
            $table->date('tanggal_keberangkatan');
            $table->integer('jumlah_peserta');

            // Kolom tambahan
            $table->string('negara', 100)->nullable();
            $table->string('bahasa', 100)->nullable();
            $table->text('riwayat_medis')->nullable();

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('id_kriteria')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('id_paket')->references('id')->on('pakets')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
