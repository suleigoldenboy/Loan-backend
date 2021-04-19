<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanOfferLetterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_offer_letter', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('customer_id');
            $table->bigInteger('loan_id');
            $table->integer('letter_id');
            $table->string('code', 30);
            $table->enum('status', ['active', 'pending', 'decline'])->default('decline');
            $table->text('param')->nullable();
            $table->string('img_offer_letter', 255)->nullable();
            $table->string('img_application_form', 255)->nullable();
            $table->integer('send_by');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_offer_letter');
    }
}
