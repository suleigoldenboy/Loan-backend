<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('other_name')->nullable();
            $table->string('username')->nullable()->unique();
            $table->string('email', 293)->nullable()->unique();
            $table->string('gender')->nullable();
            $table->string('password')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('religion')->nullable();
            $table->string('employee_code')->nullable();
            $table->string('marital_status')->nullable();
            $table->unsignedBigInteger('department_id')->nullable()->index('employees_department_id_foreign');
            $table->unsignedBigInteger('branch_id')->nullable()->index('employees_branch_id_foreign');
            $table->unsignedBigInteger('designation_id')->nullable()->index('employees_designation_id_foreign');
            $table->integer('role_id')->nullable();
            $table->string('employment_type')->nullable();
            $table->timestamp('joined_on')->nullable();
            $table->timestamp('leaving_date')->nullable();
            $table->unsignedBigInteger('auditor_id')->index('employees_auditor_id_foreign');
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
        Schema::dropIfExists('employees');
    }
}
