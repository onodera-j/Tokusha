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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("answerbase_id");
            $table->string("application_number")->nullable();
            $table->integer("weight")->nullable();
            $table->integer("length")->nullable();
            $table->integer("width")->nullable();
            $table->integer("height")->nullable();
            $table->integer("radius")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
