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
        Schema::create('detail_transaksi_operasionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_operasional_id')->constrained('transaksi_operasionals')->cascadeOnDelete();
            $table->foreignId('kategori_operasional_id')->nullable()->constrained('kategori_operasionals')->cascadeOnDelete(); // Menambahkan nullable()
            $table->decimal('biaya', 10, 2);
            $table->decimal('total_pengeluaran', 10, 2); // Harga per item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi_operasionals');
    }
};
