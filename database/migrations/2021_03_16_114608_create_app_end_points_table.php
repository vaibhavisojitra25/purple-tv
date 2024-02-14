<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppEndPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_end_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id');
            $table->string('m3u_parse')->nullable();
            $table->string('login')->nullable();
            $table->string('register')->nullable();
            $table->string('list_get')->nullable();
            $table->string('list_xstream_update')->nullable();
            $table->string('deleteurl')->nullable();
            $table->string('list_m3u_update')->nullable();
            $table->string('epg_endpoint')->nullable();
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
        Schema::dropIfExists('app_end_points');
    }
}
