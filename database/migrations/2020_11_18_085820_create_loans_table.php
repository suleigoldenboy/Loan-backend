<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->boolean('customer_request')->nullable();
            $table->integer('loan_officer_id')->nullable();
            $table->unsignedBigInteger('customer_id')->index('loans_customer_id_foreign');
            $table->integer('product_id');
            $table->integer('branch_id');
            $table->date('release_date')->nullable();
            $table->date('maturity_date')->nullable();
            $table->unsignedBigInteger('customer_verification_id')->nullable();
            $table->date('interest_start_date')->nullable();
            $table->date('first_payment_date')->nullable();
            $table->integer('loan_disbursed_by_id')->nullable();
            $table->integer('loan_disbursed_payment_by_id')->nullable();
            $table->double('principal');
            $table->double('disbursed_amount')->nullable();
            $table->enum('interest_method', ['installments', 'interest_only', 'flat_rate', 'compound_interest'])->nullable()->default('flat_rate');
            $table->double('interest_rate')->nullable();
            $table->double('insurance_charge')->nullable();
            $table->double('processing_charge')->nullable();
            $table->enum('repayment_method', ['daily', 'weekly', 'monthly', 'bi_monthly', 'quarterly', 'semi_annually', 'annually'])->default('monthly');
            $table->text('files')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['open', 'fully_paid', 'defaulted', 'restructured', 'processing', 'approve', 'active'])->nullable();
            $table->string('status_paid', 100)->nullable();
            $table->string('repayment_instrument')->nullable();
            $table->string('loan_duration')->nullable();
            $table->string('loan_duration_length')->nullable();
            $table->text('loan_purpose')->nullable();
            $table->string('confirmation_status')->nullable();
            $table->string('rejection_status')->nullable();
            $table->string('decline')->nullable();
            $table->text('decline_reason')->nullable();
            $table->double('special_interest', 8, 2)->nullable();
            $table->double('balance')->nullable();
            $table->string('disburesment_bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('acount_number')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
}
