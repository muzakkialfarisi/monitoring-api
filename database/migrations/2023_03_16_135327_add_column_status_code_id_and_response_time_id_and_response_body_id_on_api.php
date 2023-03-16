<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusCodeIdAndResponseTimeIdAndResponseBodyIdOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'status_code_id')) {
                $table->bigInteger('status_code_id')->unsigned();
            }
            if (!Schema::hasColumn('api', 'response_time_id')) {
                $table->bigInteger('response_time_id')->unsigned();
            }
            if (!Schema::hasColumn('api', 'response_body_id')) {
                $table->bigInteger('response_body_id')->unsigned();
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
            if (Schema::hasColumn('api', 'status_code_id')) {
                $table->dropColumn('status_code_id');
            }
            if (Schema::hasColumn('api', 'response_time_id')) {
                $table->dropColumn('response_time_id');
            }
            if (Schema::hasColumn('api', 'response_body_id')) {
                $table->dropColumn('response_body_id');
            }
        });
    }
}
