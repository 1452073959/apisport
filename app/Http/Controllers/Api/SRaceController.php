<?php

namespace App\Http\Controllers\Api;

use App\Models\SRace;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use DB;
use Carbon\Carbon;

class SRaceController extends Controller
{

//    获取赛程信息
    public function srace(Request $request)
    {
        $where = [];
        if ($request->input('projectcate')) {
            $where[] = ['projectcate', $request->input('projectcate')];
        }
        if ($request->input('city')) {
            $where[] = ['city', $request->input('city')];
        }
        if ($request->input('venue')) {
            $where[] = ['venue', $request->input('venue')];
        }

        $data = SRace::where($where)->paginate(15);
        $citydata = SRace::groupBy('city')->get();
        $projectcatedata = SRace::groupBy('projectcate')->get();
        $venuedata = SRace::groupBy('venue')->get();
        //城市
        $city = [];
        foreach ($citydata as $k => $v) {
            $city[] = $v['city'];
        }
//        类型
        $projectcate = [];
        foreach ($projectcatedata as $k => $v) {
            $projectcate[] = $v['projectcate'];
        }
        //场馆
        $venue = [];
        foreach ($venuedata as $k => $v) {
            $venue[] = $v['venue'];
        }
        //时间/图片路径/状态处理优化
        foreach ($data as $k1 => $v1) {
            $data[$k1]['time'] = [
                'date' => date('Y-m-d', strtotime($v1['time'])),
                'time' => date('H:i', strtotime($v1['time'])),
                'day' => Carbon::parse($v1['time'])->diffForHumans(),
            ];
            $data[$k1]['smallimg'] = config('app.url') . 'uploads/' . $v1['smallimg'];
            $data[$k1]['bigimg'] = config('app.url') . 'uploads/' . $v1['bigimg'];
            if ($v1['status'] == 1) {
                $data[$k1]['status'] = '赛事开始';
            }
            if ($v1['status'] == 2) {
                $data[$k1]['status'] = '赛事结束';
            }
            if ($v1['status'] == 0) {
                $data[$k1]['status'] = '未开始';
            }

        }
        return $this->success(['srace' => $data, 'city' => $city, 'projectcate' => $projectcate, 'venue' => $venue]);
    }

}
