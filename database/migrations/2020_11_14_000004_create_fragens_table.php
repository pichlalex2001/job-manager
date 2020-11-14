<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragensTable extends Migration
{
    public function up()
    {
        Schema::create('fragens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question');
            $table->timestamps();
        });
    }
}
