<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_payment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->tinyInteger('pay_frequency');
            $table->tinyInteger('payment_method');
            $table->tinyInteger('payslip_language');
            $table->string('bank_branch_code', 10);
            $table->string('bank_name');
            $table->string('account_number', 30);
            $table->string('account_holder');
            $table->tinyInteger('account_holder_relationship');
            $table->string('account_holder_id_number');
            $table->tinyInteger('account_type');
            $table->boolean('is_foreign_account');
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
        Schema::dropIfExists('employee_payment_details');
    }
}
