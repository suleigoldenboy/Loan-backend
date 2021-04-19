<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_instruments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index('card_instruments_customer_id_foreign');
            $table->string('reference_code', 100);
            $table->string('authorization_code', 100);
            $table->string('card_type', 100);
            $table->string('last4', 100);
            $table->string('exp_month', 100);
            $table->string('exp_year', 100);
            $table->string('bin', 100);
            $table->string('bank', 100);
            $table->boolean('reusable');
            $table->boolean('signature');
            $table->boolean('channel');
            $table->boolean('gateway');
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
        Schema::dropIfExists('card_instruments');
    }
}
