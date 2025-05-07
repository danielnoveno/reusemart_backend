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
        Schema::create('kategoribarangs', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_KATEGORI')->primary();
            $table->string('NAMA_KATEGORI', 255);
            $table->integer('JML_PRODUK', 11)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoribarangs');
    }
};
