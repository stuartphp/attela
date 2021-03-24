<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitePageDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_page_designs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('site_page_id');
            $table->string('name');
            $table->text('css_dependencies')->nullable();
            $table->text('js_dependencies')->nullable();
            $table->longText('content');
            $table->unsignedTinyInteger('sort_order');
            $table->boolean('published')->default(1);
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
        Schema::dropIfExists('site_page_designs');
    }
}
