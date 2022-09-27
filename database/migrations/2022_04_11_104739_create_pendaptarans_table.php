<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaptaransTable extends Migration
{
    public function up()
    {
        Schema::create('pendaptarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('alamat');
            $table->foreignId('file_id')->unique();
            $table->foreignId('nilai_id')->unique();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaptarans');
    }
}
