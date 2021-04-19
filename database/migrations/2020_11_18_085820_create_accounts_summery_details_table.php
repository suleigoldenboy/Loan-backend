<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsSummeryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts_summery_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_id');
            $table->string('code', 50)->nullable();
            $table->string('name')->nullable();
            $table->string('debit_amount');
            $table->string('credit_amount');
            $table->string('transaction_type');
            $table->string('item');
            $table->string('description');
            $table->integer('created_by')->nullable();
            $table->string('update_status')->nullable();
            $table->integer('update_message')->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('transaction_date', 30);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts_summery_details');
    }
}
