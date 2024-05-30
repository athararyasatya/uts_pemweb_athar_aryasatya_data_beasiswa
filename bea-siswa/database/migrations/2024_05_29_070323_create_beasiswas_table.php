<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswasTable extends Migration
{
    public function up()
    {
        Schema::create('beasiswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('nomor_telpon');
            $table->string('email');
            $table->string('alamat');
            $table->string('nama_orang_tua');
            $table->integer('umur');
            $table->string('paket_beasiswa');
            $table->string('foto_pelamar')->nullable();
            $table->string('dokumen')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('beasiswas');
    }
}

