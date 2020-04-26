<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->json('account');
            $table->date('start_date');
            $table->date('end_date');
            $table->json('locations');
            $table->string('status');
            $table->string('project_status');
            $table->integer('score');
            $table->boolean('for_project_bidding');
            $table->json('departments_needed');
            $table->json('supporting_documents')->nullable();
            
            $table->json("involved_users")->nullable();
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
        Schema::dropIfExists('projects');
    }
}
