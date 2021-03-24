<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('supplier_id');
            $table->date('action_date');
            $table->date('due_date')->nullable();
            $table->string('description');
            $table->string('reference');
            $table->string('image')->nullable();
            $table->string('account_number')->nullable();
            $table->char('ledger');
            $table->double('tax_amount');
            $table->double('zero_tax_amount')->nullable();
            $table->double('total_amount');
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_locked')->default(0);
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
        Schema::dropIfExists('bills');
    }
}
