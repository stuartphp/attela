<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePersonalAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_personal_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->string('physical_address_unit_number', 10)->nullable();
            $table->string('physical_address_complex_name', 100)->nullable();
            $table->string('physical_address_street_number', 20)->nullable();
            $table->string('physical_address_street_name', 100)->nullable();
            $table->string('physical_address_suburb', 100)->nullable();
            $table->string('physical_address_city', 100)->nullable();
            $table->char('physical_address_code', 10)->nullable();
            $table->char('physical_address_country', 3)->nullable();
            $table->string('postal_street_box_number')->nullable();
            $table->string('postal_street_post_office_name')->nullable();
            $table->string('postal_suburb')->nullable();
            $table->string('postal_city')->nullable();
            $table->char('postal_code', 10)->nullable();
            $table->char('postal_country', 3)->nullable();
            $table->boolean('postal_care_of')->nullable();
            $table->string('postal_care_of_details')->nullable();
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
        Schema::dropIfExists('employee_personal_addresses');
    }
}
