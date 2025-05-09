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
        Schema::create('transaksi_pembelian_barangs', function (Blueprint $table) {
            $table->id('ID_TRANSAKSI_PEMBELIAN');
            $table->unsignedBigInteger('ID_PEMBELI');
            $table->string('BUKTI_TRANSFER', 255);
            $table->date('TGL_AMBIL_KIRIM');
            $table->date('TGL_LUNAS_PEMBELIAN');
            $table->date('TGL_PESAN_PEMBELIAN');
            $table->float('TOT_HARGA_PEMBELIAN');
            $table->string('STATUS_TRANSAKSI', 255);
            $table->string('DELIVERY_METHOD', 255);
            $table->float('ONGKOS_KIRIM');
            $table->integer('POIN_DIDAPAT');
            $table->integer('POIN_POTONGAN');
            $table->string('STATUS_TRANSAKSI_PEMBELIAN', 255);
            $table->foreign('ID_PEMBELI')
                ->references('ID_PEMBELI')
                ->on('pembelis')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembelian_barangs');
    }
};
