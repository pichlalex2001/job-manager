<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFragenJobPivotTable extends Migration
{
    public function up()
    {
        Schema::create('fragen_job', function (Blueprint $table) {
            $table->unsignedInteger('job_id');
            $table->foreign('job_id', 'job_id_fk_2557064')->references('id')->on('jobs')->onDelete('cascade');
            $table->unsignedInteger('fragen_id');
            $table->foreign('fragen_id', 'fragen_id_fk_2557064')->references('id')->on('fragens')->onDelete('cascade');
        });
    }
}
