<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Memberinsurance extends Model
{
	
    protected $table = 'memberinsurance';
    public $timestamps = false;


    public function sportorder()
    {
        //其中第一个参数是关联模型的类名。第二个参数是当前模型类所属表的外键，//第三个参数是关联模型类所属表的主键：
        return $this->belongsTo(SMemberOrder::class,'oid','id');
    }


}
