<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->nullable();
            $table->string('name');
            $table->string('domain');
            $table->string('logo');
            $table->string('banner');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('seller_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('sellers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('platforms');
    }
}
