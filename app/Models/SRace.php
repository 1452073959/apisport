<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class SRace extends Model
{
	
    protected $table = 's_race';
    public $timestamps = false;

//    public function getSmallimgAttribute($value)
//    {
//        return config('app.url').'uploads/'.$value;
//    }
//
//    public function getBigimgAttribute($value)
//    {
//        return config('app.url').'uploads/'.$value;
//    }
//
//    public function getTimeAttribute($value)
//    {
//        $datetime=strtotime($value);
//        return [
//            'date'=>date('Y-m-d',$datetime),
//            'time'=>date('H:i',$datetime),
//            'day'=> Carbon::parse($value)->diffForHumans(),
//        ];
//    }
}
