<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->string('certificate_number')->nullable();
            $table->char('type_of_certificate', 2)->nullable();
            $table->char('nature_of_person', 1)->nullable();
            $table->string('employee_code', 50);
            $table->string('title', 10);
            $table->string('surname');
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('initials', 5);
            $table->string('known_as');
            $table->char('gender', 2);
            $table->string('id_number', 20);
            $table->string('passport_number', 20)->nullable();
            $table->string('passport_country')->nullable();
            $table->date('date_of_birth');
            $table->string('tax_reference_number');
            $table->tinyInteger('tax_type');
            $table->string('directive_1', 30)->nullable();
            $table->string('directive_2', 30)->nullable();
            $table->string('directive_3', 30)->nullable();
            $table->tinyInteger('reason_no_uif')->nullable();
            $table->boolean('retired')->default(0);
            $table->boolean('registered_medical_aid')->default(0);
            $table->tinyInteger('medical_aid_members')->nullable();
            $table->date('employed_from');
            $table->date('employed_to')->nullable();
            $table->char('periods_worked', 6)->nullable();
            $table->tinyInteger('payment_type')->default(1);
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('employees');
    }
}
