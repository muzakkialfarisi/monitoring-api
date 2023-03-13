<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMethodOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'method')) {
                $table->string('method')->nullable();
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
            if (Schema::hasColumn('api', 'method')) {
                $table->dropColumn('method');
            }
        });
    }
}
