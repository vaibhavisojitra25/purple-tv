<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_ads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id');
            $table->string('ads_app_id')->nullable();
            $table->string('ads_banner')->nullable();
            $table->string('ads_intrestial')->nullable();
            $table->string('ads_rewarded')->nullable();
            $table->string('ads_native')->nullable();
            $table->integer('ads_intrestial_time_delay')->default(3600);
            $table->boolean('ads_ios_status')->default(0);
            $table->boolean('ads_status')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('app_id')->references('id')->on('apps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_ads');
    }
}
