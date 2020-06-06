<?php

namespace App\Http\Controllers\Api;

use App\Models\SMemberOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use EasyWeChat\Factory;
use function EasyWeChat\Kernel\Support\generate_sign;
use Cache;
use App\Models\User;
class WechatController extends Controller
{
    //

    public function wechat(Request $request)
    {
        $data = $request->all();

        $app = \EasyWeChat::miniProgram();
        $wq = $app->auth->session($data['code']); // $code 为wx.login里的code
//        dd($wq);
        if (isset($wq['errcode'])) {
            return $this->success('code已过期或不正确');
        }
        $weappOpenid = $wq['openid'];
        $weixinSessionKey = $wq['session_key'];
        $user = User::where('weapp_openid', $weappOpenid)->first();
        //没有，就注册一个用户
        if (!$user) {
            $user = new User();
            $user->weapp_openid = $weappOpenid;
            $user->token = $weixinSessionKey;
            $user->nickname = $data['userInfo']['nickName'];
            $user->weapp_avatar = $data['userInfo']['avatarUrl'];
            $user->save();
        }else{
            $user->weapp_openid=$weappOpenid;
            $user->token=$weixinSessionKey;
            $user->nickname=$data['userInfo']['nickName'];
            $user->weapp_avatar=$data['userInfo']['avatarUrl'];
            $user->save();
        }
        return $this->success(['token'=>$user['token']]);
    }

    //获取用户信息
    public function getuser(Request $request)
    {

        $data=$request->all();
        if (!$request->has('token')) {
            return response()->json([
                'code' => '400',
                'msg' => '请先登录'
            ]);
        }
        $res=User::with('member')->where('token',$data['token'])->first();
        if($res){
            return $this->success($res);
        }else{
            return $this->failed('请登陆');
        }
    }


    public function cache()
    {

        $value = Cache::get('key');
        $value1 = Cache::get('key1');
        dump($value);
        dump($value1);
    }
}
