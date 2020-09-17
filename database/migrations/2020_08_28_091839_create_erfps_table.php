<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErfpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erfps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs("erfpable");
            $table->date('rfp_date')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('description');
            $table->string('venue');
            $table->string('quotation_no');
            $table->json('term_of_payment');
            $table->double('billing_amount');

            $table->string('quotation_file');
            
            $table->integer('bank_index');
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
        Schema::dropIfExists('erfps');
    }
}
