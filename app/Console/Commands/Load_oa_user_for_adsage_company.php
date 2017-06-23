<?php

namespace App\Console\Commands;

use App\Entities\OaUsers;
use Illuminate\Console\Command;

class Load_oa_user_for_adsage_company extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:oa_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '导入oa user信息';

    protected $oaUsers;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OaUsers $oaUsers)
    {
        parent::__construct();
        $this->oaUsers = $oaUsers;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {


        //
//        $startId = 1;
//        $endId = 5000;
//
//        for($userId=$startId; $userId<$endId; $userId++){
//
//            $url = "http://kaoqin.adsage.com/iclock/staff/employee/?UserID__id__exact={$userId}&fromTime=&toTime=";
//            $userInfo = file_get_contents($url);
//            $json = json_decode($userInfo, true);
//            print_r($json);
//        }

        $this->oaUsers->loadUser();
    }
}
