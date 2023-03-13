<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMainDealerIdOnApi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('api', function (Blueprint $table) {
            if (!Schema::hasColumn('api', 'main_dealer_id')) {
                $table->integer('main_dealer_id')->nullable();
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
            if (Schema::hasColumn('api', 'main_dealer_id')) {
                $table->dropColumn('main_dealer_id');
            }
        });
    }
}
