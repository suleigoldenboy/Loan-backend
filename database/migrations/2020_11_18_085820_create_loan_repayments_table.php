<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('loan_id');
            $table->unsignedInteger('user_id');
            $table->string('transaction_type', 30)->nullable();
            $table->integer('payment_bank');
            $table->double('amount');
            $table->string('date_paid')->nullable();
            $table->double('balance')->nullable();
            $table->tinyInteger('in_complete_payment')->nullable();
            $table->text('notes')->nullable();
            $table->string('complete_payment_status', 30)->nullable();
            $table->string('confirmation_status')->nullable();
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
        Schema::dropIfExists('loan_repayments');
    }
}
