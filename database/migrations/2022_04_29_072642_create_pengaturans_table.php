<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturansTable extends Migration
{
    public function up()
    {
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->date('batas_pendaptaran')->default(now());
            $table->date('batas_umur')->default(now());
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengaturans');
    }
}
