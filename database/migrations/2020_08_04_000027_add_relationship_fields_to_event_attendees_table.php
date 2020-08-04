<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventAttendeesTable extends Migration
{
    public function up()
    {
        Schema::table('event_attendees', function (Blueprint $table) {
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_fk_1930668')->references('id')->on('events');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1930669')->references('id')->on('users');
        });
    }
}
