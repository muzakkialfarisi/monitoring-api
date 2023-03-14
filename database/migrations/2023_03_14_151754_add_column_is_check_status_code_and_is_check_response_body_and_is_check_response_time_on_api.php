<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsCheckStatusCodeAndIsCheckResponseBodyAndIsCheckResponseTimeOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'is_check_status_code')) {
                $table->boolean('is_check_status_code')->nullable();
            }
            if (!Schema::hasColumn('api', 'is_check_response_body')) {
                $table->boolean('is_check_response_body')->nullable();
            }
            if (!Schema::hasColumn('api', 'is_check_response_time')) {
                $table->boolean('is_check_response_time')->nullable();
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
            if (Schema::hasColumn('api', 'is_check_status_code')) {
                $table->dropColumn('is_check_status_code');
            }
            if (Schema::hasColumn('api', 'is_check_response_body')) {
                $table->dropColumn('is_check_response_body');
            }
            if (Schema::hasColumn('api', 'is_check_response_time')) {
                $table->dropColumn('is_check_response_time');
            }
        });
    }
}
