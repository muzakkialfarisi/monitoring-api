<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusCodeActualAndResponseBodyActualAndResponseTimeActualOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'headers')) {
                $table->longText('headers')->nullable();
            }
            if (!Schema::hasColumn('api', 'body')) {
                $table->longText('body')->nullable();
            }
            if (!Schema::hasColumn('api', 'params')) {
                $table->longText('params')->nullable();
            }
            if (!Schema::hasColumn('api', 'status_code_actual')) {
                $table->integer('status_code_actual')->nullable();
            }
            if (!Schema::hasColumn('api', 'response_time_actual')) {
                $table->float('response_time_actual')->nullable();
            }
            if (!Schema::hasColumn('api', 'response_body_actual')) {
                $table->longText('response_body_actual')->nullable();
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
            if (Schema::hasColumn('api', 'headers')) {
                $table->dropColumn('headers');
            }
            if (Schema::hasColumn('api', 'body')) {
                $table->dropColumn('body');
            }
            if (Schema::hasColumn('api', 'params')) {
                $table->dropColumn('params');
            }
            if (Schema::hasColumn('api', 'status_code_actual')) {
                $table->dropColumn('status_code_actual');
            }
            if (Schema::hasColumn('api', 'response_time_actual')) {
                $table->dropColumn('response_time_actual');
            }
            if (Schema::hasColumn('api', 'response_body_actual')) {
                $table->dropColumn('response_body_actual');
            }
        });
    }
}
