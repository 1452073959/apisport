<?php

namespace App\Http\Controllers\Api;

use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VenueController extends Controller
{
    //

    public function venue()
    {
        $venue=Venue::with('lease')->get();

        foreach ($venue as $k1=>$v1)
        {
            $venue[$k1]['venueimg'] = config('app.url') . 'uploads/' . $v1['venueimg'];
        }

        return $venue;
    }

}
