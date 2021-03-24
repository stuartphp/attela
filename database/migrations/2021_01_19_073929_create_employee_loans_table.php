<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('reference_number');
            $table->date('issue_date');
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('start_period');
            $table->tinyInteger('end_period');
            $table->double('total_amount_due');
            $table->char('transaction_code', 7);
            $table->double('balance');
            $table->double('interest_on_amount');
            $table->double('interest_amount');
            $table->char('interest_transaction_code', 7);
            $table->double('interest_perc');
            $table->boolean('paid_up');
            $table->date('settlement_date');
            $table->string('settlement_reason');
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
        Schema::dropIfExists('employee_loans');
    }
}
