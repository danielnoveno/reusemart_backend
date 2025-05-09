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
        Schema::create('requests', function (Blueprint $table) {
            $table->id('ID_REQUEST');
            $table->unsignedBigInteger('ID_ORGANISASI');
            $table->unsignedBigInteger('ID_BARANG');
            $table->date('CREATE_AT')->nullable();
            $table->string('DESKRIPSI_REQUEST', 255)->nullable();
            $table->string('STATUS_REQUEST', 255)->nullable();
            $table->foreign('ID_ORGANISASI')
                ->references('ID_ORGANISASI')
                ->on('organisasis')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('ID_BARANG')
                ->references('ID_BARANG')
                ->on('BARANGs')
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
        Schema::dropIfExists('requests');
    }
};
