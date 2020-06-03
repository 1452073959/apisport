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
        foreach ($commoditylist as $k1=>$v1)
        {
            $commoditylist[$k1]['img'] = config('app.url') . 'uploads/' . $v1['img'];
        }

        return $this->success($commoditylist);
    }
}
