
@extends('layouts.main')
@include('layouts.header')

@include('layouts.message-block')


@section('title')
hihi!
@stop

@php
$totalWorkTime = 0;
$totalAddTime = 0;
$totalAddMinutes = 0;
$totalAddHour = 0;
@endphp

 @section('content')
    <table class="table table-bordered">
        <tr>
            <th>日期</th>
            <th>上班打卡时间</th>
            <th>上班打卡时间</th>
            <th>工作时长</th>
            <th>加班时长</th>
            <th>是否加班</th>
            <th>是否忘记打卡</th>
        </tr>

    @foreach($dataForMonth as $date=> $row)
        @php( $totalWorkTime += $row['work_time'] )
        @php( $addTimeArray = $row['add_time'] ? explode('.', $row['add_time']) : 0)
        @php( $hour = $addTimeArray[0] )
        @php( $minutes = ($addTimeArray[1]>30 ? 30 : 0) )
        @php( ((array_key_exists(1, $row['clocktime']) && date('H', strtotime($row['clocktime'][1])) > 20) || $row['add_time']>1.5)   &&  ($totalAddHour += $hour))
        @php( ((array_key_exists(1, $row['clocktime']) && date('H', strtotime($row['clocktime'][1])) > 20) || $row['add_time']>1.5)   &&  ($totalAddMinutes += $minutes))
    @endforeach
        <tr class="">
            <td>统计</td>
            <td colspan="2"></td>
            <td > <span class="badge">{{ $totalWorkTime  }}</span></td>
            <td ><span class="badge">{{ $totalAddHour+($totalAddMinutes/60) . '.' . ($totalAddMinutes%60)  }}</span></td>
            <td colspan="2"></td>
        </tr>

    @foreach($dataForMonth as $date=> $row)
        
        <tr>
            <td>{{$date}}({{getDateWord($row['day_of_week'])}})</td>
            <td>{{array_key_exists(0, $row['clocktime']) ? $row['clocktime'][0] : ''}}</td>
            <td>{{array_key_exists(1, $row['clocktime']) ? $row['clocktime'][1] : ''}}</td>
            <td>{{$row['work_time']}}</td>
            <td>{{$row['add_time']}}</td>
            <td>{{$row['add_time']?'是':'否'}}</td>
            <td>{{$row['foget_card']==0 ? '否': ($row['foget_card']==1?'上午忘记打卡' : ($row['foget_card']==2?'下午忘记打卡': '全天未打卡'))}}</td>
        </tr>

    @endforeach


    </table>
 @stop
 

<?php
    function getDateWord($i){

        $value = '';
        switch ($i) {
            case 1:
                # code...
                $value ='周一';
                break;
            case 2:
                # code...
                $value ='周二';
                break;
            case 3:
                # code...
                $value ='周三';
                break;
            case 4:
                # code...
                $value ='周四';
                break;
            case 5:
                # code...
                $value ='周五';
                break;
            case 6:
                # code...
                $value ='周六';
                break;
            case 7:
                # code...
                $value ='周日';
                break;                
            
            default:
                # code...
                break;
        }
        return $value;
    }
?>