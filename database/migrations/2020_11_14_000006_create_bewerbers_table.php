<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBewerbersTable extends Migration
{
    public function up()
    {
        Schema::create('bewerbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tel');
            $table->string('email')->unique();
            $table->string('status');
            $table->timestamps();
        });
    }
}
