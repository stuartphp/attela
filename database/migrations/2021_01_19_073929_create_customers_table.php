<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id');
            $table->string('account_number');
            $table->string('description');
            $table->text('postal_address');
            $table->text('delivery_address');
            $table->string('category')->nullable();
            $table->string('contact_person', 150);
            $table->string('telephone', 150)->nullable();
            $table->string('fax', 150)->nullable();
            $table->string('mobile_phone', 150)->nullable();
            $table->string('email', 150);
            $table->double('credit_limit')->nullable()->default(0);
            $table->double('current_balance', 10, 2)->nullable()->default(0.00);
            $table->boolean('cash_sale_account')->nullable()->default(0);
            $table->char('currency_code', 3)->nullable()->default('ZAR');
            $table->unsignedInteger('payment_terms');
            $table->boolean('price_excl')->nullable()->default(0);
            $table->boolean('is_open_item')->nullable()->default(0);
            $table->integer('delivery_group_id');
            $table->string('vat_reference')->nullable();
            $table->char('default_tax', 2);
            $table->boolean('accept_electronic_document')->nullable()->default(1);
            $table->string('documents_contact')->nullable();
            $table->string('documents_email')->nullable();
            $table->boolean('statement_message')->nullable()->default(0);
            $table->string('statement_contact')->nullable();
            $table->string('statement_email')->nullable();
            $table->string('price_list')->nullable()->default('retail');
            $table->integer('sales_person_id')->nullable()->default(0);
            $table->double('discount')->nullable()->default(0);
            $table->string('psw')->nullable();
            $table->string('password')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
