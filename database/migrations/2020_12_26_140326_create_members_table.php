<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name');
            $table->string('father_name');
            $table->string('identity_card', 16);
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('passport_number', 100);
            $table->string('passport_place');
            $table->text('address');
            $table->string('phone', 18);
            $table->string('email');
            $table->string('profession');
            $table->boolean('is_already_umrah')->default(0);
            $table->string('last_education');
            $table->string('emergency_name');
            $table->string('emergency_identity_card', 16);
            $table->string('emergency_phone', 18);
            $table->string('emergency_relationship');
            $table->text('emergency_address');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
