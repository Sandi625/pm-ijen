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
        Schema::table('subkriterias', function (Blueprint $table) {
            $table->foreign(['kriteria_id'])->references(['id'])->on('kriterias')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subkriterias', function (Blueprint $table) {
            $table->dropForeign('subkriterias_kriteria_id_foreign');
        });
    }
};
