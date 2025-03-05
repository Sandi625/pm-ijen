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
        Schema::create('guides', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama_guide', 100);
            $table->decimal('salary', 10, 2);
            $table->unsignedBigInteger('kriteria_id')->nullable(); //tidak usah di isi pada saat create tapi ditampilkan saja kriteria nya
            $table->text('deskripsi_guide')->nullable();
            $table->string('nomer_hp', 20);
            $table->boolean('status')->default(1);
            $table->text('alamat')->nullable();
            $table->string('email')->unique();
            $table->string('foto')->nullable();
            $table->string('bahasa', 100);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guides');
    }


    /**
     * Reverse the migrations.
     */

};
