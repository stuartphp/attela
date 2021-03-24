<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollTaxTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_tax_table', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('tax_year', 4)->nullable();
            $table->integer('lower_bracked')->nullable();
            $table->integer('upper_bracked')->nullable();
            $table->integer('tax_percentage')->nullable();
            $table->float('tax_amount', 18, 8)->nullable();
            $table->integer('tax_rebate')->nullable();
            $table->integer('tax_rebate65')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_tax_table');
    }
}
