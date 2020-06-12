<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
	
    protected $table = 'venue';
    protected $fillable = ['name'];
    //租赁方式
    public function lease()
    {
        return $this->hasMany(Lease::class,'venue_id','id');
    }
    //整租
    public function tenancy()
    {
        return $this->hasOne(LeaseTenancy::class,'venue_id','id');
    }

//    public function lease()
//    {
//        return $this->belongsToMany(Lease::class,'Svenue_Rlease','s_venue_id','r_lease_id','id','id');
//    }


//
//    public function getExtraAttribute($extra)
//    {
//        return array_values(json_decode($extra, true) ?: []);
//    }
//
//    public function setExtraAttribute($extra)
//    {
//        $this->attributes['extra'] = json_encode(array_values($extra));
//    }
//
//    protected $casts = [
//        'extra' => 'json',
////        'lease' => 'json',
//    ];
}
