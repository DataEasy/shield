<?php

namespace App\Http\Controllers\Main;

use App\countAgentRun;
use App\docflowProperties;
use App\Http\Controllers\Controller;
use App\vwCountVersion;


class MainController extends Controller
{
    //
    public function dashboardMain(){

        //try {
            $countClient = $this->countClient();

            if ( $countClient == 0) {
                $message = "Não existem clientes cadastrados na Base de Dados!";
                return view('dashboard.dash')->with('message', $message);
            } else {


                $countVersion = $this->countVersion();
                $lastVersion = $this->lastVersion();
                $systemVersion = $this->systemVersion();
                $systemVersionMax = $this->systemVersionMax();
                $listClient = $this->listClient();
                $updated = $this->countUpdated();

                $lastUpdate = $this->lastUpdated();
                $lastUpdateDate = date('d.m.Y',strtotime($lastUpdate));
                $lastUpdateTime = date('H:i:s',strtotime($lastUpdate));
                $message = null;

                return view('dashboard.dash')
                    ->with('countClient',$countClient)
                    ->with('countVersion',$countVersion)
                    ->with('lastUpdateDate',$lastUpdateDate)
                    ->with('lastUpdateTime',$lastUpdateTime)
                    ->with('lastVersion',$lastVersion)
                    ->with('systemVersion',$systemVersion)
                    ->with('systemVersionMax',$systemVersionMax)
                    ->with('listClient',$listClient)
                    ->with('updated',$updated)
                    ->with('message', $message);
            }
        /*} catch ( \Exception $exception ){
            return $exception;
        }*/
    }

    public function teste(){
        $countClient = $this->countClient();
        echo $countClient;
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

    // Pega o maior valor na contagem das quantidade de versões
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

    // Conta a Quantidade de Clientess
    public function countClient(){
        $countClient = docflowProperties::all()->count();
        return $countClient;
    }

    // Lista a table dcf_properties
    public function listClient(){
        $listClient = docflowProperties::all();
        return $listClient;
    }

    // Conta quantos updates tiveram no dia
    public function countUpdated(){
        $updated = countAgentRun::all();
        return $updated;
    }
}
