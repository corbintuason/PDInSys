<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs("brable");
            $table->string('status');
            $table->integer("ce_number_id");
            $table->date('start_date');
            $table->date('end_date');
            $table->json('entries');
            $table->tinyInteger('isActive')->default(1);
            $table->string('reference_number')->nullable();
            $table->integer('br_requestor_id')->nullable();
            $table->integer('afg_counterpart_id')->nullable();
            $table->string('rate')->nullable();
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
        Schema::dropIfExists('budget_requests');
    }
}
