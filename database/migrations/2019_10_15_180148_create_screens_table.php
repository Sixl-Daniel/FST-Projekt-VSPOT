<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('screens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('channel_id');
            $table->unsignedBigInteger('layout_id');

            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('active')->default(1);

            $table->string('background_color')->nullable()->default('rgb(0,0,0)');
            $table->string('bg_img_cdn_link')->nullable();
            $table->string('overlay_color')->nullable()->default('rgba(255,255,255,0)');
            $table->string('text_color')->nullable()->default('rgba(255,255,255,1)');

            // screen specific fields
            $table->string('heading')->nullable();
            $table->string('subheading')->nullable();
            $table->text('html_block')->nullable();
            $table->text('text_block')->nullable();
            // end screen specific fields

            $table->timestamps();
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('screens');
    }
}
