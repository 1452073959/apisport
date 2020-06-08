<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Swipe extends Model
{
	
    protected $table = 'swipe';
    public $timestamps = false;
    protected $casts = [
        'img' => 'json',
    ];
    protected $hidden = [
    'id'
    ];
}
