<?php

namespace App\Http\Controllers\Main;

use App\docflowProperties;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Controller;
use App\vwCountVersion;


class MainController extends Controller
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

    public function dashboardMain(){

        try {
            $countClient = $this->countClient();

            if ( $countClient == 0) {
                $message = "Não existem clientes cadastrados na Base de Dados!";
                return view('dashboard.start')->with('message', $message);
            } else {

                $clientsList = new ClientController();
                $clients = $clientsList->listClientDashboard();

                $countVersion = $this->countVersion();
                $lastVersion = $this->lastVersion();
                $systemVersion = $this->systemVersion();
                $systemVersionMax = $this->systemVersionMax();
                $sumVersions = $this->sumVersions();
                $lastUpdate = $this->lastUpdated();
                $lastUpdateDate = date('d.m.Y',strtotime($lastUpdate));
                $lastUpdateTime = date('H:i:s',strtotime($lastUpdate));
                $message = null;

                return view('dashboard.dashboard')
                    ->with('countClient',$countClient)
                    ->with('countVersion',$countVersion)
                    ->with('lastUpdateDate',$lastUpdateDate)
                    ->with('lastUpdateTime',$lastUpdateTime)
                    ->with('lastVersion',$lastVersion)
                    ->with('systemVersion',$systemVersion)
                    ->with('systemVersionMax',$systemVersionMax)
                    ->with('sumVersions',$sumVersions)
                    ->with('clients', $clients)
                    ->with('message', $message);
            }
        } catch ( \Exception $exception ){
            return $exception;
        }
    }

    public function dashboardClient(){

        try {
            $countClient = $this->countClient();

            if ( $countClient == 0) {
                $message = "Não existem clientes cadastrados na Base de Dados!";
                return view('dashboard.dashboard')->with('message', $message);
            } else {

                $clientsList = new ClientController();
                $clients = $clientsList->listAllClient();
                $message = null;

                return view('client.client')
                    ->with('countClient',$countClient)
                    ->with('clients', $clients)
                    ->with('message', $message);
            }
        } catch ( \Exception $exception ){
            return $exception;
        }
    }

    public function teste(){
        $clients = new ClientController();
        return $clients->listClientDashboard();
    }

    public function lastUpdated(){

        $lastupdate = docflowProperties::max('updated_at');
        return $lastupdate;

    }

    // Listagem da versão do sistema por ordem de versão
    public function systemVersion(){
        $systemVersion = vwCountVersion::all()->sortBy('version');
        return $systemVersion;
    }

    // Retorna o maior valor na contagem das quantidade de versões
    public function systemVersionMax(){
        $systemVersionMax = vwCountVersion::select('count')->max('count');
        return $systemVersionMax;
    }

    //Lista a versão mais recente instalada em cliente
    public function lastVersion(){
        $lastVersion = docflowProperties::select('cli_version_system')->orderBy('cli_version_system','desc')->take(1)->get();
        return $lastVersion[0]->cli_version_system;
    }

    // Conta a quantidade de versões
    public function countVersion(){
        $countVersion = vwCountVersion::all()->count();
        return $countVersion;
    }

    // Conta a Quantidade de Clientes
    public function countClient(){
        $countClient = docflowProperties::all()->count();
        return $countClient;
    }

    // Return sum versions
    public function sumVersions(){
        $sumVersions = vwCountVersion::select('count')->sum('count');
        return $sumVersions;
    }
}
