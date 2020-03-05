<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id_comment');
            $table->unsignedBigInteger('fk_user');
            $table->unsignedBigInteger('fk_image');
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('fk_user')->references('id_user')->on('users');
            $table->foreign('fk_image')->references('id_image')->on('images');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}