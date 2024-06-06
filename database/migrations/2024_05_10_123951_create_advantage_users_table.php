<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvantageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advantage_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->index('fk_advantage_users_service_id_to_services');
            $table->foreign("service_id", 'fk_advantage_users_service_id_to_services')
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
        Schema::dropIfExists('advantage_users');
    }
}
