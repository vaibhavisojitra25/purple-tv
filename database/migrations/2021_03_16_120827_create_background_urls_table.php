<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackgroundUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('background_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_background_id');
            $table->string('url');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('app_background_id')->references('id')->on('app_backgrounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('background_urls');
    }
}
