<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SMember extends Model
{
	
    protected $table = 's_member';
//    会员卡订单
    public function order()
    {
        return $this->hasMany(SMemberOrder::class,'member_id','id');
    }
    //会员卡所有保险
    public function posts()
    {
        return $this->hasManyThrough(Memberinsurance::class, SMemberOrder::class,'member_id','oid','id','id');
    }
}
