<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Repositories\EloquentRepository;
use App\Models\SRace as SRaceModel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Illuminate\Support\Facades\DB;
class SRace extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = SRaceModel::class;
    public function store(Form $form)
    {
        // 获取待新增的数据
        $attributes = $form->updates();
        // 执行你的新增逻辑
       DB::table('s_race')->insert($attributes);
        // 返回新增记录id或bool值
        return true;
    }

    public function update(Form $form)
    {
        // 获取待编辑的数据
        $attributes = $form->updates();
        $id = $form->getKey();
//        dd($id);
        DB::table('s_race')->where('id',$id)->update($attributes);
        // 执行你的编辑逻辑
        // 返回成功
        return true;
    }
}
