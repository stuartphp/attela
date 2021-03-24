<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('document_type_id');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('item_id');
            $table->string('item_code');
            $table->string('item_description');
            $table->integer('project')->nullable();
            $table->string('unit');
            $table->double('quantity', 18, 2);
            $table->text('options')->nullable();
            $table->double('unit_price', 18, 2)->nullable();
            $table->char('tax_type', 2);
            $table->double('price_excl', 18, 2);
            $table->double('discount_perc', 4, 2)->nullable();
            $table->boolean('is_service')->default(0);
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
        Schema::dropIfExists('document_items');
    }
}
