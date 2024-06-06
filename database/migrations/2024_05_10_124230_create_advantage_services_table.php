<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvantageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantage_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id")->index('fk_advantage_services_service_id_to_services');
            $table->foreign("service_id", 'fk_advantage_services_service_id_to_services')
                    ->references("id")
                    ->on("services")
                    ->onDelete("cascade")
                    ->onUpdate("cascade");
            $table->string("advantage");
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
        Schema::dropIfExists('advantage_services');
    }
}
