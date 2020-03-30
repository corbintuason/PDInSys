<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('registered_name');
            $table->json('registered_address');
            $table->string('status');
            $table->string('registered_tin')->nullable();
            $table->json('terms_of_payment')->nullable();
            $table->json('payment_milestone')->nullable();
            $table->json('company_tel_number')->nullable();
            $table->json('company_email_address')->nullable();
            $table->json('accreditation_status')->nullable();
            $table->json("brands");
            $table->json("departments");
            $table->json('clients');
            $table->json("change_logs");

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
        Schema::dropIfExists('accounts');
    }
}
