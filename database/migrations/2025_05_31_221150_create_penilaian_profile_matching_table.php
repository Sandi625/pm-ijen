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
        Schema::create('penilaian_profile_matching', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelanggan_id'); // id pelanggan yang dinilai
            $table->unsignedBigInteger('guide_id')->nullable(); // opsional, kalau terkait guide
            $table->unsignedBigInteger('penilaian_id')->nullable(); // opsional, jika ada link ke penilaian umum

            $table->json('nilai_kriteria')->nullable(); // menyimpan nilai kriteria dalam json (key: id_kriteria, value: nilai)
            $table->float('nilai_total')->default(0); // total nilai profile matching
            $table->string('kriteria_unggulan')->nullable(); // nama kriteria unggulan

            $table->timestamps();

            // Foreign key constraints (jika tabel lain sudah ada)
            $table->foreign('pelanggan_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guide_id')->references('id')->on('guides')->onDelete('set null');
            $table->foreign('penilaian_id')->references('id')->on('penilaians')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_profile_matching');
    }
};
