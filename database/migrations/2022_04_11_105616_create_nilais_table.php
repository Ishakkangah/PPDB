<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('b_indonesia');
            $table->foreignId('b_inggris');
            $table->foreignId('matematika');
            $table->foreignId('ipa');
            $table->foreignId('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}
