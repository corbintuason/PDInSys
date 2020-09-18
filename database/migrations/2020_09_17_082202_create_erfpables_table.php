<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateErfpablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erfpables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs("erfpable");
            $table->string('status');
            $table->double('billing_amount');

            $table->foreignId('erfp_id')->constrained();
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
        Schema::dropIfExists('erfpables');
    }
}
