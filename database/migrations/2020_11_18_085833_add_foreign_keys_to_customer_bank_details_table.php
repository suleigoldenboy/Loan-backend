<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCustomerBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_bank_details', function (Blueprint $table) {
            $table->foreign('bank_list_id')->references('id')->on('bank_lists')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_bank_details', function (Blueprint $table) {
            $table->dropForeign('customer_bank_details_bank_list_id_foreign');
            $table->dropForeign('customer_bank_details_customer_id_foreign');
        });
    }
}
