<?php

namespace App\Http\Controllers\Api;

use App\Models\SMemberOrder;
use App\Models\Swipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use EasyWeChat\Factory;
use function EasyWeChat\Kernel\Support\generate_sign;
use Cache;
use App\Models\User;
use App\Models\UserMember;
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
            return $this->failed('code已过期或不正确');
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

            $usermemer=new UserMember();
            $usermemer->user_id=$user['id'];
            $usermemer->end_time = date('Y-m-d H:i:s',time());
            $usermemer->save();
        }else{
            $user->weapp_openid=$weappOpenid;
            $user->token=$weixinSessionKey;
            $user->nickname=$data['userInfo']['nickName'];
            $user->weapp_avatar=$data['userInfo']['avatarUrl'];
            $user->save();
        }
        return $this->success(['openid'=>$weappOpenid,'token'=>$user['token']]);
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
    //
    public function image()
    {
        $data=Swipe::all();
        $data2=[];
        foreach ($data as $k=>$v)
        {
            $data2=json_decode($v['img'],true);
        }

        foreach ($data2 as $k=>$v)
        {
            $data3[]=config('app.url') . 'uploads/' .$v;
        }

        return $this->success($data3);
    }


    public function cache()
    {

        $value = Cache::get('key');
        $value1 = Cache::get('key1');
        dump($value);
        dump($value1);
    }

    public function no(){

    }
}
