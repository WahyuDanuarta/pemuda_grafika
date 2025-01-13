<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriProduksTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_produks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_kategori', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_produks');
    }
}
