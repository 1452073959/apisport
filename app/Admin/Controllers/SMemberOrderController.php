<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SMemberOrder;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SMemberOrderController extends AdminController
{
    /**11
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        return Grid::make(new SMemberOrder(), function (Grid $grid) {
            // 关联 profile 表数据
            $grid->model()->with(['member']);
            $grid->model()->with(['user']);
            $grid->id->sortable();
//            $grid->user_id;
//            $grid->member.cardname;
            $grid->column('user.name','会员昵称');
            $grid->column('member.cardname','会员卡类型');
            $grid->open_money;
            $grid->open_time;
            $grid->end_time;
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();
                $actions->disableQuickEidt();
                $actions->disableView();
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
        return Show::make($id, new SMemberOrder(), function (Show $show) {
            $show->id;
            $show->user_id;
            $show->member_id;
            $show->open_money;
            $show->open_time;
            $show->end_time;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SMemberOrder(), function (Form $form) {
            $form->display('id');
            $form->text('user_id');
            $form->text('member_id');
            $form->text('open_money');
            $form->text('open_time');
            $form->text('end_time');
        });
    }
}
