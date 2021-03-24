<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeBenefitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_benefits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('transaction_id');
            $table->double('amount');
            $table->integer('tax_percentage');
            $table->char('tax_code', 4);
            $table->string('tax_description');
            $table->string('transaction_description');
            $table->integer('directive_percentage');
            $table->boolean('retirement_fund_include')->default(0);
            $table->tinyInteger('only_for_periods');
            $table->boolean('no_cash');
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
        Schema::dropIfExists('employee_benefits');
    }
}
