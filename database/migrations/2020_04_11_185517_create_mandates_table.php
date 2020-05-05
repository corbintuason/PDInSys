<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMandatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('position');
            $table->json('full_name');
            $table->string('region');
            $table->string('permanent_address');
            $table->string('present_address');
            $table->string('gender');
            $table->string('civil_status');
            $table->date('birthdate')->nullable();
            $table->string('age');
            $table->string('mobile_number');
            $table->string('telephone_number');
            $table->string('religion');
            $table->string('sss_number')->nullable();
            $table->string('tin_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->json('tertiary_details');
            $table->json('secondary_details');
            $table->json('primary_details');
            $table->json('work_details');
            $table->json('father_details');
            $table->json('mother_details');
            $table->json('spouse_details');
            $table->json('emergency_details');
            $table->string('status');

            $table->integer('creator_id');
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
        Schema::dropIfExists('mandates');
    }
}
