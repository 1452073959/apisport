<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
	
    protected $table = 'lease';
    public $timestamps = false;
    protected $fillable = ['name','description','price'];
    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id','id');
    }

}
