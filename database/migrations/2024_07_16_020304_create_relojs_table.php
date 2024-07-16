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
        Schema::create('relojs', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->time('star_time');
            $table->time('end_time');
            $table->tinyInteger('number_minutes_1');
            $table->tinyInteger('number_minutes_2');
            $table->tinyInteger('number_minutes_3');
            $table->tinyInteger('state');
            $table->unsignedBigInteger('employee_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relojs');
    }
};
