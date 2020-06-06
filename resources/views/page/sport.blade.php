
<div>
    <form class="layui-form" id="myform2" name="myform2">
        <div class="layui-form-item">
            <label class="layui-form-label">订单号</label>
            <div class="layui-input-block">
                <input type="text" name="code"  lay-verify="required" placeholder="请输入订单号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button  type="button" class="layui-btn" id="h2">立即提交</button>
            </div>
        </div>
    </form>


</div>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    Dcat.ready(function () {
        $("#h2").click(function () {
            $.ajax({
                type:"get",
                url:"/api/sport",
                data:$("#myform2").serialize(),//这里data传递过去的是序列化以后的字符串
                success:function(data){
                    layer.msg(data.data);
                }

            });
        });
    });
</script>

