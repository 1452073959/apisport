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
//            $grid->repertory;
            $grid->starttime;
            $grid->endtime;
//            $grid->status;
            $grid->status->using([0 => '下架', 1 => '上架'])->filter(
                Grid\Column\Filter\In::make([
                    1 => '上架',
                    0=> '下架',

                ])
            );;
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('title', '商品名称');
        
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
//            $form->display('id');
            // 去除整个工具栏内容
            $form->disableHeader();
            $form->text('title')->required();;
            $form->number('price')->required();;
            $form->number('memerprice')->required();;
            $form->image('img')->uniqueName()->required();
            $form->editor('description','商品描述')->required();;
            $form->text('repertory');
            $form->disableResetButton();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
//            $form->text('starttime');
//            $form->text('endtime');
            $form->datetimeRange('starttime', 'endtime', '销售时间')->required();;
//            $form->text('status');
            $form->radio('status','商品状态')->options([0 => '下架', 1=> '上架'])->default(0)->required();;
        });
    }
}
