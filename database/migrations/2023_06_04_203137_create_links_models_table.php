<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links_models', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->string('url');
            $table->string('description');
            $table->string('image');
            $table->bigInteger('category')->;
            $table->bigInteger('clicks');
            $table->boolean('is_active');
            $table->boolean('is_protected');
            $table->string('password');
            $table->binary('photo');
            $table->string('type');
            $table->string('font_family');
            $table->string('font_size');
            $table->string('font_color');
            $table->string('background_color');
            $table->string('border_color');
            $table->string('border_radius');
            $table->string('border_width');
            $table->string('padding');
            $table->string('margin');
            $table->string('shadow');
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
        Schema::dropIfExists('links_models');
    }
}
