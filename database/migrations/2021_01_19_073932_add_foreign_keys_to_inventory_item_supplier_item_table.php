<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToInventoryItemSupplierItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_item_supplier_item', function (Blueprint $table) {
            $table->foreign('inventory_item_id', 'inventory_item_id_fk_70615')->references('id')->on('inventory_items')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('supplier_item_id', 'supplier_item_id_fk_70615')->references('id')->on('supplier_items')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_item_supplier_item', function (Blueprint $table) {
            $table->dropForeign('inventory_item_id_fk_70615');
            $table->dropForeign('supplier_item_id_fk_70615');
        });
    }
}
