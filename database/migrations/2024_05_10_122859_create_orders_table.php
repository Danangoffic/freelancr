<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id')->index('fk_buyer_id_to_users');
            $table->unsignedBigInteger('freelancer_id')->index('fk_freelancer_id_to_users');
            $table->unsignedBigInteger('service_id')->index('fk_service_id_to_services');
            $table->longText('file')->nullable();
            $table->longText('note')->nullable();
            $table->date('expired');
            $table->unsignedBigInteger('order_status_id')->index('fk_order_status_id_to_order_statuses');
            $table->foreign('order_status_id', 'fk_order_status_id_to_order_statuses')->references('id')->on('order_statuses');
            $table->foreign('buyer_id', 'fk_buyer_id_to_users')->references('id')->on('users');
            $table->foreign('freelancer_id', 'fk_freelancer_id_to_users')->references('id')->on('users');
            $table->foreign('service_id', 'fk_service_id_to_services')->references('id')->on('services');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
