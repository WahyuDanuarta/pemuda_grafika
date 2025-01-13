<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriOperasionalsTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_operasionals', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_operasional', 100);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_operasionals');
    }
}
