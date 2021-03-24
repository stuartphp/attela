<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id');
            $table->string('item_code');
            $table->string('description');
            $table->text('dictation')->nullable();
            $table->string('keywords')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedInteger('category_id');
            $table->string('barcode')->nullable();
            $table->string('isbn_number')->nullable();
            $table->string('unit');
            $table->string('commodity_code')->nullable();
            $table->integer('nett_mass_gram')->nullable();
            $table->boolean('is_service')->default(0);
            $table->boolean('allow_tax')->default(1);
            $table->char('purchase_tax_type', 2);
            $table->char('sales_tax_type', 2);
            $table->boolean('is_fixed_description')->default(1);
            $table->boolean('sales_commission_item')->default(1);
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
        Schema::dropIfExists('inventory_items');
    }
}
