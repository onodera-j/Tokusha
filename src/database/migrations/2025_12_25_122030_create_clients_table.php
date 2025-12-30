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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("short_name");
            $table->integer("prefecture_code");
            $table->string("tel");
            $table->string("fax");
            $table->string("answer_address1");
            $table->string("answer_address2")->nullable();
            $table->string("numbering_name");
            $table->string("fax_address1");
            $table->string("fax_address2")->nullable();
            $table->string("fax_address3");
            $table->boolean("hidden")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
