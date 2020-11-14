<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAntwortensTable extends Migration
{
    public function up()
    {
        Schema::table('antwortens', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2557093')->references('id')->on('teams');
            $table->unsignedInteger('question_id');
            $table->foreign('question_id', 'question_fk_2557094')->references('id')->on('fragens');
        });
    }
}
