<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppPrivateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_private_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_id');
            $table->string('addtion_app_icon')->nullable();
            $table->string('addtion_app_name')->nullable();
            $table->string('addtion_app_pkg')->nullable();
            $table->string('addtion_app_url')->nullable();
            $table->string('addtion_app_status')->nullable();
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
        Schema::dropIfExists('app_private_menus');
    }
}
