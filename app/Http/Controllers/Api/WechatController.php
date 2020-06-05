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

    public function xiadan(Request $request)
    {
        $data = $request->all();
        //获取用户信息
        $user=User::with('member')->where('token',$data['token'])->first();
//        dd($user);
        $order=new SMemberOrder();
        $order->user_id=$user['id'];
        $order->member_id=$data['member'];
        $order->open_money=$data['money'];
//        $order->insurance=$data['insurance'];
        $order->save();
        $payment = \EasyWeChat::payment(); // 微信支付
        $result = $payment->order->unify([
            'body' => '你自己想写的111名称',
            'out_trade_no' => $order['ordernum'],
            'trade_type' => 'JSAPI',  // 必须为JSAPI
            'openid' => $user['weapp_openid'], // 这里的openid为付款人的openid
            'total_fee' => $data['money']*100, // 总价
        ]);

// 如果成功生成统一下单的订单，那么进行二次签名
        if ($result['return_code'] === 'SUCCESS') {
            // 二次签名的参数必须与下面相同
            $params = [
                'appId' => 'wxe14c531956fe8477',
                'timeStamp' => (string)time(),
                'nonceStr' => $result['nonce_str'],
                'package' => 'prepay_id=' . $result['prepay_id'],
                'signType' => 'MD5',
//                'notify_url'=>'http://shop.xinxiaxue.cn/payment/alipay/notify'
            ];
            // config('wechat.payment.default.key')为商户的key
            $params['paySign'] = generate_sign($params, config('wechat.payment.default.key'));
//            dump($params);
            return $params;

        } else {
            return $result;
        }

    }

    public function order()
    {
        $payment = \EasyWeChat::payment(); // 微信支付
      $a=  $payment->order->queryByOutTradeNumber("20200605155252679125");
        dd($a);
    }

    public function tongzhi()
    {
         Cache::put('key1', 1232321);

        $app = \EasyWeChat::payment(); // 微信支付
        $response = $app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            Cache::put('key',$message );
            $order = SMemberOrder::where('ordernum',$message['out_trade_no'])->first();
            if (!$order || $order->paid_at) { // 如果订单不存在 或者 订单已经支付过了
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $order->paid_at = $data=date('y-m-d h:i:s',time());; // 更新支付时间为当前时间
                    $order->status = 1;
                    // 用户支付失败
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    $order->status = 0;
                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }

        });
        return $response;
    }

    public function cache()
    {

        $value = Cache::get('key');
        $value1 = Cache::get('key1');
        dump($value);
        dump($value1);
    }
}
