<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">订单流水号：{{ $order->no }}</h3>
        <div class="box-tools">
            <div class="btn-group float-right" style="margin-right: 10px">
                <a href="" class="btn btn-sm btn-default"><i class="fa fa-list"></i> 列表</a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>买家：</td>
                <td>{{ $order->name }}</td>
                <td>支付时间：</td>
                <td>{{ $order->paid_at }}</td>
            </tr>
            <tr>
                <td>电话：</td>
                <td>{{ $order->tel }}</td>
                <td>支付渠道单号：</td>
                <td>{{ $order->payment_no }}</td>
            </tr>
            <tr>
                <td>收货地址</td>
                <td colspan="3">{{ $order->address['address'] }}{{ $order->address['zip'] }} {{ $order->address['contact_name'] }} {{ $order->address['contact_phone'] }}</td>
            </tr>
            <tr>
                <td rowspan="">商品名称</td>
                <td>{{$order->Commodity->title}}</td>
                <td>{{$order->Commodity->price}}</td>
                <td>数量</td>
            </tr>

            <tr>
                <td>订单金额：</td>
                <td colspan="3">￥{{ $order->money }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
