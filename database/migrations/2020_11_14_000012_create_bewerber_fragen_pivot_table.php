<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBewerberFragenPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bewerber_fragen', function (Blueprint $table) {
            $table->unsignedInteger('bewerber_id');
            $table->foreign('bewerber_id', 'bewerber_id_fk_2557087')->references('id')->on('bewerbers')->onDelete('cascade');
            $table->unsignedInteger('fragen_id');
            $table->foreign('fragen_id', 'fragen_id_fk_2557087')->references('id')->on('fragens')->onDelete('cascade');
        });
    }
}
