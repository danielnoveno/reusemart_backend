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
        Schema::create('merchandises', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_MERCHANDISE')->primary();
            $table->string('NAMA_MERCHANDISE', 255);
            $table->integer('POIN_DIBUTUHKAN', 11)->default(0);
            $table->integer('JUMLAH', 11)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandises');
    }
};
