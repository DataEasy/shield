<?php

namespace App\Http\Controllers\Agent;

use App\docflowProperties;
use App\Http\Controllers\DB;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    //
    public function teste(){

        return view('test.test');

    }

    public function readJSON(Request $request) {

        try{
            // Test connection with DB
            app('App\Http\Controllers\DB\DBController')->DBConn();

            $client_config_properties = json_encode($request->all());
            $client_name = $request->input(array('docflow.client'));
            $client_cnpj = $request->input(array('docflow.client.cnpj'));
            $client_env = $request->input(array('docflow.client.environment'));
            $client_system_version = $request->input(array('docflow.versao.sistema'));

            if ( ($client_env == "PRODUCTION") or ($client_env == "HOMOLOGATION") or ($client_env == "TRAINING") or ($client_env == "DEMO") ){
                // Find DB - Client Name / Client Environment / Client CNPJ
                $find_client = docflowProperties::where('cli_name',$client_name)->where('cli_cnpj', $client_cnpj)->where('cli_env', $client_env)->first();

                if ( empty($find_client) ){

                    // New Client
                    $client = new docflowProperties();
                    $client->cli_name = $client_name;
                    $client->cli_cnpj = $client_cnpj;
                    $client->cli_env = $client_env;
                    $client->cli_version_system = $client_system_version;
                    $client->config_properties = $client_config_properties;
                    $client->created_at = Carbon::now('America/Sao_Paulo');
                    $client->updated_at = Carbon::now('America/Sao_Paulo');
                    $client->save();

                } else {
                    // Update Client
                    $find_client->cli_version_system = $client_system_version;
                    $find_client->config_properties = $client_config_properties;
                    $find_client->updated_at = Carbon::now('America/Sao_Paulo');
                    $find_client->save();

                }

                return "Client Save";

            } else {
                $error = "Environment Error! Try: PRODUCTION or HOMOLOGATION or TRAINING or DEMO. Sending: " . $client_env;
                return $error;
            }



        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";

            }
    }

    public function listJSON(){

        $client = docflowProperties::all()->first();
        return json_decode($client->config_properties, true);

    }

}
