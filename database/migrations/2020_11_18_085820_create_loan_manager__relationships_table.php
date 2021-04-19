<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanManagerRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_manager__relationships', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('loan_id')->index('loan_manager__relationships_loan_id_foreign');
            $table->unsignedBigInteger('loan_manager_id')->index('loan_manager__relationships_loan_manager_id_foreign');
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
        Schema::dropIfExists('loan_manager__relationships');
    }
}
