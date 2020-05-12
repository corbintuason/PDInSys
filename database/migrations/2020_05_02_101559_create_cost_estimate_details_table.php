<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostEstimateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_estimate_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->integer('cost_estimate_id');
            $table->json('sub_fields');
            $table->integer('version');
            $table->string('vat');
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
        Schema::dropIfExists('cost_estimate_details');
    }
}
