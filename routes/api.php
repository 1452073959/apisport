<?php

use Illuminate\Http\Request;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->get('srace', 'SRaceController@srace');

    //获取用户信息
    $api->get('getuser', 'WechatController@getuser');
    //会员卡列表
    $api->get('member', 'MemberController@memberlist');
    //会员卡下单
    $api->any('memberxiadan', 'MemberController@memberxiadan');
//    会员卡接收支付通知
    $api->any('member/notify', 'MemberController@tongzhi');

    $api->any('text', 'CommodityController@text');

    //场馆列表
    $api->get('venue', 'VenueController@venue');
    //会员码
    $api->get('membercode', 'MemberController@membercode');
    //商品列表
    $api->get('commodity', 'CommodityController@commoditylist');
    //商品下单
    $api->any('commodityxiadan', 'CommodityController@commodityxiadan');
//    商品支付通知
    $api->any('commodity/notify', 'CommodityController@tongzhi');
    //下单
    $api->post('adjorder', 'OrderController@adjorder');
    //订单查询
    $api->get('orderlist', 'OrderController@orderlist');


    //微信登陆
    $api->any('logincode', 'WechatController@wechat');

    $api->any('order', 'WechatController@order');

    $api->any('cache', 'WechatController@cache');
});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});
