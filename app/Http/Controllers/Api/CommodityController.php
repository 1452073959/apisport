<?php

namespace App\Http\Controllers\Api;

use App\Models\Commodity;
use App\Models\CommodityOrder;
use App\Models\SportOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use EasyWeChat\Factory;
use App\Models\User;
use Cache;
use App\Exceptions\InvalidRequestException;
use function EasyWeChat\Kernel\Support\generate_sign;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CommodityController extends Controller
{
    //
    //商品列表
    public function commoditylist()
    {
        Cache::put('key1', 99999);
        $commoditylist=Commodity::where('status',1)->get();
        foreach ($commoditylist as $k1=>$v1)
        {
            if(!Carbon::now()->between($v1['starttime'], $v1['endtime']))
            {
              unset($commoditylist[$k1]);
            }
        }

        return $this->success($commoditylist);
    }


    public function commodityxiadan(Request $request)
    {
        $data = $request->all();
        //获取用户信息
        $user=User::with('member')->where('token',$data['token'])->first();
        $order=new CommodityOrder();
        $order->user_id=$user['id'];
        $order->cid=$data['cid'];
        $order->money=$data['money'];
        $order->name=$data['name'];
        $order->tel=$data['tel'];
        $order->address=$data['address'];
        $order->save();
//        dd($order->toArray());
        $payment = \EasyWeChat::payment(); // 微信支付
        $result = $payment->order->unify([
            'body' => $data['title'],
            'out_trade_no' => $order['no'],
            'trade_type' => 'JSAPI',  // 必须为JSAPI
            'openid' => $user['weapp_openid'], // 这里的openid为付款人的openid
            'total_fee' => $data['money']*100, // 总价
            'notify_url'=>config('app.url').'api/commodity/notify'
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


    //通知
    public function tongzhi()
    {
        Cache::put('key1', 128);
        $app = \EasyWeChat::payment(); // 微信支付
        $response = $app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            Cache::put('key',$message);
            $order = CommodityOrder::where('no',$message['out_trade_no'])->first();
            if (!$order || $order['paid_at']) { // 如果订单不存在 或者 订单已经支付过了
                return ; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                $order->paid_at = date('Y-m-d H:i:s',time());; // 更新支付时间为当前时间
                $order->status = 1;
                $order->total_fee = $message['total_fee']*0.01;
                $order->repertory--;
                $order->sales++;

            } else {
                $order->status = 0;
                return $fail('通信失败，请稍后再通知我');
            }
            $order->save();

        });
        return $response;
    }


    //订单发货
    public function shipments(SportOrder $order, Request $request)
    {
        // 判断当前订单是否已支付
        $id=$request->id;
//        dd($id);
        $data=$request->all();
            unset($data['id']);
        if($data['express_company']==null){
            return $this->success('请填写物流公司');
        }
        if($data['express_no']==null){
            return $this->success('请填写单号');
        }
        // 将订单发货状态改为已发货，并存入物流信息
        DB::table('commodity_order')->where('id',$id)->update([
            'status' => 2,
            // 我们在 Order 模型的 $casts 属性里指明了 ship_data 是一个数组
            // 因此这里可以直接把数组传过去
            'ship_data'   => $data,
        ]);

        return $this->success('发货成功');
    }

    //查询商城记录
    public function record(Request $request)
    {
        $data=$request->all();
        $where=[];
        if ($request->input('status')) {
            $where[] = ['status', $request->input('status')];
        }
        $user=User::with('member')->where('token',$data['token'])->first();
        $record=CommodityOrder::with('Commodity','user')->where('user_id',$user['id'])->where($where)->get();
        return $this->success($record);
    }

}
