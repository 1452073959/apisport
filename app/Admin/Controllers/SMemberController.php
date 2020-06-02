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
            $form->display('id');
            $form->text('cardname');
            $form->number('deadline');
            $form->text('price');
//            $form->text('explain');
            $form->textarea('explain')->rows(10);
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
