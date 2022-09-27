<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatawalisTable extends Migration
{
    public function up()
    {
        Schema::create('datawalis', function (Blueprint $table) {
                $table->id();
                $table->string('nama_ayah');
                $table->date('tanggal_lahir_ayah');
                $table->string('perkerjaan_ayah');
                $table->unsignedBigInteger('nomor_ktp_ayah');
                $table->string('agama_ayah');
                $table->string('alamat_ayah');
                $table->string('pendidikan_ayah');
                $table->string('nama_ibu');
                $table->date('tanggal_lahir_ibu');
                $table->string('perkerjaan_ibu');
                $table->unsignedBigInteger('nomor_ktp_ibu');
                $table->string('agama_ibu');
                $table->string('alamat_ibu');
                $table->string('pendidikan_ibu');
                $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('datawalis');
    }
}
