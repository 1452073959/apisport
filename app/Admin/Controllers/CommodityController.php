<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Commodity;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class CommodityController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Commodity(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->title;
            $grid->price;
            $grid->memerprice;
            $grid->img->image();
            $grid->repertory;
            $grid->starttime;
            $grid->endtime;
//            $grid->status;
            $grid->status->using([0 => '下架', 1 => '上架']);
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });

            // 禁用详情按钮
            $grid->disableViewButton();
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
        return Show::make($id, new Commodity(), function (Show $show) {
            $show->id;
            $show->title;
            $show->price;
            $show->memerprice;
            $show->img;
            $show->repertory;
            $show->starttime;
            $show->endtime;
            $show->status;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Commodity(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->number('price');
            $form->number('memerprice');
            $form->image('img')->uniqueName()->required();
            $form->editor('description','商品描述');
            $form->text('repertory');
//            $form->text('starttime');
//            $form->text('endtime');
            $form->datetimeRange('starttime', 'endtime', '销售时间');
//            $form->text('status');
            $form->radio('status','商品状态')->options([0 => '下架', 1=> '上架'])->default(0);
        });
    }
}
