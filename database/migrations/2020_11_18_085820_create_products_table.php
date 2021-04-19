<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->double('minimum_principal', 11, 4)->nullable();
            $table->double('maximum_principal', 11, 4)->nullable();
            $table->enum('interest_method', ['flat_rate', 'installments', 'interest_only', 'compound_interest'])->default('flat_rate');
            $table->double('interest_rate')->nullable();
            $table->string('loan_duration');
            $table->tinyInteger('loan_duration_length')->nullable()->default(1);
            $table->enum('repayment_method', ['daily', 'weekly', 'monthly', 'bi_monthly', 'quarterly', 'semi_annually', 'annually'])->default('monthly');
            $table->tinyInteger('enable_late_repayment_penalty')->nullable()->default(0);
            $table->tinyInteger('enable_after_maturity_date_penalty')->nullable()->default(0);
            $table->double('late_repayment_penalty_amount', 11, 4)->nullable();
            $table->double('after_maturity_date_penalty_amount', 11, 4)->nullable();
            $table->boolean('status')->nullable()->default(0);
            $table->double('early_repayment_charge', 11, 4)->nullable();
            $table->double('insurance_charge', 11, 4)->nullable();
            $table->double('processing_charge', 11, 4)->nullable();
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
        Schema::dropIfExists('products');
    }
}
