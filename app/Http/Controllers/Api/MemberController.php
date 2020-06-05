<?php

namespace App\Http\Controllers\Api;

use App\Models\Memberinsurance;
use App\Models\SMember;
use App\Models\SMemberOrder;
use App\Models\UserMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use DB;
use Response;
use function EasyWeChat\Kernel\Support\generate_sign;
use Cache;
use Carbon\Carbon;
class MemberController extends Controller
{
    //
    //会员卡列表
    public function memberlist()
    {
        $member=SMember::get();
        return $this->success($member);
    }
    //会员卡订单
    public function memberxiadan(Request $request)
    {
        $data = $request->all();
        //获取用户信息
        $user=User::with('member')->where('token',$data['token'])->first();
        $order=new SMemberOrder();
        $order->user_id=$user['id'];
        $order->member_id=$data['member'];
        $order->open_money=$data['money'];
        $order->insurance=$data['insurance'];
        $order->save();
        if($order['insurance']==1){
            $insurance=new Memberinsurance();
            $insurance->oid=$order['id'];
            $insurance->money=$data['receipts']['money'];
            $insurance->name=$data['receipts']['name'];
            $insurance->card=$data['receipts']['card'];
            $insurance->startdate=$data['receipts']['startdate'];
            $insurance->enddate=$data['receipts']['enddate'];
            $insurance->save();
        }
        $payment = \EasyWeChat::payment(); // 微信支付
        $result = $payment->order->unify([
            'body' =>$data['title'],
            'out_trade_no' => $order['ordernum'],
            'trade_type' => 'JSAPI',  // 必须为JSAPI
            'openid' => $user['weapp_openid'], // 这里的openid为付款人的openid
            'total_fee' => $data['money']*100+$data['receipts']['money'], // 总价
//            'notify_url'=> config('app.url').'member/notify'
            'notify_url'=>'https://sport.xinxiaxue.cn/api/member/notify'
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

            ];
            $params['paySign'] = generate_sign($params, config('wechat.payment.default.key'));

            return $params;

        } else {
            return $result;
        }
    }


    public function tongzhi()
    {
        Cache::put('key1', 1232321);
        $app = \EasyWeChat::payment(); // 微信支付
        $response = $app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            Cache::put('key',$message );
            $order = SMemberOrder::with('member')->where('ordernum',$message['out_trade_no'])->first();
            if (!$order || $order['paid_at']) { // 如果订单不存在 或者 订单已经支付过了
                return ; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                $order->paid_at = $data=date('Y-m-d h:i:s',time());; // 更新支付时间为当前时间
                $order->status = 1;
                $usermember=UserMember::where('user_id',$order['user_id'])->first();
                $newtime=date("Y-m-d h:i:s",strtotime('+'.$order.['member']['deadline'].'months',strtotime( $usermember['end_time'])));
                DB::table('user_member')->where('user_id',$order['user_id'])->update(['end_time' => $newtime]);
                DB::table('memberinsurance')->where('oid',$order['id'])->update(['status' => 1]);
            } else {
                $order->status = 0;
                return $fail('通信失败，请稍后再通知我');
            }
            $order->save();

        });
        return $response;
    }

//    public function text()
//    {
//        $order = SMemberOrder::with('member')->where('ordernum',20200605182538718406)->first();
//        $usermember=UserMember::where('user_id',$order['user_id'])->first();
//        dump($usermember->toarray());
//        $newtime=date("Y-m-d h:i:s",strtotime('+'.$order['member']['deadline'].'months',strtotime($usermember['end_time'])));
//        dump($newtime);
//        $usermember=DB::table('user_member')->where('user_id',$order['user_id'])->update(['end_time' => $newtime]);
//        dump($usermember);
//    }



//    用户会员码核销
    public function membercode(Request $request)
    {
        $data=$request->all();
        if($data['code']==''){
            return $this->success('请输入会员码');
        }
      $user=UserMember::where('code',$data['code'])->first();
      if(!$user){
          return $this->success('该会员码不存在');
      }else{
          if($user['codenot']==1){
              return $this->success('该会员码今日已使用');
          }
          $user->codenot=1;
          $user->save();
          return $this->success('核销成功');
      }

    }

}
