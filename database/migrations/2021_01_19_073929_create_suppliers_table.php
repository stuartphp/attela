<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('company_id');
            $table->string('account_number');
            $table->string('description');
            $table->text('postal_address')->nullable();
            $table->text('business_address')->nullable();
            $table->string('category')->nullable();
            $table->string('contact_person', 150)->nullable();
            $table->string('telephone', 150)->nullable();
            $table->string('fax', 150)->nullable();
            $table->string('mobile_phone', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->double('credit_limit')->nullable();
            $table->double('current_balance')->default(0);
            $table->char('currency_code', 3)->default('ZAR');
            $table->unsignedTinyInteger('payment_terms');
            $table->string('vat_reference')->nullable();
            $table->char('default_tax', 2);
            $table->boolean('is_open_item')->default(0);
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
        Schema::dropIfExists('suppliers');
    }
}
