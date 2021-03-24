<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosItemContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_item_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pos_item_id');
            $table->unsignedBigInteger('inventory_item_id');
            $table->double('quantity')->unsigned();
            $table->double('cost_price')->unsigned();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_item_contents');
    }
}
