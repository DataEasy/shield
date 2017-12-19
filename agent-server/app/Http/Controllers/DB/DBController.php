<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DBController extends Controller
{
    //
    public function DBConn(){

        try {
            DB::connection()->getPdo();

        } catch (\Exception $e){
            die("Could not connect to the database.  Please check your configuration.");
        }
    }
}
