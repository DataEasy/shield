<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dataGraphics extends Model
{
    //
    protected $table = 'dcf_datagraphics';
    protected $guarded = ['id'];
    protected $fillable = array(
        'count_agent_run',
        'count_client',
    );


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
