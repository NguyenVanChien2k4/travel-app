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
        Schema::create('detail_tours', function (Blueprint $table) {
            $table->integer('id_tour');
            $table->date('day');
            $table->string('title');
            $table->string('descrip');
            $table->string('img_1');
            $table->string('img_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_tours');
    }
};
