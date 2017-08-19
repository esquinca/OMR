<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_providers_h10omr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('provider_id');
            $table->string('provider');
            $table->string('avatarurl');
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
        Schema::drop('social_providers_h10omr');
    }
}
