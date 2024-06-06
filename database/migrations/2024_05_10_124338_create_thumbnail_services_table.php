<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThumbnailServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thumbnail_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id")->index('fk_thumbnail_services_service_id_to_services');
            $table->foreign("service_id", 'fk_thumbnail_services_service_id_to_services')
                    ->references("id")
                    ->on("services")
                    ->onDelete("cascade")
                    ->onUpdate("cascade");
            $table->longText("thumbnail");
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
        Schema::dropIfExists('thumbnail_services');
    }
}
