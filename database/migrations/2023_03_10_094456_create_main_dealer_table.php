<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainDealerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('main_dealer')) {
            Schema::create('main_dealer', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->boolean('is_active');
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
        if (Schema::hasTable('main_dealer')) {
            Schema::dropIfExists('main_dealer');
        }
    }
}