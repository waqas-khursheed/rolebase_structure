<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->date('validfrom');
            $table->date('validto');
            $table->bigInteger('cashwallet');
            $table->date('expiridate');
            $table->bigInteger('discountvalue');
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
        Schema::dropIfExists('coupons');
    }
}
