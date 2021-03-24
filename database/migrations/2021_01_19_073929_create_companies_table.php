<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('creator');
            $table->string('trading_name');
            $table->string('registered_as');
            $table->string('registration_number', 50)->nullable();
            $table->string('contact_name');
            $table->string('contact_number');
            $table->string('email');
            $table->text('physical_address');
            $table->text('postal_address');
            $table->string('domain')->nullable();
            $table->string('url_contact_us')->nullable();
            $table->string('url_terms_and_conditions')->nullable();
            $table->string('url_privacy_policy')->nullable();
            $table->string('slogan')->nullable();
            $table->string('document_logo')->nullable();
            $table->string('bank_name', 150)->nullable();
            $table->string('bank_branch', 150)->nullable();
            $table->string('bank_branch_code', 50)->nullable();
            $table->string('bank_account_number', 100)->nullable();
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
        Schema::dropIfExists('companies');
    }
}
