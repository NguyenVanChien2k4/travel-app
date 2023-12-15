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
        Schema::create('group_tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('start_day');
            $table->date('end_day');
            $table->string('icon');
            $table->string('desc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_tours');
    }
};
