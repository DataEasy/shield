<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VWCountDataGRaphicsAgent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_count_agent_run AS
            (
	            SELECT COUNT(DATE_FORMAT(updated_at,'%d.%m.%Y')) AS date_update
                FROM dcf_properties
                WHERE DATE_FORMAT(updated_at, '%d%m%Y') = DATE_FORMAT(CURDATE(),'%d%m%Y')
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
        DB::statement("DROP VIEW IF EXISTS vw_count_agent_run");
    }
}
