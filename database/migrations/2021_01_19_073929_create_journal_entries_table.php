<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->char('journal_code', 2)->nullable();
            $table->unsignedBigInteger('transaction_flow_id');
            $table->date('action_date');
            $table->unsignedBigInteger('document_id')->nullable();
            $table->string('account_number');
            $table->string('entity_name')->nullable();
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->string('type')->nullable();
            $table->char('tax_type', 2);
            $table->boolean('affect_journal')->nullable()->default(1);
            $table->char('ledger', 7);
            $table->double('debit_amount')->nullable();
            $table->double('credit_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_entries');
    }
}
