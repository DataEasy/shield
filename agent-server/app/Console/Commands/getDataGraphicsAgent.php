<?php

namespace App\Console\Commands;

use App\countAgentRun;
use App\countClient;
use App\dataGraphics;
use Illuminate\Console\Command;
use function MongoDB\BSON\fromJSON;
use function MongoDB\BSON\toJSON;

class getDataGraphicsAgent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getDataGraphicsAgent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Atualiza a quantidade de Agents que rodaram no dia';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $countAgent = countAgentRun::all();
        $countAgent = json_decode($countAgent, true);
        $countAgent = $countAgent[0]["countAgentRun"];

        $countClient = countClient::all();
        $countClient = json_decode($countClient, true);
        $countClient = $countClient[0]["countClient"];
        //echo "countAgentRun: " . $countAgent;
        //echo "countClient: " . $countClient;

        $count = new dataGraphics();
        $count->count_agent_run = $countAgent;
        $count->count_client = $countClient;
        $count->save();

    }
}
