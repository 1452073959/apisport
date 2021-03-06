<?php
namespace App\Admin\Metrics\Examples\page;
use Illuminate\Contracts\Support\Renderable;
use Dcat\Admin\Admin;

class Xmember implements Renderable
{
    // 定义页面所需的静态资源，这里会按需加载
    public static $js = [
        'https://www.layuicdn.com/layui/layui.js',
    ];
    public static $css = [
        'https://www.layuicdn.com/layui/css/layui.css',
    ];

    public function script()
    {
        return <<<JS
        console.log('所有JS脚本都加载完了');
JS;
    }

    public function render()
    {
        // 在这里可以引入你的js或css文件
        Admin::js(static::$js);
        Admin::css(static::$css);

        // 需要在页面执行的JS代码
        // 通过 Admin::script 设置的JS代码会自动在所有JS脚本都加载完毕后执行
        Admin::script($this->script());

        return view('page.member')->render();
    }
}
