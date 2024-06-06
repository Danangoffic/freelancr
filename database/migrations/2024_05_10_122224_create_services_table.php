<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index('fk_services_user_id_to_users');
            $table->foreign('user_id', 'fk_services_user_id_to_users')
                    ->references('id')
                    ->on("users")
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
            $table->string('title');
            $table->longText('description');
            $table->integer('delivery_time');
            $table->integer('revision_limit');
            $table->string('price');
            $table->longText('note');
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
        Schema::dropIfExists('services');
    }
}
