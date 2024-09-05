<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default(0)->nullable();
            $table->integer('viewed_user_id')->default(0)->nullable();
            $table->string('ip_address')->default('')->nullable();
            $table->string('user_agent')->default('')->nullable();
            $table->string('country')->default('')->nullable();
            $table->string('region')->default('')->nullable();
            $table->string('city')->default('')->nullable();
            $table->string('timezone')->default('')->nullable();
            $table->timestamp('viewed_at')->useCurrent();
            $table->timestamp('exited_at')->useCurrent();
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
        Schema::dropIfExists('views');
    }
}
