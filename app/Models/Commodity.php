<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
	
    protected $table = 'commodity';
    public $timestamps = false;
    public function getStarttimeAttribute($date)
    {
        return date('Y-m-d H:i',strtotime($date));
    }
    public function getEndtimeAttribute($date)
    {
        return date('Y-m-d H:i',strtotime($date));
    }
}
