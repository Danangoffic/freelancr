<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaglinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taglines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_id")->index('fk_taglines_services_id_to_services');
            $table->foreign("service_id", 'fk_taglines_services_id_to_services')
                    ->references("id")
                    ->on("services")
                    ->onDelete("cascade")
                    ->onUpdate("cascade");
            $table->string("tagline");
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
        Schema::dropIfExists('taglines');
    }
}
