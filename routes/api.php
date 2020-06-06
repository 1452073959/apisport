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
    //会员码核销
    $api->get('membercode', 'MemberController@membercode');

    $api->any('text', 'CommodityController@text');
    //场馆列表
    $api->get('venue', 'VenueController@venue');
    //场馆下单
    $api->any('venuexiadan', 'VenueController@venuexiadan');
    //场馆下单消息通知
    $api->any('venue/notify', 'VenueController@tongzhi');
    //约球核销
    $api->any('/sport', 'VenueController@sport');
    //商品列表
    $api->get('commodity', 'CommodityController@commoditylist');
    //商品下单
    $api->any('commodityxiadan', 'CommodityController@commodityxiadan');
//    商品支付通知
    $api->any('commodity/notify', 'CommodityController@tongzhi');
    //商品发货
    $api->post('commodity/shipments', 'CommodityController@shipments');
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
