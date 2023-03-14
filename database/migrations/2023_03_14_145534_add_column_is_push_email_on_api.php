<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsPushEmailOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'is_push_email')) {
                $table->boolean('is_push_email')->nullable();
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
            if (Schema::hasColumn('api', 'is_push_email')) {
                $table->dropColumn('is_push_email');
            }
        });
    }
}
