<?php

use Illuminate\Http\Request;


$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {
    $api->get('srace', 'SRaceController@srace');
    //登陆code//
    $api->get('logincode', 'LoginController@code');
    //保存用户信息
    $api->post('userinfo', 'LoginController@updateUserInfo');
    //获取用户信息
    $api->get('getuser', 'LoginController@getuser');
    //会员卡列表
    $api->get('member', 'MemberController@memberlist');
    //场馆列表
    $api->get('venue', 'VenueController@venue');
    //会员码
    $api->get('membercode', 'MemberController@membercode');
    //商品列表
    $api->get('commodity', 'CommodityController@commoditylist');
});

$api->version('v2', function($api) {
    $api->get('version', function() {
        return response('this is version v2');
    });
});
