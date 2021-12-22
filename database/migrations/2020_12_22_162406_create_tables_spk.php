<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesSpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criteria', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('weight')->nullable();
        });

        Schema::create('alternative_criteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('alternative_id')->nullable();
            $table->unsignedInteger('criteria_id')->nullable();
            $table->unsignedInteger('score')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criteria');
    }
}
