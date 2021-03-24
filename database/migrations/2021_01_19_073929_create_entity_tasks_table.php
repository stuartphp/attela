<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntityTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('entity_id');
            $table->dateTime('action_date');
            $table->string('title');
            $table->unsignedInteger('customer_contact_id');
            $table->dateTime('deadline');
            $table->string('tags')->nullable();
            $table->string('status');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('assigned_to');
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
        Schema::dropIfExists('entity_tasks');
    }
}
