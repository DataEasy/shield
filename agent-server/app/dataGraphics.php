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

}
