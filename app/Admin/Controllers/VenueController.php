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
            $grid->id->sortable();
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
        return Form::make(new Venue('lease'), function (Form $form) {
            $form->display('id');
            $form->text('venuename')->required();
            $form->text('address')->required();
            $form->tags('label');
//            $form->image('venueimg');
            $form->multipleImage('venueimg','图片')->uniqueName()->saving(function ($paths) {
                return json_encode($paths);
            });
            $form->text('tel');
            $form->timeRange('starttime', 'endtime', '营业时间');
            $form->text('venuesynopsis');
            $form->text('venuefacility');
            $form->text('venueserve');
            $form->hasMany('lease','方式', function (Form\NestedForm $form) {
                $form->text('name');
                $form->textarea('description','描述');
                $form->number('price','价格(元)');
            });


            $form->display('created_at');
            $form->display('updated_at');


        });
    }
}


/*return Form::make(new Venue(), function (Form $form) {
    $form->model()->with(['lease']);
    $form->display('id');
    $form->text('venuename');
    $form->text('address');
//            $form->text('label');
    $form->tags('label');
    $form->image('venueimg');
    $form->text('tel');
    $form->text('starttime');
    $form->text('endtime');
    $form->dateRange('starttime', 'endtime', '营业时间');
    $form->text('venuesynopsis');
    $form->text('venuefacility');
    $form->text('venueserve');
//            $form->text('extra');
    $form->table('extra', function (Form\NestedForm $table) {
        $table->text('key');
        $table->text('value');
        $table->text('desc');
    });
//            $form->checkbox('lease', '租赁方式')->options(Lease::all()->pluck('title', 'id'));
//            $form->checkbox('lease', '租赁方1式')
//                ->options([1 => 'foo', 2 => 'bar', 'val' => 'Option name'])
//                ->saving(function ($value) {
//                    dd($value);
//                    // 转化成json字符串保存到数据库
//                    return json_encode($value);
//                });
    $form->text('lease');
//            $form->radio('lease','租赁方1式')->options(['m' => 'Female', 'f'=> 'Male'])->default('m');
    $form->display('created_at');
    $form->display('updated_at');*/
