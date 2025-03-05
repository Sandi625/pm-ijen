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
        Schema::table('detail_penilaians', function (Blueprint $table) {
            $table->foreign(['penilaian_id'])->references(['id'])->on('penilaians')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['subkriteria_id'])->references(['id'])->on('subkriterias')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_penilaians', function (Blueprint $table) {
            $table->dropForeign('detail_penilaians_penilaian_id_foreign');
            $table->dropForeign('detail_penilaians_subkriteria_id_foreign');
        });
    }
};
