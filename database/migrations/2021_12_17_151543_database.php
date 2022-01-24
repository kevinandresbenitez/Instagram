<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Database extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

      Schema::create('users', function (Blueprint $table) {
          $table->id();
          $table->string('name')->unique();
          $table->string('email')->unique();
          $table->string('password');
          $table->string('img')->nullable();
          $table->rememberToken();
          $table->timestamps();
      });

      Schema::create('publications', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->string('description')->nullable();
          $table->string('img');
          $table->timestamps();


          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

      });

      Schema::create('likes', function(Blueprint $table){
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('publication_id');
        $table->timestamps();


        $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        $table->foreign('publication_id')->references('id')->on('publications')->onUpdate('cascade')->onDelete('cascade');

      });

      Schema::create('comments', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('publication_id');
          $table->string('description');
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('publication_id')->references('id')->on('publications')->onUpdate('cascade')->onDelete('cascade');          
      });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
