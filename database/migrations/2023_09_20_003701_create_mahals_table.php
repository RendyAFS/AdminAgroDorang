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
        Schema::create('mahals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_product');
            $table->string('harga_product');
            $table->text('deskripsi_product');
            $table->string('stok_product');
            $table->string('gambar_product');
            $table->foreignId('satuans_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahals');
    }
};
