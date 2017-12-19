<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vwCountVersion extends Model
{
    //
    protected $table = 'vw_count_version_system';
    protected $fillable = array(
        'version',
        'count'
    );

}
