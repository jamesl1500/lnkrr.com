<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->string('url');
            $table->string('description')->default('')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('category')->default(0)->nullable();
            $table->bigInteger('clicks')->default(0)->nullable();
            $table->boolean('is_active')->default(true)->nullable();
            $table->boolean('is_protected')->default(false)->nullable();
            $table->string('password')->default('')->nullable();
            $table->binary('photo')->nullable();
            $table->string('type')->default('')->nullable();
            $table->string('font_family')->default('')->nullable();
            $table->string('font_size')->default('')->nullable();
            $table->string('font_color')->default('')->nullable();
            $table->string('background_color')->default('')->nullable();
            $table->string('border_color')->default('')->nullable();
            $table->string('border_radius')->default('')->nullable();
            $table->string('border_width')->default('')->nullable();
            $table->string('padding')->default('')->nullable();
            $table->string('margin')->default('')->nullable();
            $table->string('shadow')->default('')->nullable();
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
        Schema::dropIfExists('links');
    }
}
