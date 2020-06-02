<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\SRace;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class SRaceController extends AdminController
{
    protected function grid()
    {
        return Grid::make(new SRace(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->projectname;
            $grid->projectcate;
            $grid->city;
            $grid->address;
            $grid->venue;
            $grid->troops;
            $grid->smallimg->image(env('APP_URL').'/uploads', 100,100);
            $grid->bigimg->image(env('APP_URL').'/uploads', 100,100);
            $grid->time;
            $grid->status()->display(function($text) {
               if($text==1)
               {
                   return '赛事开始';
               }
                if($text==2)
                {
                    return '赛事结束';
               }
                if($text==0)
                {
                    return '未开始';
               }
            });
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
            // 禁用详情按钮
            $grid->disableViewButton();
        });
    }

    protected function form()
    {
        return Form::make(new SRace(), function (Form $form) {
            $form->display('id');
            $form->text('projectname')->required();
            $form->text('projectcate')->required();
            $form->text('city')->required();
            $form->text('address')->required();
            $form->text('venue')->required();
            $form->text('troops')->required();
            $form->image('smallimg')->uniqueName()->required();;
            $form->image('bigimg')->uniqueName()->required();;
            $form->datetime('time')->format('YYYY-MM-DD HH:mm');
            $form->radio('status')->options([1 => '赛事开始', 2=> '赛事结束',0=>'未开始'])->default('0');
        });
    }
}
