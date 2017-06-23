<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use League\Flysystem\Exception;

class OaUsers extends Model
{
    //
    public $table = 'oa_users';
    public $timestamps = false;
    public function loadUser(){

//        $startId = 1;
//        $endId = 1500;
        $startId = 3489;
        $endId = 5500;

        set_time_limit(0);

        for($userId=$startId; $userId<$endId; $userId++){


            if ($this->where('clock_uid', $userId)->count()){

                echo "user already exist !\r\n";
                continue;
            }

            $url = "http://kaoqin.adsage.com/iclock/staff/employee/?UserID__id__exact={$userId}&fromTime=&toTime=";
            $userInfo = file_get_contents($url);
            $userInfo = json_decode($userInfo, true);
            if (!is_array($userInfo) || !count($userInfo)){
                echo sprintf("数据不存在 (clock_uid:%s) \r\n", $userId);
                continue;
            }

            $userInfo = $userInfo[0];
            $userInfo['clock_uid'] = $userId;
            $rs = $this->insert($userInfo);
            if($rs)
                echo sprintf("save %s (clock_uid:%s) \r\n", $rs ? 'OK' : 'Failed', $userInfo['clock_uid']);
            else
                echo sprintf("save %s \r\n", $rs ? 'OK' : 'Failed');
            echo "   ";

            set_error_handler(
                function ($errno, $errstr, $errfile, $errline, $errcontext) {
                    $constants = get_defined_constants(1);

                    $eName = 'Unknown error type';
                    foreach ($constants['Core'] as $key => $value) {
                        if (substr($key, 0, 2) == 'E_' && $errno == $value) {
                            $eName = $key;
                            break;
                        }
                    }

                    $msg = $eName . ': ' . $errstr . ' in ' . $errfile . ', line ' . $errline;

                    throw new Exception($msg);
                }, E_ALL);
            try{
                flush();
                ob_flush();
            }catch (Exception $e){
                echo substr($e->getMessage(),0,30)."\r\n";
            }
        }
    }

    public function getCreatedAtColumn()
    {
        return parent::getCreatedAtColumn(); // TODO: Change the autogenerated stub
    }
}
