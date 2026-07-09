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
        Schema::create('answerbase_remarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("answerbase_id");
            $table->string("answer_remarks")->nullable();
            $table->string("fax_remarks")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answerbase_remarks');
    }
};
