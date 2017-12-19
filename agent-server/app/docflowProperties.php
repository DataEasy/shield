<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class docflowProperties extends Model
{
    //
    protected $table = 'dcf_properties';
    protected $guarded = ['id'];
    protected $fillable = array(
        'cli_cnpj',
        'cli_name',
        'cli_env',
        'cli_version_system',
        'config_properties'
    );

    public $timestamps = false;
}
