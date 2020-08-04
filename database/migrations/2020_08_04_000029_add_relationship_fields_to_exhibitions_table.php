<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExhibitionsTable extends Migration
{
    public function up()
    {
        Schema::table('exhibitions', function (Blueprint $table) {
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_fk_1930354')->references('id')->on('events');
        });
    }
}
