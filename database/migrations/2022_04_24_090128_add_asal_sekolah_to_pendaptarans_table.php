<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAsalSekolahToPendaptaransTable extends Migration
{
    public function up()
    {
        Schema::table('pendaptarans', function (Blueprint $table) {
            $table->string('asal_sekolah')->after('nama');
        });
    }

    public function down()
    {
        Schema::table('pendaptarans', function (Blueprint $table) {
            $table->dropColumn('asal_sekolah');
        });
    }
}
