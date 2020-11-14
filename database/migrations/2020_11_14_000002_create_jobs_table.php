<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_nr');
            $table->longText('anmerkungen')->nullable();
            $table->string('status');
            $table->boolean('milestone_1')->default(0);
            $table->boolean('milestone_2')->default(0)->nullable();
            $table->boolean('milestone_3')->default(0)->nullable();
            $table->string('jobtitle')->nullable();
            $table->timestamps();
        });
    }
}
