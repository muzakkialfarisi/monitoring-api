<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users_role')) {
            Schema::create('users_role', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('user_id');
                $table->timestamps(DB::raw(0));
                $table->dateTime('deleted_at', DB::raw(0))->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users_role')) {
            Schema::dropIfExists('users_role');
        }
    }
}
