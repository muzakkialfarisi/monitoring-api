<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('body')) {
            Schema::create('body', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('api_id');
                $table->string('name');
                $table->string('value');
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
        if (Schema::hasTable('body')) {
            Schema::dropIfExists('body');
        }
    }
}
