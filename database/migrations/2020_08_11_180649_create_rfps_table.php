<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs("rfpable");
            $table->date('rfp_date')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('description');
            $table->string('venue');
            $table->integer('quotation_no');
            $table->json('term_of_payment');
            $table->double('billing_amount');

            $table->json('quotations');
            
            $table->string('status');
            $table->integer('vendor_id');
            $table->integer('requestor_id');
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
        Schema::dropIfExists('rfps');
    }
}
