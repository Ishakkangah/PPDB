<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriTable extends Migration
{
    public function up()
    {
        Schema::create('blog_categori', function (Blueprint $table) {
            $table->foreignId('blog_id');
            $table->foreignId('categori_id');
            $table->primary(['blog_id', 'categori_id']);
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('categori_id')->references('id')->on('categoris')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_categori');
    }
}
