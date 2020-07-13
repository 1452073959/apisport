<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Venue;
use App\Models\Lease;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class VenueController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Venue(), function (Grid $grid) {
//            $grid->id->sortable();
            $grid->venuename;
            $grid->address;
            $grid->label;
//            $grid->venueimg;
//            $grid->tel;
//            $grid->starttime;
//            $grid->endtime;
//            $grid->venuesynopsis;
//            $grid->venuefacility;
//            $grid->venueserve;
//            $grid->extra;
//            $grid->lease;
//            $grid->created_at;
//            $grid->updated_at->sortable();
            // 禁用详情按钮
            $grid->disableViewButton();
            $grid->filter(function (Grid\Filter $filter) {
//                $filter->equal('id');
                $filter->like('venuename', '场馆');
        
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
        return Show::make($id, new Venue(), function (Show $show) {
            $show->id;
            $show->venuename;
            $show->address;
            $show->label;
            $show->venueimg;
            $show->tel;
            $show->starttime;
            $show->endtime;
            $show->venuesynopsis;
            $show->venuefacility;
            $show->venueserve;
            $show->extra;
            $show->lease;
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
        return Form::make(new Venue(['lease','tenancy']), function (Form $form) {
//            $form->model()->with(['tenancy']);
// 去除整个工具栏内容
            $form->disableHeader();
            $form->display('id');
            $form->text('venuename')->required();
            $form->text('address')->required();
            $form->tags('label')->required()->help('输入标签按逗号回车');;
            $form->map('latitude', 'longitude', '位置');
//            $form->image('venueimg');
            $form->multipleImage('venueimg','图片')->uniqueName()->saving(function ($paths) {
                return json_encode($paths);
            })->required();
            $form->text('tel')->required();;
            $form->timeRange('starttime', 'endtime', '营业时间')->required();;
            $form->text('venuesynopsis')->required();
            $form->text('venuefacility')->required();
            $form->text('venueserve')->required();
            $form->text('tenancy.price','整租每小时价格')->help('留空为不整租');
            $form->hasMany('lease','散租方式', function (Form\NestedForm $form) {
                $form->text('name');
                $form->textarea('description','描述');
                $form->text('price','价格(元)');
                $form->text('insured','保险金额(元)');
            });

            $form->disableResetButton();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->display('created_at');
            $form->display('updated_at');


        });
    }
}

