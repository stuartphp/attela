<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetupTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setup_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedTinyInteger('trans_view')->default(1);
            $table->unsignedTinyInteger('trans_page_size')->default(25);
            $table->unsignedTinyInteger('trans_capture_rows')->default(3);
            $table->unsignedTinyInteger('cashflow_start_day')->default(1);
            $table->boolean('warn_post_prior_financial_year')->default(1);
            $table->boolean('warn_post_tax_last_month')->default(1);
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
        Schema::dropIfExists('setup_transactions');
    }
}
