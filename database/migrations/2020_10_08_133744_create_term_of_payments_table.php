<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermOfPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('term_of_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment');
            $table->string('file_name')->nullable();
            $table->string('ref_no')->nullable();
            $table->foreignId('erfp_id')->constrained();
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
        Schema::dropIfExists('term_of_payments');
    }
}
