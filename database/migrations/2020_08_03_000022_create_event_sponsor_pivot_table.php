<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSponsorPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_sponsor', function (Blueprint $table) {
            $table->unsignedInteger('sponsor_id');
            $table->foreign('sponsor_id', 'sponsor_id_fk_1931783')->references('id')->on('sponsors')->onDelete('cascade');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_1931783')->references('id')->on('events')->onDelete('cascade');
        });
    }
}
