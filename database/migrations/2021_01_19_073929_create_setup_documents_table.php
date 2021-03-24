<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedInteger('role_id');
            $table->boolean('user_id')->default(1);
            $table->boolean('sales_code')->default(1);
            $table->boolean('note')->default(1);
            $table->boolean('options')->default(1);
            $table->boolean('project')->default(1);
            $table->boolean('store')->default(1);
            $table->boolean('unit_price')->default(1);
            $table->boolean('tax_type')->default(1);
            $table->boolean('price_excl')->default(1);
            $table->boolean('discount_perc')->default(1);
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
        Schema::dropIfExists('setup_documents');
    }
}
