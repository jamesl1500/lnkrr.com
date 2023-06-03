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
            $table->integer('user_id');
            $table->integer('viewed_user_id');
            $table->string('ip_address');
            $table->string('user_agent');
            $table->string('country');
            $table->string('region');
            $table->string('city');
            $table->string('timezone');
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
