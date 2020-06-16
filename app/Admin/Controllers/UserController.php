<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\User;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class UserController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new User(), function (Grid $grid) {
            $grid->model()->with(['member']);
            $grid->id->sortable();
            $grid->nickname;
//            $grid->avatarurl->image()->setAttributes(['width' => '4px']);;
//            $grid->weapp_openid;
            $grid->column('member.membership','会员卡')->using([0 => '未激活', 1 => '会员']);
            $grid->column('member.end_time','会员到期时间');
            $grid->created_at;
//            $grid->updated_at->sortable();

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
        return Show::make($id, new User(), function (Show $show) {
            $show->id;
            $show->name;
            $show->avatarurl;
            $show->openid;
            $show->membership;
            $show->end_time;
            $show->email;
            $show->email_verified_at;
            $show->password;
            $show->remember_token;
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
        return Form::make(new User(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('avatarurl');
            $form->text('openid');
            $form->text('membership');
            $form->text('end_time');
            $form->text('email');
            $form->text('email_verified_at');
            $form->text('password');
            $form->text('remember_token');
        
            $form->display('created_at');
            $form->display('updated_at');
            $form->disableResetButton();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
        });
    }
}
