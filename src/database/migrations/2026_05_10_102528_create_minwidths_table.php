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
        Schema::create('minwidths', function (Blueprint $table) {
            $table->id();
            $table->foreignId("answerbase_id");
            $table->integer("road_condition");
            $table->string("road_name")->nullable();
            $table->integer("min_width")->nullable();
            $table->integer("width_condition")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minwidths');
    }
};
