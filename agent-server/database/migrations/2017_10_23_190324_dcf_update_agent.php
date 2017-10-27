<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DcfUpdateAgent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcf_update_agent', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_bin';
            $table->increments('id');
            $table->integer('agent_update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('dcf_update_agent');
    }
}

/*
# Create Scheduler
CREATE DEFINER = 'docflowapi'@'%' EVENT `sch_agent_update`
  ON SCHEDULE EVERY 1 DAY STARTS '2017-10-23 23:59:59'
  ON COMPLETION NOT PRESERVE
  ENABLE
  COMMENT 'Atualiza em quantos clientes foram executados o agent no dia'  DO
INSERT INTO dcf_update_client (agent_update)
  SELECT date_update from vw_count_updated_day;

*/
