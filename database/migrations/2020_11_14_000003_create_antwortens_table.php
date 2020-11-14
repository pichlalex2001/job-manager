<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntwortensTable extends Migration
{
    public function up()
    {
        Schema::create('antwortens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('answer');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
