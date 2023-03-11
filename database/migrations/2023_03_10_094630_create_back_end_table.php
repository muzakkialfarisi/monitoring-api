<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackEndTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('back_end')) {
            Schema::create('back_end', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('main_dealer_id');
                $table->string('name');
                $table->string('base_url');
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
        if (Schema::hasTable('back_end')) {
            Schema::dropIfExists('back_end');
        }
    }
}
