<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_produk', 50);
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->string('image', 255)->nullable();
            $table->foreignId('kategori_id')->constrained('kategori_produks')->onDelete('cascade');
            $table->unsignedBigInteger('view_count')->default(0); // Kolom untuk menghitung jumlah tampilan
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
