<?php

namespace App\Http\Controllers\Api;

use App\Models\SMemberOrder;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;

class loginController extends Controller
{
    //中间件
    public function __construct()
    {
//        $this->middleware('sport')->only('getuser');

    }
    //登陆
    public function code(LoginRequest $request)
    {
        $code=$request->input('code');
        $url="https://api.weixin.qq.com/sns/jscode2session?appid=wx0f8e31fa7cdd52bd&secret=61ec689d9f424b5c969a44481d83035f&js_code=".$code."&grant_type=authorization_code";
        $verify= json_decode($this->httpget($url),true);
        return $verify;
    }

    //保存及更新用户
    public function updateUserInfo(Request $request)
    {
        $data=$request->all();
        $exist=User::where('openid',$data['openid'])->first();
        if(empty($exist)){
            $user=new User();
            $user->name=$data['userInfo']['nickName'];
            $user->avatarurl=$data['userInfo']['avatarUrl'];
            $user->openid=$data['openid'];
            $user->remember_token=$data['session_key'];
            $user->save();
            return $user;
        }else{
            $exist->name=$data['userInfo']['nickName'];
            $exist->avatarurl=$data['userInfo']['avatarUrl'];
            $exist->openid=$data['openid'];
            $exist->remember_token=$data['session_key'];
            $exist->save();
            return $exist;
        }
    }
    //获取用户信息
    public function getuser(Request $request)
    {
        $data=$request->all();
        $res=User::with('member')->where('remember_token',$data['token'])->first();
       if($res){
           return $this->success($res);
       }else{
           return $this->failed('请登陆');
       }
    }
}
