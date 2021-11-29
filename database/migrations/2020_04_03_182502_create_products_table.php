<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger('productcategory_id');
            $table->foreign('productcategory_id')->references('id')->on('product_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('oilbrand_id')->nullable();
            $table->foreign('oilbrand_id')->references('id')->on('oil_brands')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('vender_id')->nullable();
            $table->foreign('vender_id')->references('id')->on('venders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name');
            $table->string('product_unit');
            $table->bigInteger('product_quantity')->nullable();
            $table->string('product_costprice');
            $table->string('product_saleprice');
            $table->string('product_detail');
            $table->string('product_image');
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
        Schema::dropIfExists('products');
    }
}
