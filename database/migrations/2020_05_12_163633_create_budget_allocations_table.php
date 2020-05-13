<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('annual_budget');
            $table->json('adm_cost_centers')->nullable();
            $table->json('acc_cost_centers')->nullable();
            $table->json('bod_cost_centers')->nullable();
            $table->json('hum_cost_centers')->nullable();
            $table->json('ops_cost_centers')->nullable();
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
        Schema::dropIfExists('budget_allocations');
    }
}
