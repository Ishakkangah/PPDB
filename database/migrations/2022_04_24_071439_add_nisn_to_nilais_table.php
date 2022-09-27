<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNisnToNilaisTable extends Migration
{
    public function up()
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->unsignedBigInteger('nisn')->after('id');
        });
    }

    public function down()
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn('nisn');
        });
    }
}
