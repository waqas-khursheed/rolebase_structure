<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('provider_name');
            $table->string('provider_image');
            $table->string('provider_address');
            $table->string('provider_phone')->unique();
            $table->string('provider_email')->unique();
            $table->string('provider_password');
            $table->Boolean('provider_status');
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
        Schema::dropIfExists('providers');
    }
}
