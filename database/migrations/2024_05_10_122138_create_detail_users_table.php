<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->index('fk_detail_users_to_users');
            $table->foreign('user_id', 'fk_detail_users_to_users')
                    ->references('id')
                    ->on("users")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->longtext("photo")->nullable();
            $table->string("role")->nullable();
            $table->string("contact_number", 15)->nullable();
            $table->longText("biography")->nullable();
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
        Schema::dropIfExists('detail_users');
    }
}
