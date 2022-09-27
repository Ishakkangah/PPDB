<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToDatawalisTable extends Migration
{
    public function up()
    {
        Schema::table('datawalis', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id');
        });
    }

    public function down()
    {
        Schema::table('datawalis', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
