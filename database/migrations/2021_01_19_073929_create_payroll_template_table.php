<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id');
            $table->bigInteger('transaction_id')->nullable();
            $table->double('amount')->nullable()->default(0);
            $table->double('tax_percentage')->nullable()->default(0);
            $table->char('tax_code', 4)->nullable()->default('0');
            $table->string('tax_description', 150);
            $table->string('transaction_description', 50);
            $table->double('directive_percentage')->nullable()->default(0);
            $table->boolean('retirement_fund_include')->nullable()->default(0);
            $table->integer('only_periods')->default(9999);
            $table->boolean('nocash')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_template');
    }
}
