<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->index('employee_salaries_employee_id_foreign');
            $table->string('salary_type')->nullable();
            $table->double('basic_salary', 11, 2)->nullable();
            $table->double('accommodation_allowance', 11, 2)->nullable();
            $table->double('gross', 11, 2)->nullable();
            $table->double('percentage_to_achieved', 11, 2)->nullable();
            $table->double('telephone_allowance', 11, 2)->nullable();
            $table->double('leave_allowance', 11, 2)->nullable();
            $table->double('other_allowance', 11, 2)->nullable();
            $table->double('transportation_allowance', 11, 2)->nullable();
            $table->double('monthly_target', 11, 2)->nullable();
            $table->timestamp('smart_saver_date')->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('beneficiary_bank')->nullable();
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
        Schema::dropIfExists('employee_salaries');
    }
}
