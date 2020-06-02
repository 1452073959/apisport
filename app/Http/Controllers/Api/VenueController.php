<?php

namespace App\Http\Controllers\Api;

use App\Models\SVenue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VenueController extends Controller
{
    //

    public function venue()
    {
        $venue=SVenue::all();
        foreach ($venue as $k1=>$v1)
        {
            $venue[$k1]['venueimg'] = config('app.url') . 'uploads/' . $v1['venueimg'];
        }

        return $venue;
    }

}
