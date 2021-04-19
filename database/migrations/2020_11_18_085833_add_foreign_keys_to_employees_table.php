<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('auditor_id')->references('id')->on('employees')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('designation_id')->references('id')->on('designations')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign('employees_auditor_id_foreign');
            $table->dropForeign('employees_branch_id_foreign');
            $table->dropForeign('employees_department_id_foreign');
            $table->dropForeign('employees_designation_id_foreign');
        });
    }
}
