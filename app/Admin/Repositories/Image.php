<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\Image as ImageModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
class Image extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = ImageModel::class;
    public function store(Form $form)
    {
        // 获取待新增的数据
        $attributes = $form->updates();

        // 执行你的新增逻辑

        // 返回新增记录id或bool值
        return 1;
    }
}
