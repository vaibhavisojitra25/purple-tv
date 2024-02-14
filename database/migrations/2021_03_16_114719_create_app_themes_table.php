<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id');
            $table->string('theme_defult_layout')->nullable();
            $table->string('theme_color_1')->nullable();
            $table->string('theme_color_2')->nullable();
            $table->string('theme_color_3')->nullable();
            $table->string('roku_color_primary')->nullable();
            $table->string('roku_color_secondary')->nullable();
            $table->string('roku_button_focus')->nullable();
            $table->string('roku_button_unfocus')->nullable();
            $table->boolean('theme_change')->default(0);
            $table->string('roku_background_overlay')->nullable();
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
        Schema::dropIfExists('app_themes');
    }
}
