<?php

namespace App\Http\Controllers\Api;

use App\Models\Commodity;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

class CommodityController extends Controller
{
    //
    //商品列表
    public function commoditylist()
    {
        $commoditylist=Commodity::all();
        return $this->success($commoditylist);
    }
}
