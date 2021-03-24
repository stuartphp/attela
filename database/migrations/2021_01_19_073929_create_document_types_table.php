<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('document_id');
            $table->unsignedBigInteger('journal_id')->nullable();
            $table->date('action_date');
            $table->string('document_number');
            $table->string('document_reference')->nullable();
            $table->string('reference_number')->nullable();
            $table->integer('user_id');
            $table->string('document_type', 50);
            $table->boolean('inclusive')->default(1);
            $table->text('note');
            $table->double('total_nett_price', 18, 2);
            $table->double('total_excl', 18, 2);
            $table->double('total_discount', 18, 2);
            $table->double('total_tax', 18, 2);
            $table->double('total_amount', 18, 2);
            $table->double('total_due', 18, 2);
            $table->double('total_cost', 18, 2)->nullable();
            $table->string('image', 150)->nullable();
            $table->boolean('is_locked')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_vat_paid')->default(0);
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
        Schema::dropIfExists('document_types');
    }
}
