<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use EasyWeChat\Factory;
use function EasyWeChat\Kernel\Support\generate_sign;
class WechatController extends Controller
{
    //

    public function  wechat(Request $request)
    {
        $code=$request->input('code');
        $app = \EasyWeChat::miniProgram();
        $result = $app->auth->session($code); // $code 为wx.login里的code

    }
    public function xiadan()
    {


        $payment = \EasyWeChat::payment(); // 微信支付

        $result = $payment->order->unify([
            'body'         => '你自己想写的名称',
            'out_trade_no' => '你自己定义的订单号',
            'trade_type'   => 'JSAPI',  // 必须为JSAPI
            'openid'       => 'oUf9a5AT4xPDZy8lJ5Fpskh5gTqE', // 这里的openid为付款人的openid
            'total_fee'    => 1, // 总价
        ]);
        dd($result);
// 如果成功生成统一下单的订单，那么进行二次签名
        if ($result['return_code'] === 'SUCCESS') {
            // 二次签名的参数必须与下面相同
            $params = [
                'appId'     => '你的小程序的appid',
                'timeStamp' => time(),
                'nonceStr'  => $result['nonce_str'],
                'package'   => 'prepay_id=' . $result['prepay_id'],
                'signType'  => 'MD5',
            ];

            // config('wechat.payment.default.key')为商户的key
            $params['paySign'] = generate_sign($params, config('wechat.payment.default.key'));

            return $params;
        } else {
            return $result;
        }

    }
}
