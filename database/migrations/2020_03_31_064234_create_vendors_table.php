<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vendor_name');
            $table->string('trade_name');
            $table->json('registered_address');
            $table->string('type_business');
            $table->string('line_business');
            $table->json('contact_person');
            $table->string('contact_number');
            $table->string('email_address');
            $table->json('bank_details');
            $table->string('tin_number');
            $table->string('type_vat');
            $table->json('ewt_details');
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
        Schema::dropIfExists('vendors');
    }
}
