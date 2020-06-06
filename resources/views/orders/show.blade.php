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
                <td colspan="3">{{ $order->address['address'] }}</td>
            </tr>
            <tr>
                <td rowspan="">商品名称</td>
                <td>{{$order->Commodity->title}}</td>
                {{--<td>下单时间</td>--}}
                {{--<td>{{$order->Commodity->price}}</td>--}}
            </tr>

            <tr>
                <td>订单金额：</td>
                <td colspan="3">￥{{ $order->money }}</td>
            </tr>

            <!-- 如果订单未发货，展示发货表单 -->
            @if($order->status == 1)
                <tr>
                    <td colspan="4">
                        <form  class="form-inline" id="myform">
                            <input type="hidden" name="id" value="{{$order->id}}">
                            <div class="form-group">
                                <label for="express_company" class="control-label">物流公司</label>
                                <input type="text" id="express_company" name="express_company" value="" class="form-control" placeholder="输入物流公司">
                            </div>
                            <div class="form-group">
                                <label for="express_no" class="control-label">物流单号</label>
                                <input type="text" id="express_no" name="express_no" value="" class="form-control" placeholder="输入物流单号">
                            </div>
                            <button type="button" class="btn btn-success" id="ship-btn">发货</button>
                        </form>
                    </td>
                </tr>
            @else
                <!-- 否则展示物流公司和物流单号 -->
                <tr>
                    <td>物流公司：</td>
                    <td>{{ $order->ship_data['express_company'] }}</td>
                    <td>物流单号：</td>
                    <td>{{ $order->ship_data['express_no'] }}</td>
                </tr>
            @endif
            <!-- 订单发货结束 -->
            </tbody>
        </table>
    </div>
</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    $("#ship-btn").click(function () {
        $.ajax({
            type:"post",
            url:"/api/commodity/shipments",
            data:$("#myform").serialize(),//这里data传递过去的是序列化以后的字符串
            success:function(data){
                layer.msg(data.data);
                window.location.reload();
            }
        });
    });
</script>
