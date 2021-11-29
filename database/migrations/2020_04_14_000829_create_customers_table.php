<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('customer_name');
            $table->string('customer_phone')->unique();
            $table->string('customer_image')->nullable();
            $table->string('customer_email')->unique()->nullable();
            $table->bigInteger('customer_wallet')->nullable();
            $table->bigInteger('customer_bonus_amount')->nullable();
            $table->bigInteger('customer_bonus_less')->nullable();
            $table->string('customer_Status');
            $table->string('fcmtoken')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
