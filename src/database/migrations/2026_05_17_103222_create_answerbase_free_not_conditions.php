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
        Schema::create('answerbase_free_not_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("answerbase_id");
            $table->integer("not_condition_id");
            $table->string("condition_free");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answerbase_free_not_conditions');
    }
};
