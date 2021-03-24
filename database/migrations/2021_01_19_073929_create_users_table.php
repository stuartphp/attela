<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->string('email', 200)->unique('Index 2');
            $table->string('contact_number', 100);
            $table->string('image')->nullable();
            $table->string('password');
            $table->char('language', 2)->nullable()->default('en');
            $table->boolean('is_active');
            $table->dateTime('email_verified_at')->nullable();
            $table->string('email_host', 250)->nullable();
            $table->string('email_username', 250)->nullable();
            $table->string('email_password', 250)->nullable();
            $table->string('email_port', 250)->nullable();
            $table->boolean('email_ssl')->nullable()->default(1);
            $table->text('email_signature')->nullable();
            $table->rememberToken();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('users');
    }
}
