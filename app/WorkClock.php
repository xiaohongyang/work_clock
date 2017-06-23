<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkClock extends Model
{
    //
    public $table = 'loaddata_worktime';


    public function getForMonth($month, $year=null){

        $year = is_null($year) ? date('Y', time()) : $year;
        $dateBegin =  $year.'-'.$month.'-'.'01';
        $dateEnd = $year.'-'.$month.'-'.'31';
        return $this->getDataForDateRange($dateBegin, $dateEnd);
    }

    //指定开始日期到指定结束日期的考情时间
    public function getDataForDateRange($dateBegin, $dateEnd=null){

        if(is_null($dateBegin) && is_null($dateEnd))
            return [];

        $query = $this->where('clocktime', '!=', null);
        if(!is_null($dateBegin)){
            $query->where('clocktime', '>=', $dateBegin);
        }
        if(!is_null($dateEnd)){
            $query->where('clocktime', '<=', $dateEnd);
        }

        $query->orderBy('clocktime', 'asc');

        return $query->get();
    }

}
