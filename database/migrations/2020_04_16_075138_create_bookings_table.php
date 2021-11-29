<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('customerasset_id');
            $table->foreign('customerasset_id')->references('id')->on('customer_assets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade')->onUpdate('cascade');
            $table->date('providerassign_date')->nullable();
            $table->time('providerassign_time')->nullable();
            $table->dateTime('start_datetime')->nullable();
            $table->dateTime('end_datetime')->nullable();
            $table->dateTime('booking_date');
            $table->BigInteger('booking_amount');
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade')->onUpdate('cascade');
            $table->BigInteger('bonus_discount_amont')->nullable();
            $table->date('booking_afterdiscount');
            $table->string('booking_status');
            $table->date('booking_enddate');
            $table->time('booking_endtime');
            $table->unsignedBigInteger('product_oil')->nullable();
            $table->foreign('product_oil')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('product_oilfilter')->nullable();
            $table->foreign('product_oilfilter')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('product_airfilter')->nullable();
            $table->foreign('product_airfilter')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('address_one');
            $table->string('longitude_one');
            $table->string('latitude_one');
            $table->date('date_one');
            $table->time('time_one');
            $table->longText('address_two');
            $table->string('longitude_two');
            $table->string('latitude_two');
            $table->date('date_two');
            $table->time('time_two');
            $table->longText('address_three');
            $table->string('longitude_three');
            $table->string('latitude_three');
            $table->date('date_three');
            $table->time('time_three');
            $table->longText('assign_address');
            $table->string('assign_longitude');
            $table->string('assign_latitude');
            $table->date('assign_date');
            $table->time('assign_time');

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
        Schema::dropIfExists('bookings');
    }
}
