<?php

namespace App\Admin\Controllers;

use App\Models\SportOrder;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

use Dcat\Admin\Controllers\AdminController;

class SportOrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SportOrder(), function (Grid $grid) {
//            $grid->id->sortable();
            $grid->model()->where('status', '>', 0)->orderBy('paid_at', 'desc');
            $grid->model()->with(['venue']);
            $grid->model()->with(['user']);
            $grid->type->using([0 => '散客', 1 => '整场']);
            $grid->no;
            $grid->column('venue.venuename','场馆');
            $grid->column('user.nickname','会员昵称');
//            $grid->starttime;
//            $grid->endtime;
            $grid->quantum;
            $grid->money;
            $grid->paid_at;

//            $grid->payment_no;
            $grid->status->using([1 => '未使用', 2 => '已使用']);
//            $grid->invoice;
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
            //关闭新增按钮
            $grid->disableCreateButton();
            //关闭操作
            $grid->disableActions();
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
        return Show::make($id, new SportOrder(), function (Show $show) {
            $show->id;
            $show->no;
            $show->ordertitle;
            $show->vid;
            $show->uid;
            $show->starttime;
            $show->endtime;
            $show->money;
            $show->paid_at;
            $show->payment_no;
            $show->status;
            $show->invoice;
        });
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SportOrder(), function (Form $form) {
            $form->display('id');
            $form->text('no');
            $form->text('ordertitle');
            $form->text('vid');
            $form->text('uid');
            $form->text('starttime');
            $form->text('endtime');
            $form->text('money');
            $form->text('paid_at');
            $form->text('payment_no');
            $form->text('status');
            $form->text('invoice');
        });
    }

}
