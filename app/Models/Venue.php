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
//第一个参数是关联模型的类名，第二个参数 $table 是建立多对多关联的中间表名
//第三个参数是 $foreignPivotKey 指的是中间表中当前模型类的外键
//第四个参数 $relatedPivotKey 是中间表中当前关联模型类的外键
//第五个参数 $parentKey 表示对应当前模型的哪个字段（
//第六个参数 $parentKey 表示对应当前模型的哪个字段（
//最后一个参数 $relation 表示关联关系名称，
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
