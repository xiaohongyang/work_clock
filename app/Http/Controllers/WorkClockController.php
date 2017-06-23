<?php

namespace App\Http\Controllers;

use App\WorkClock;
use Illuminate\Http\Request;

class WorkClockController extends Controller
{
    //
    public function dashboard(Request $request){

        $workClock = new WorkClock();

        $startDate = $request->get('startdate', '2016-07-01');
        $endDate = $request->get('enddate', '2016-07-30');

        $rs = $workClock->getDataForDateRange($startDate, $endDate);
        //print_r($rs);

    	$rs2 = $this->_removeIvalidDate($rs);

    	$reconDate = $this->_reconDate($rs2, $startDate, $endDate);
        return view('dashboard', ['dataForMonth' => $reconDate]);
    }


    //去除一天内没用的打卡记录，留下最早的和最晚的
    private function _removeIvalidDate($data){
    	//1.按日分组
    	$result = [];
    	$tmpArray = $data;
    	if (count($data)) {
			foreach($data as $key => $value){
				$date = date('Y-m-d', strtotime($value->clocktime));
				$result[$date][] = $value->clocktime;
			}
    	}
    	//2.去除一天内多余的打卡记录，留下最早和最晚的两条记录
    	foreach ($result as $key => $value) {
    		# code...
    		if(count($result[$key]) > 2){
    			$count = count($result[$key]);
				  
				$tmp = array_slice($result[$key], 1, $count-2);
				$result[$key] = array_diff($result[$key], $tmp);
				$result[$key][1] = $result[$key][$count-1];
				unset($result[$key][$count-1]);

    		}
    	}
 
    	return $result;
    }

    //重组数据
    private function _reconDate($data, $dateBegin, $dateEnd){

    	$result = [];
    	$dateExists = array_keys($data);
    	$date = $dateBegin;

    	while ($date <= $dateEnd) {

 			$key = $date;

			$dayOfWeek = date('w', strtotime($date));
    		$item = [
    			'day_type' => 0,	//0休息日 	1工作日
    			'foget_card' => 0, // 0未忘记打卡(或不需要打卡) 	1上午忘记打卡   2下午忘记打卡  	3一天都没有打卡
    			'work_time' => 0,		//工作时长
    			'add_time' => 0,		//加班时长
    			'day_of_week' => $dayOfWeek != 0? $dayOfWeek : 7,
    			'clocktime' => []
    		];
    		$item['day_type'] = $item['day_of_week'] >= 6 ? 0 : 1;
 


 			if(!key_exists($key, $data)){
				if(in_array($dayOfWeek, [0,6])){
	    		} else {
					$item['foget_card'] = 3;	 	
	    		}
 			} else {

 				$item['clocktime'] = $data[$date];
 				$theDayData = $data[$key];  

 				if((int)date('H',(strtotime($theDayData[0]))) < 9){

					$bTime =  strtotime( date('Y-m-d 09:00:01', strtotime($theDayData[0]) ));
					$workTime = count($theDayData) == 2
						? (int)((strtotime($theDayData[1])- $bTime)/3600 ) . '.' . (int)(((strtotime($theDayData[1])- $bTime)%3600)/60 ): 0;

                    (float)$workTime > 9.3 ? $subtime = 3600*9.5  : $subtime=0;

                    $addTime = count($theDayData) == 2
						? (int)((strtotime($theDayData[1])- $bTime - $subtime)/3600 ) . '.' . (int)(((strtotime($theDayData[1])- $bTime -$subtime)%3600)/60 ): 0;
 				} else {

                    $bTime =  strtotime( date('Y-m-d H:i:01', strtotime($theDayData[0]) ));
                    //$bTime = $bTime - ((int)strtotime( date('H', strtotime($theDayData[0]) ))-9)*60 - (int)strtotime( date('i', strtotime($theDayData[0]) ));
                    $workTime = count($theDayData) == 2
                        ? (int)((strtotime($theDayData[1])- $bTime)/3600 ) . '.' . (int)(((strtotime($theDayData[1])- $bTime)%3600)/60 ): 0;

                    (float)$workTime > 9.3 ? $subtime = 3600*9.5  : $subtime=0;

                    $addTime = count($theDayData) == 2
                        ? (int)((strtotime($theDayData[1])- $bTime - $subtime)/3600 ) . '.' . (int)(((strtotime($theDayData[1])- $bTime -$subtime)%3600)/60 ): 0;
 				}

				 

				if(in_array($dayOfWeek, [0,6])){
	    			//休息日
					$item['work_time'] = $workTime;
                    $item['add_time'] = $workTime > 4 ? $workTime-1 : $workTime;
	    		} else {
	    			//工作日

					$item['work_time'] = $workTime;
                    $item['add_time'] = $addTime>0 && $workTime>=10 ?$addTime:0;
	    		}

				if(count($theDayData)==0){

					$item['foget_card']	= $item['day_type']==0? 0 : 3;
				}
				if(count($theDayData)<2){
	 
					if((int)date('H', strtotime($date)) > 12){
						$item['foget_card'] = 1;
					} else {
						$item['foget_card'] = 2;
					}
				}	
 			}

 			// if($item['work_time'] && array_key_exists(0, $theDayData) &&  date('H', strtotime($theDayData[0])<9)){
 			// 	$hourAndMinutes = date('H-i', strtotime($theDayData[0]));
				// $arr = explode('-', $hourAndMinutes);
				// $hour = $arr[0];
				// $minutes = $arr[1];
				// $hour = ( 9-(int)$hour + (int)$minutes/100) ;
 			// 	$item['work_time'] -= $hour;
 			// 	if($item['work_time'] > 9){
 			// 		$item['work_time'] -= 1;
 			// 	} else if($item['work_time'] > 4){
 			// 		$item['work_time'] -= 0.5;
 			// 	}
 			// }

			$result[$key] = $item;

    		$date = date('Y-m-d', strtotime($date)+24*3600 );
    	}

    	return $result;
    }


}
