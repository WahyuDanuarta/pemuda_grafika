<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiProduksTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi_produks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama', 100);
            $table->text('keterangan')->nullable();
            $table->string('alamat', 255);
            $table->enum('status', [
                'pesanan diterima', 
                'proses desain', 
                'proses revisi', 
                'proses cetak', 
                'bisa diambil', 
                'sudah diambil (selesai)', 
                'pesanan batal'
            ]);
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_produks');
    }
}