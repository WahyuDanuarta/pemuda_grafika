<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiOperasionalsTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi_operasionals', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('keterangan', 100);
            $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete(); // Relasi ke tabel admins
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi_operasionals');
    }
}
