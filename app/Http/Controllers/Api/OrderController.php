<?php

namespace App\Http\Controllers\Api;

use App\Models\SportOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class OrderController extends Controller
{
    //

    public function orderlist()
    {
        $data=SportOrder::with('user','venue')->get();
        return $this->success($data);
    }
}
