<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    //赛事
    $router->resource('srace', 'SRaceController');
    //会员卡
    $router->resource('member', 'SMemberController');
    $router->resource('memberorder', 'SMemberOrderController');
    $router->resource('image', 'ImageController');
    //用户
    $router->resource('users', 'UserController');
    //场馆
    $router->resource('venue', 'VenueController');
    //约球订单
    $router->resource('sportorder', 'SportOrderController');
    //商城
    $router->resource('commodity', 'CommodityController');

});
