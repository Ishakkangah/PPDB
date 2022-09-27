<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlacklistsTable extends Migration
{
    public function up()
    {
        Schema::create('blacklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blacklists');
    }
}
