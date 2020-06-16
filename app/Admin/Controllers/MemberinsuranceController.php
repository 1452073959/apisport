<?php

namespace App\Admin\Controllers;

use App\Models\Memberinsurance;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class MemberinsuranceController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Memberinsurance(), function (Grid $grid) {
            $grid->model()->with(['sportorder']);
            $grid->model()->where('status', '>', 0)->orderBy('id', 'desc');
            $grid->id->sortable();
//            $grid->oid;
            $grid->column('sportorder.ordernum','订单号');
            $grid->money;
            $grid->name;
            $grid->card;
            $grid->startdate;
            $grid->enddate;
        
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
        return Show::make($id, new Memberinsurance(), function (Show $show) {
            $show->id;
            $show->oid;
            $show->name;
            $show->card;
            $show->startdate;
            $show->enddate;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Memberinsurance(), function (Form $form) {
            $form->display('id');
            $form->text('oid');
            $form->text('name');
            $form->text('card');
            $form->text('startdate');
            $form->text('enddate');
            $form->disableResetButton();
        });
    }
}
