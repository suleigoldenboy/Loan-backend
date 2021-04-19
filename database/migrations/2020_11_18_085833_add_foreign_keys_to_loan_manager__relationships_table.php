<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToLoanManagerRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loan_manager__relationships', function (Blueprint $table) {
            $table->foreign('loan_id')->references('id')->on('loans')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('loan_manager_id')->references('id')->on('employees')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_manager__relationships', function (Blueprint $table) {
            $table->dropForeign('loan_manager__relationships_loan_id_foreign');
            $table->dropForeign('loan_manager__relationships_loan_manager_id_foreign');
        });
    }
}
