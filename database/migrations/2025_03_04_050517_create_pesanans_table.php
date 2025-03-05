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
            $table->unsignedBigInteger('id_kriteria');
            $table->unsignedBigInteger('id_paket');
            $table->date('tanggal_pesan');
            $table->date('tanggal_keberangkatan');
            $table->integer('jumlah_peserta');
            $table->timestamps();

            // Foreign key constraints

            $table->foreign('id_kriteria')->references('id')->on('kriterias')->onDelete('cascade');
            $table->foreign('id_paket')->references('id')->on('pakets')->onDelete('cascade'); // Tambahkan foreign key ke pakets

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
