<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardEventPivotTable extends Migration
{
    public function up()
    {
        Schema::create('board_event', function (Blueprint $table) {
            $table->unsignedInteger('board_id');
            $table->foreign('board_id', 'board_id_fk_1931781')->references('id')->on('boards')->onDelete('cascade');
            $table->unsignedInteger('event_id');
            $table->foreign('event_id', 'event_id_fk_1931781')->references('id')->on('events')->onDelete('cascade');
        });
    }
}
