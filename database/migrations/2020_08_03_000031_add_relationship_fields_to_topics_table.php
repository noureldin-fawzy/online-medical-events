<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTopicsTable extends Migration
{
    public function up()
    {
        Schema::table('topics', function (Blueprint $table) {
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_fk_1929110')->references('id')->on('events');
        });
    }
}
