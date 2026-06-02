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
        Schema::create('answerbases', function (Blueprint $table) {
            $table->id();
            $table->integer("sheet_type");
            $table->string("numbering_name");
            $table->string("approval_number");
            $table->foreignId("client_id");
            $table->date("application_date");
            $table->string("consultation_number");
            $table->string("destination");
            $table->string("answer_year");
            $table->foreignId("staff_id");
            $table->date("approval_date")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answerbases');
    }
};
