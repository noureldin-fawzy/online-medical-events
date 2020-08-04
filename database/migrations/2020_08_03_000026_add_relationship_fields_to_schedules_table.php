<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->unsignedInteger('speaker_id');
            $table->foreign('speaker_id', 'speaker_fk_1929348')->references('id')->on('speakers');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_fk_1931780')->references('id')->on('events');
        });
    }
}
