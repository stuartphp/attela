<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('entity_id');
            $table->unsignedBigInteger('inventory_item_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('description');
            $table->string('unit');
            $table->char('currency');
            $table->char('tax_code')->default('01');
            $table->double('price_excl', 18, 2)->default(0.00);
            $table->double('price_incl', 18, 2)->default(0.00);
            $table->char('ledger_account', 7)->nullable();
            $table->integer('min_order_quantity')->nullable();
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
        Schema::dropIfExists('entity_items');
    }
}
