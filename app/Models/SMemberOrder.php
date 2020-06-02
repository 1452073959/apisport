<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SMemberOrder extends Model
{
	
    protected $table = 's_member_order';
    public $timestamps = false;

    public function member()
    {
        //其中第一个参数是关联模型的类名。第二个参数是当前模型类所属表的外键，//第三个参数是关联模型类所属表的主键：
        return $this->belongsTo(SMember::class,'member_id','id');
    }

    public function user()
    {
        //其中第一个参数是关联模型的类名。第二个参数是当前模型类所属表的外键，//第三个参数是关联模型类所属表的主键：
        return $this->belongsTo(User::class,'user_id','id');
    }

}
