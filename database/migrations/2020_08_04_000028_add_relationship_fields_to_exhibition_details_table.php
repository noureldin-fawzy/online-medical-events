<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToExhibitionDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('exhibition_details', function (Blueprint $table) {
            $table->unsignedInteger('exhibition_id');
            $table->foreign('exhibition_id', 'exhibition_fk_1930363')->references('id')->on('exhibitions');
        });
    }
}
