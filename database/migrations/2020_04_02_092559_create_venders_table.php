<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venders', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('vender_name');
            $table->string('vender_companyname');
            $table->string('vender_phone');
            $table->string('vender_email');
            $table->string('vender_address');
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
        Schema::dropIfExists('venders');
    }
}
