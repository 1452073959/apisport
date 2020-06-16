<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Image;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class ImageController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Image(), function (Grid $grid) {
            $grid->id->sortable();
            $grid->path;
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
        return Show::make($id, new Image(), function (Show $show) {
            $show->id;
            $show->path;
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

        return Form::make(new Image(), function (Form $form) {
            $form->display('id');
            $form->image('path')
                ->saving(function ($value) use ($form) {
                    if ($form->isEditing() && ! $value) {
                        // 编辑页面，删除图片逻辑
                        \App\Models\Image::destroy($form->model()->path);
                        return;
                    }
                    // 新增或编辑页面上传图片
                    if ($value) {
                        $model = \App\Models\Image::where('path', $value)->first();

                    }
                    if (empty($model)) {
                        $model = new \App\Models\Image();
                    }
                    $model->path = $value;

                     $model->save();
                    return;
//                     $model->getKey();
                })
                ->customFormat(function ($v) {
                    if (! $v) {
                        return;
                    }

                    return \App\Models\Image::find((array) $v)->pluck('path')->toArray();
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
