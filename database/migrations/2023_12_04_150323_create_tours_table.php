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
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('seat');
            $table->string('departure');
            $table->string('desstination');
            $table->date('start_day');
            $table->date('end_day');
            $table->time('rally_time');
            $table->time('start_time');
            $table->integer('schedule');
            $table->string('type_tour');
            $table->float('price');
            $table->integer('sale')->nullable();
            $table->integer('ordered');
            $table->string('flight');
            $table->string('transport');
            $table->integer('hotel');
            $table->string('addresstype');
            $table->string('continent');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
