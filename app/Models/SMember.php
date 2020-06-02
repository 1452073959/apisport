<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SMember extends Model
{
	
    protected $table = 's_member';

    public function order()
    {
        return $this->hasMany(SMemberOrder::class,'member_id','id');
    }
}
