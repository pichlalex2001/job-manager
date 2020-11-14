<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBewerbersTable extends Migration
{
    public function up()
    {
        Schema::table('bewerbers', function (Blueprint $table) {
            $table->unsignedInteger('job_id');
            $table->foreign('job_id', 'job_fk_2270449')->references('id')->on('jobs');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2554248')->references('id')->on('teams');
        });
    }
}
