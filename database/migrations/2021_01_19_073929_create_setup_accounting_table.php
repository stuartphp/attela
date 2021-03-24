<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupAccountingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_accounting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->integer('trade_classification')->nullable();
            $table->boolean('charge_delivery_cost')->default(0);
            $table->double('default_credit_limit')->default(0);
            $table->char('retained_earnings', 7)->default('5200000');
            $table->char('profit_loss_year', 7)->default('2800000');
            $table->char('exchange_variances_account', 7)->default('4210000');
            $table->char('bank_charges', 7)->default('3200000');
            $table->char('sales_account', 7)->default('1000000');
            $table->char('sales_discount_account', 7)->default('2700000');
            $table->char('purchase_discount_account', 7)->default('2700000');
            $table->char('debtor_control_account', 7)->default('8000000');
            $table->char('bad_debt_account', 7)->default('3150000');
            $table->char('bad_debt_recovered_account', 7)->default('2850000');
            $table->char('supplier_control_account', 7)->default('9000000');
            $table->char('inventory_account', 7)->default('7700000');
            $table->char('cogs_account', 7)->default('2000000');
            $table->char('vat_control_account', 7)->default('9500000');
            $table->char('vat_output', 7)->default('9500100');
            $table->char('vat_input', 7)->default('9500200');
            $table->double('vat_percentage')->default(9500200);
            $table->char('inventory_adjustments_account', 7)->default('7700000');
            $table->char('rounding_account', 7)->default('9999000');
            $table->double('round_to_nearest')->default(0);
            $table->integer('depreciation_period')->default(365);
            $table->string('tax_number')->nullable();
            $table->boolean('is_vat_registered')->default(0);
            $table->string('vat_number')->nullable();
            $table->string('uif_number')->nullable();
            $table->string('sdl_number')->nullable();
            $table->string('paye_number')->nullable();
            $table->string('import_number')->nullable();
            $table->string('financial_year', 10);
            $table->tinyInteger('financial_period')->nullable();
            $table->integer('quote_valid_days')->default(30);
            $table->text('statement_message')->nullable();
            $table->text('tax_invoice_message')->nullable();
            $table->text('sales_order_message')->nullable();
            $table->text('quotation_message')->nullable();
            $table->text('receipt_message')->nullable();
            $table->text('credit_note_message')->nullable();
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
        Schema::dropIfExists('setup_accounting');
    }
}
