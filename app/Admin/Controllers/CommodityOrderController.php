<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CommodityOrder;
use App\Models\Commodity;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use App\Admin\Metrics\Examples;
class CommodityOrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CommodityOrder(), function (Grid $grid) {
            $grid->model()->with(['Commodity']);
            $grid->model()->where('status', '>', 0)->orderBy('paid_at', 'desc');
//            $grid->id->sortable();
            $grid->no;
//            $grid->ordertitle;
            $grid->column('Commodity.title','商品名称');
//            $grid->uid;
            $grid->money;
            $grid->paid_at;
//            $grid->payment_no;
//            $grid->status;
            $grid->status->using([0 => '未支付', 1 => '未发货',2=>'已发货']);
//            $grid->invoice;
//            $grid->ship_status;
//            $grid->ship_data;
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
            $grid->disableDeleteButton();
            $grid->disableEditButton();
            $grid->disableQuickEditButton();
//            $grid->disableViewButton();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    public  function show($id ,Content $content)
    {
//        dd( \App\Models\CommodityOrder::find($id)->toarray());
        return $content->header('Post')
            ->description('详情')
            ->body(view('orders.show', ['order' => \App\Models\CommodityOrder::find($id)]));
    }

    protected function form()
    {
        return Form::make(new CommodityOrder(), function (Form $form) {
            $form->display('id');
            $form->text('no');
            $form->text('ordertitle');
            $form->text('uid');
            $form->text('money');
            $form->text('paid_at');
            $form->text('payment_no');
            $form->text('status');
            $form->text('invoice');
            $form->text('ship_status');
            $form->text('ship_data');
        });
    }
}
