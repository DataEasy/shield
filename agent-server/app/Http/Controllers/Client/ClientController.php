<?php

namespace App\Http\Controllers\Client;

use App\docflowProperties;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Return List Client on table dcf_properties
    public function listAllClient(){

        try{

            $clients = docflowProperties::all()->sortBy('cli_name');
            return $clients;

        } catch ( \Exception $exception ){
            return $exception;
        }
    }

    public function listClientDashboard(){

        try{
            $clientDash = docflowProperties::all()->take(10)->sortByDesc('updated_at');
            return $clientDash;

        } catch ( \Exception $exception ){
            return $exception;
        }

    }

    // Show Details Client
    public function clientDetails($id) {

//        $id = $id;
        $properties = docflowProperties::where('id','=',$id)->get();
        return view('client.clientdetails')
                    ->with('properties',$properties);
    }

    public function clientDetailsResume($id) {

//        $id = $id;
        $properties = docflowProperties::where('id','=',$id)->get();
        $properties = json_decode($properties[0]->config_properties);

        return view('client.clientdetailsresume')
            ->with('properties',$properties);

    }
}
