<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorisTable extends Migration
{
    public function up()
    {
        Schema::create('categoris', function (Blueprint $table) {
            $table->id();
            $table->string('categoryName');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categoris');
    }
}
