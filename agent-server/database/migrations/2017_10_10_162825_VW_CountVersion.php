<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VWCountVersion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("
            CREATE OR REPLACE VIEW vw_count_version_system AS(
	            select distinct count(cli_version_system) as count, cli_version_system as version 
	            from `dcf_properties`
	            group by cli_version_system
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement("DROP VIEW IF EXISTS vw_count_version_system");
    }
}
