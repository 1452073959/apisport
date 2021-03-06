<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SMember;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SMemberController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SMember(), function (Grid $grid) {
            $grid->id->sortable();
            // 禁用过滤器按钮
            $grid->disableFilterButton();
            $grid->cardname;
            $grid->deadline;
            $grid->price;
            $grid->explain;
            $grid->created_at;
            $grid->updated_at->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
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
        return Show::make($id, new SMember(), function (Show $show) {
            $show->id;
            $show->cardname;
            $show->deadline;
            $show->price;
            $show->explain;
            $show->created_at;
            $show->updated_at;
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new SMember(), function (Form $form) {
//            $form->display('id');
            // 去除整个工具栏内容
            $form->disableHeader();
            $form->text('cardname')->required();;
            $form->number('deadline')->required();;
            $form->text('price')->required();;
            $form->text('insurance')->required();;
//            $form->text('explain');
            $form->textarea('explain')->rows(10)->required();;
            $form->display('created_at');
            $form->display('updated_at');
            $form->disableResetButton();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
        });
    }
}
