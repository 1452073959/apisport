<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use App\Admin\Metrics\Examples\page\Xmember;
class HomeController extends Controller
{
    public function index(Content $content)
    {
//        return $content
//            ->header('首页')
//            ->description('首页...')
//            ->body(function (Row $row) {
//                $row->column(6, function (Column $column) {
//                    $column->row(Mem::title());
//                    $column->row(new Examples\Tickets());
//                });
//
//                $row->column(6, function (Column $column) {
//                    $column->row(function (Row $row) {
//                        $row->column(6, new Examples\NewUsers());
//                        $row->column(6, new Examples\NewDevices());
//                    });
//
//                    $column->row(new Examples\Sessions());
//                    $column->row(new Examples\ProductOrders());
//                });
//            });

        return $content->body(new Xmember());
    }
}
