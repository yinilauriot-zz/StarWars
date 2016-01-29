<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); //primary key
            $table->string('name'); //varchar
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('role', ['administrator', 'editor', 'visitor'])->default('editor'); // enum: liste des valeurs possibles dans ce champ
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
