<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntwortenBewerberPivotTable extends Migration
{
    public function up()
    {
        Schema::create('antworten_bewerber', function (Blueprint $table) {
            $table->unsignedInteger('bewerber_id');
            $table->foreign('bewerber_id', 'bewerber_id_fk_2557121')->references('id')->on('bewerbers')->onDelete('cascade');
            $table->unsignedInteger('antworten_id');
            $table->foreign('antworten_id', 'antworten_id_fk_2557121')->references('id')->on('antwortens')->onDelete('cascade');
        });
    }
}
