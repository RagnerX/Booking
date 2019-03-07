<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meeting_type_id');
            $table->integer('location_id');
            $table->time('meeting_time');
            $table->date('meeting_date');
            $table->text('meeting_note');
            $table->string('document_url',150);
            $table->boolean('status')->default(0);
            $table->integer('meeting_caller_id');
            $table->integer('approver_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
