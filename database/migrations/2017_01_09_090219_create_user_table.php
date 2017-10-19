<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users',function(Blueprint $table){
            $table->increments('id');
            $table->string('email');
            $table->string('username');
            $table->string('password');
            $table->string('picture')->default('default.jpg');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->string('remember_token')->nullable();
            $table->boolean('admin');
            $table->boolean('charity');
            $table->timestamps();
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
        Schema::drop('users');
    }
}
