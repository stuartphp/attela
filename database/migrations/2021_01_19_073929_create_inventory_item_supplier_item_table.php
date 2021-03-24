<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemSupplierItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_item_supplier_item', function (Blueprint $table) {
            $table->unsignedBigInteger('inventory_item_id')->index('inventory_item_id_fk_70615');
            $table->unsignedBigInteger('supplier_item_id')->index('supplier_item_id_fk_70615');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_item_supplier_item');
    }
}
