<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Swipe;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SwipeController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Swipe(), function (Grid $grid) {
//            $grid->id->sortable();
            $grid->img->display(function ($pictures) {

                return json_decode($pictures, true);

            })->image(config('app.url'). 'uploads/', 100, 100);
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
            // 禁用详情按钮
            $grid->disableViewButton();
            //关闭新增按钮
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Swipe(), function (Show $show) {
            $show->id;
            $show->img;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Swipe(), function (Form $form) {
            $form->display('id');
//            $form->image('img');
            // 限制最大上传数量
            $form->multipleImage('img','图片')->uniqueName()->saving(function ($paths) {
                // 可以转化为由 , 隔开的字符串格式
                // return implode(',', $paths);

                // 也可以转化为json
                return json_encode($paths);
            });
            $form->disableResetButton();
        });
    }
}
