<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SystemRepository;
use App\Models\System;
use App\Validators\SystemValidator;

/**
 * Class SystemRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SystemRepositoryEloquent extends BaseRepository implements SystemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return System::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * 保存博客设置
     *
     * @param array $data
     * @return bool
     */
    public function store(array $data)
    {
        if (!$data) {
            return false;
        }

        unset($data['_token']);
        foreach ($data as $key => $value) {
            $this->model->where('key', $key)->update(['value' => $value]);
        }

        return true;
    }

    /**
     * 获取选项列表
     *
     * @return array
     */
    public function optionList()
    {
        $all = $this->all(['key', 'value']);
        $system = [];
        foreach ($all as $a) {
            $system[$a['key']]  = $a['value'];
        }

        return $system;
    }
}
