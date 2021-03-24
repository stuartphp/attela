<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id');
            $table->unsignedBigInteger('inventory_item_id')->index('item_activity');
            $table->date('action_date');
            $table->enum('action', ['Adjustment', 'Purchase', 'Returned', 'Sale']);
            $table->string('document_reference')->nullable();
            $table->unsignedInteger('store_id');
            $table->double('down')->nullable();
            $table->double('up')->nullable();
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
        Schema::dropIfExists('inventory_activities');
    }
}
