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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id('ID_BARANG');
            $table->unsignedBigInteger('ID_KATEGORI');
            $table->string('NAMA_BARANG', 255);
            $table->string('KODE_BARANG', 5);
            $table->float('HARGA_BARANG');
            $table->date('TGL_MASUK');
            $table->date('TGL_KELUAR')->nullable();
            $table->date('TGL_AMBIL')->nullable();
            $table->date('GARANSI')->nullable();
            $table->integer('BERAT')->nullable();
            $table->string('DESKRIPSI', 1000);
            $table->float('RATING')->default(0);
            $table->string('STATUS_BARANG', 255);
            $table->foreign('ID_KATEGORI')
                ->references('ID_KATEGORI')
                ->on('kategoribarangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
