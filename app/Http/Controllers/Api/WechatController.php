<?php

namespace App\Http\Controllers\Api;

use App\Models\CommodityOrder;
use App\Models\SMemberOrder;
use App\Models\SportOrder;
use App\Models\Swipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use EasyWeChat\Factory;
use function EasyWeChat\Kernel\Support\generate_sign;
use Cache;
use App\Models\User;
use App\Models\UserMember;
use function PHPSTORM_META\type;

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

    /**
     * @param Request $request
     * @return mixed
     */
    public function no(Request $request){
        $data=$request->all();
        $user=User::with('member')->where('token',$data['token'])->first();

        if ($request->input('no')) {
            $where[] = ['no', $request->input('no')];
        }
        $payment = \EasyWeChat::payment(); // 微信支付
       $weixin= $payment->order->queryByOutTradeNumber($request->input('no'));
        $record=SportOrder::with('venue','user')->where($where)->first();
        return $this->success([$weixin,$record]);
    }

    public function del(Request $request){
        $data=$request->all();
        $user=User::with('member')->where('token',$data['token'])->first();
        if ($request->input('no')) {
            $where[] = ['no', $request->input('no')];
        }
        if($request->input('type')==0){
            $record=SportOrder::where($where)->delete();
        }
        if($request->input('type')==1){
            $record=CommodityOrder::where($where)->delete();
        }
        if($request->input('type')==2){
            $record=SMemberOrder::where($where)->delete();
        }
        return $this->success($record);
    }

    public function xiadan(Request $request)
    {
        $data=$request->all();
        $user=User::with('member')->where('token',$data['token'])->first();
        $newno=$data['no'].mt_rand(1,100);
        if($request->input('type')==0){
            SportOrder::where('no',$data['no'])->update(['no'=>$newno]);
        }
        if($request->input('type')==1){
            $record=CommodityOrder::where('no',$data['no'])->update(['no'=>$newno]);
        }
        if($request->input('type')==2){
            $record=SMemberOrder::where('no',$data['no'])->update(['no'=>$newno]);
        }
        $payment = \EasyWeChat::payment(); // 微信支付
        $result = $payment->order->unify([
            'body' =>$data['title'],
            'out_trade_no' => $newno,
            'trade_type' => 'JSAPI',  // 必须为JSAPI
            'openid' => $user['weapp_openid'], // 这里的openid为付款人的openid
            'total_fee' => $data['money']*100, // 总价
//            'notify_url'=> config('app.url').'member/notify'
            'notify_url'=>config('app.url').'api/venue/notify'
        ]);
        dd($result);
        // 如果成功生成统一下单的订单，那么进行二次签名
        if ($result['return_code'] === 'SUCCESS') {
            // 二次签名的参数必须与下面相同
            $params = [
                'appId' => 'wxe14c531956fe8477',
                'timeStamp' => (string)time(),
                'nonceStr' => $result['nonce_str'],
                'package' => 'prepay_id=' . $result['prepay_id'],
                'signType' => 'MD5',
            ];
            $params['paySign'] = generate_sign($params, config('wechat.payment.default.key'));
            return $params;
        } else {
            return $result;
        }
    }


}
