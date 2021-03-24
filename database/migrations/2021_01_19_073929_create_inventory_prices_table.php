<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventory_item_id')->index('item_price');
            $table->unsignedInteger('store_id');
            $table->double('cost_price')->nullable();
            $table->double('retail');
            $table->double('dealer')->nullable();
            $table->double('whole_sale')->nullable();
            $table->double('price_list1')->nullable();
            $table->double('price_list2')->nullable();
            $table->double('price_list3')->nullable();
            $table->double('price_list4')->nullable();
            $table->double('price_list5')->nullable();
            $table->double('special')->nullable();
            $table->dateTime('special_from')->nullable();
            $table->dateTime('special_to')->nullable();
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
        Schema::dropIfExists('inventory_prices');
    }
}
