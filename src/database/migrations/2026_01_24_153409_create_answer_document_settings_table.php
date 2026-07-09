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
        Schema::create('answer_document_settings', function (Blueprint $table) {
            $table->id();
            $table->string("numbering_name");
            $table->string("answer_year");
            $table->string("position");
            $table->string("administrator_name");
            $table->string("department");
            $table->string("tel");
            $table->string("fax");
            $table->integer("extension")->nullable();
            $table->string("postcode");
            $table->string("address");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_document_settings');
    }
};
