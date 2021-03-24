<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id');
            $table->char('gcs', 1);
            $table->string('account_number');
            $table->bigInteger('entity_id');
            $table->string('entity_name');
            $table->text('physical_address');
            $table->text('delivery_address');
            $table->char('tax_exempt', 2);
            $table->string('tax_reference')->nullable();
            $table->integer('sales_code');
            $table->double('discount_perc')->nullable();
            $table->double('exchange_rate');
            $table->integer('terms');
            $table->date('expire_delivery');
            $table->string('freight_method');
            $table->string('ship_deliver');
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
        Schema::dropIfExists('documents');
    }
}
