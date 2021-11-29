<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBellNotificationSendTosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('bell_notification_send_tos', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->unsignedBigInteger("sendby");
            $table->foreign("sendby")->references('id')->on('customers')->cascadeOnDelete();
            $table->unsignedBigInteger("notification_id");
            $table->foreign("notification_id")->references('id')->on('bell_notifications')->cascadeOnDelete();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('bell_notification_send_tos');
    }
}
