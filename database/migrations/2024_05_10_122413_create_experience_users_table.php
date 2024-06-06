<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_user_id')->index('fk_detail_user_id_to_detail_users');
            $table->foreign("detail_user_id", 'fk_detail_user_id_to_detail_users')
                    ->references('id')
                    ->on("detail_users")
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string("experience");
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
        Schema::dropIfExists('experience_users');
    }
}
