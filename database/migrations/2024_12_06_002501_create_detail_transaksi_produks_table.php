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
        Schema::create('detail_transaksi_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_produk_id')->constrained('transaksi_produks')->cascadeOnDelete();
            $table->foreignId('produk_id')->constrained('produks')->cascadeOnDelete();
            $table->integer('total_produk');  // Kolom untuk menyimpan total produk yang dibeli
            $table->decimal('total_harga', 10, 2);  // Kolom untuk menyimpan total harga (kuantitas * harga produk)
            $table->timestamps(); // Hanya sekali mendefinisikan timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_produks');
    }
};