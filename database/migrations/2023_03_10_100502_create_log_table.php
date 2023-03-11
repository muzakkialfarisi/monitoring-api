<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('log')) {
            Schema::create('log', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('main_dealer_id')->nullable();
                $table->string('main_dealer_name')->nullable();
                $table->bigInteger('feature_id')->nullable();
                $table->string('feature_name')->nullable();
                $table->bigInteger('api_id')->nullable();
                $table->string('url')->nullable();
                $table->json('request_header')->nullable();
                $table->json('request_payload')->nullable();
                $table->integer('status_code_factual')->nullable();
                $table->integer('status_code_actual')->nullable();
                $table->boolean('status_code_validation')->nullable();
                $table->json('response_body_factual')->nullable();
                $table->json('response_body_actual')->nullable();
                $table->boolean('response_body_validation')->nullable();
                $table->float('response_time')->nullable();
                $table->float('response_time_accumulation')->nullable();
                $table->boolean('response_time_validation')->nullable();
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
        if (Schema::hasTable('log')) {
            Schema::dropIfExists('log');
        }
    }
}
