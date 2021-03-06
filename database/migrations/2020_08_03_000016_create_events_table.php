<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->datetime('start_at');
            $table->datetime('end_at')->nullable();
            $table->string('link')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('notification')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
