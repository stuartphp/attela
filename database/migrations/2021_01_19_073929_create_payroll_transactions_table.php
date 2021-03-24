<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id');
            $table->string('tax_period', 6)->nullable();
            $table->string('transaction_period', 6);
            $table->double('amount')->nullable()->default(0);
            $table->double('tax_percentage')->nullable()->default(0);
            $table->char('tax_code', 4)->nullable()->default('0');
            $table->string('tax_description', 50);
            $table->string('transaction_description', 50);
            $table->string('directivenr', 13)->nullable();
            $table->double('directive_percentage')->nullable()->default(0);
            $table->boolean('retirement_fund_include')->nullable()->default(0);
            $table->boolean('payslip');
            $table->boolean('posted')->default(0);
            $table->unsignedBigInteger('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_transactions');
    }
}
