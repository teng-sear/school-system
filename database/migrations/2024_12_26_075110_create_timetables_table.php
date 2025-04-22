<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('class_id')->nullable();
            //$table->unsignedBigInteger('day_id')->nullable();
            //$table->unsignedBigInteger('subject_id')->nullable();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('room_no');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
