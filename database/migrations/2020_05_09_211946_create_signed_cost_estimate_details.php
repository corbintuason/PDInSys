<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignedCostEstimateDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signed_cost_estimate_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_name');
            $table->integer('cost_estimate_detail_id');
            $table->integer('internal_budget')->nullable();
            $table->integer('incentive')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('signed_cost_estimate_details');
    }
}
