<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusCodeValidationAndResponseTimeValidationAndResponseBodyValidationOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'status_code_validation')) {
                $table->boolean('status_code_validation')->nullable();
            }
            if (!Schema::hasColumn('api', 'response_time_validation')) {
                $table->boolean('response_time_validation')->nullable();
            }
            if (!Schema::hasColumn('api', 'response_body_validation')) {
                $table->boolean('response_body_validation')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api', function (Blueprint $table) {
            if (Schema::hasColumn('api', 'status_code_validation')) {
                $table->dropColumn('status_code_validation');
            }
            if (Schema::hasColumn('api', 'response_time_validation')) {
                $table->dropColumn('response_time_validation');
            }
            if (Schema::hasColumn('api', 'response_body_validation')) {
                $table->dropColumn('response_body_validation');
            }
        });
    }
}
