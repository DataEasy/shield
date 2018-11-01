<?php

namespace App\Http\Controllers\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DBController extends Controller
{
    //


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DBConn(){

        try {
            DB::connection()->getPdo();

        } catch (\Exception $e){
            die("Could not connect to the database.  Please check your configuration.");
        }
    }
}
