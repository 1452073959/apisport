<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LeaseTenancy extends Model
{
	
    protected $table = 'lease_tenancy';
    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
                $model->name ='整租';
                $model->description ='整租为每小时价格';
        });
    }

}
