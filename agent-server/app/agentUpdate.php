<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agentUpdate extends Model
{
    //
    protected $table = 'dcf_update_agent';
    protected $guarded = ['id'];
    protected $fillable = array(
        'agent_update',
    );
    // Enable SCHEDULER
    // SHOW GLOBAL VARIABLES
    //SET GLOBAL event_scheduler = ON;
    //
    // Create Procedure
    /*
        CREATE DEFINER = 'docflowapi'@'%' PROCEDURE `agent_count`()
        NOT DETERMINISTIC
        CONTAINS SQL
        SQL SECURITY DEFINER
        COMMENT ''
        BEGIN
            INSERT INTO dcf_update_client (agent_update)
                SELECT date_update from vw_count_updated_day
        END;
    */

    // CREATE EVENT
    /*
    CREATE EVENT sch_agent_update
        ON SCHEDULE
  	        EVERY 1 DAY
        ENABLE
        COMMENT 'Atualiza em quantos clientes foram executados o agent no dia'
        DO
  	        BEGIN
		        INSERT INTO dcf_update_client (agent_update)
	  		        SELECT date_update from vw_count_updated_day;
            END
     */
}
