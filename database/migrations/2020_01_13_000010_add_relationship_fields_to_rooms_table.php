<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRoomsTable extends Migration
{
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->unsignedInteger('hotel_id');

            $table->foreign('hotel_id', 'hotel_fk_863379')->references('id')->on('hotels');

            $table->unsignedInteger('room_type_id');

            $table->foreign('room_type_id', 'room_type_fk_863380')->references('id')->on('room_types');
        });
    }
}
