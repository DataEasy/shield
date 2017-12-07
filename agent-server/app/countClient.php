<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class countClient extends Model
{
    //
    protected $table = 'vw_count_client';
    protected $fillable = array(
        'countClient'
    );
}
