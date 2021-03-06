<?php

namespace App\Http\Controllers\Api;

use App\Models\SportOrder;
use App\Models\Venue;
use Illuminate\Http\Request;
use function EasyWeChat\Kernel\Support\generate_sign;
use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Memberinsurance;
class VenueController extends Controller
{
    //场馆信息
    public function venue()
    {
        $venue=Venue::with(['lease','tenancy'])->get();
        foreach ($venue as $k1=>$v1)
        {
            $venue[$k1]['venueimg'] =json_decode($v1['venueimg'],true);
        }
        return $this->success($venue) ;
    }


    public function venuexiadan(Request $request)
    {
        $data = $request->all();
//        dd($data);
        //获取用户信息
        $user=User::with('member')->where('token',$data['token'])->first();
        $order=new SportOrder();
        $order->vid=$data['vid'];
        $order->uid=$user['id'];

        if(isset($data['quantumdate'])){
            $order->quantumdate=$data['quantumdate'];
         }
        if(isset($data['quantumtime'])){
            $str=  json_encode(array_values($data['quantumtime']));
            $order->quantumtime=$str;
        }
        $order->money=$data['money'];
        $order->type=$data['type'];
        if(isset($data['invoice'])){
            $order->invoice=$data['invoice'];
        }
        if(isset($data['insurance'])){
            $order->insurance=$data['insurance'];
        }
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
            'out_trade_no' => $order['no'],
            'trade_type' => 'JSAPI',  // 必须为JSAPI
            'openid' => $user['weapp_openid'], // 这里的openid为付款人的openid
            'total_fee' => $data['money']*100, // 总价
//            'notify_url'=> config('app.url').'member/notify'
            'notify_url'=>config('app.url').'api/venue/notify'
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
            $params['out_trade_no'] = $order['no'];
            return $params;
        } else {
            return $result;
        }

    }

    //通知
    public function tongzhi()
    {
        Cache::put('key1', 123456798);
        $app = \EasyWeChat::payment(); // 微信支付
        $response = $app->handlePaidNotify(function($message, $fail){
                //数据库找到订单
            Cache::put('key',$message );
            $order = SportOrder::where('no',$message['out_trade_no'])->first();
            if (!$order || $order['paid_at']) { // 如果订单不存在 或者 订单已经支付过了
                return ; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                $order->paid_at = date('Y-m-d H:i:s',time());; // 更新支付时间为当前时间
                $order->status = 1;
                $order->total_fee = $message['total_fee']*0.01;
                $order->payment_no = $message['transaction_id'];
                DB::table('memberinsurance')->where('oid',$order['id'])->update(['status' => 1]);
            } else {
                $order->status = 0;
                return $fail('通信失败，请稍后再通知我');
            }
            $order->save();

        });
        return $response;
    }

    public function sport(Request $request)
    {
        $data=$request->all();
        if($data['code']==''){
            return $this->success('请输入订单号');
        }
        $order=SportOrder::where('no',$data['code'])->first();
        if(!$order){
            return $this->success('该订单不存在');
        }else{
            if($order['status']==2){
                return $this->success('该订单已使用过');
            }
            $order->codenot=2;
            $order->save();
            return $this->success('约球订单核销成功');
        }

    }

    //查询约球记录
    public function venuerecord(Request $request)
    {
        $data=$request->all();
        $user=User::with('member')->where('token',$data['token'])->first();

     $record=SportOrder::with('venue','user')->where('uid',$user['id'])->where('status',$request->input('status'))->get();

        return $this->success($record);
    }
    //查询日期
    public function bought(Request $request)
    {
        if ($request->input('date')) {
            $bought =DB::table('sport_order')->whereDate('quantumdate', $request->input('date'))->where('status',1)->get();
        }else{
            $bought =DB::table('sport_order')->where('status',1)->get();
        }
        return $this->success($bought);
    }


}
