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
        Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // Nama Produk
        $table->text('description');       // Deskripsi Produk
        $table->decimal('price', 12, 2);  // Harga Produk
        $table->integer('stock');          // Jumlah Stok
        $table->string('image')->nullable(); // Foto Produk
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
