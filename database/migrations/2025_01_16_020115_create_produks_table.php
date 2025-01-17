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
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk',255)->nullable(false);
            $table->unsignedBigInteger('harga')->nullable(false)->default(0);
            $table->unsignedBigInteger('kategori_id')->nullable(false);
            $table->unsignedBigInteger('status_id')->nullable(false);

            $table->foreign('kategori_id')->references('id_kategori')
                ->on('kategori')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('status_id')->references('id_status')
                ->on('status')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
