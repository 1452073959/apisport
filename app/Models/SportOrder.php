<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SportOrder extends Model
{
	
    protected $table = 'sport_order';
    public $timestamps = false;



    //一对多反向
    public function user()
    {
        //其中第一个参数是关联模型的类名。第二个参数是当前模型类所属表的外键，//第三个参数是关联模型类所属表的主键：
        return $this->belongsTo(User::class,'uid','id');
    }

    //一对多反向
    public function venue()
    {
        //其中第一个参数是关联模型的类名。第二个参数是当前模型类所属表的外键，//第三个参数是关联模型类所属表的主键：
        return $this->belongsTo(Venue::class,'vid','id');
    }
}
