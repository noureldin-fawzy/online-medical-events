<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventOrganizerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('event_organizer', function (Blueprint $table) {
            $table->unsignedInteger('organizer_id');
            $table->foreign('organizer_id', 'organizer_id_fk_1931782')->references('id')->on('organizers')->onDelete('cascade');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_1931782')->references('id')->on('events')->onDelete('cascade');
        });
    }
}
