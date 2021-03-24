<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('effective_date');
            $table->string('job_title');
            $table->unsignedInteger('store_id');
            $table->string('job_division');
            $table->string('job_department');
            $table->unsignedInteger('reports_to');
            $table->double('compensation_pay_rate');
            $table->tinyInteger('compensation_pay_per');
            $table->tinyInteger('compensation_pay_schedule');
            $table->double('overtime_allowed');
            $table->string('change_reason');
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
        Schema::dropIfExists('employee_jobs');
    }
}
