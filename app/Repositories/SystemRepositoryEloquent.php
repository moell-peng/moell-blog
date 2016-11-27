<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SystemRepository;
use App\Models\System;
use Illuminate\Container\Container as Application;

/**
 * Class SystemRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SystemRepositoryEloquent extends BaseRepository implements SystemRepository
{
    private $config;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->config = config('blog.system_key');
    }

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
            if (in_array($key, $this->config)) {
                $this->updateOrCreate(['key' => $key], ['value' => $value]);
            }
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
        $system = $this->initSystemKey();
        foreach ($all as $a) {
            $system[$a['key']]  = $a['value'];
        }

        return $system;
    }

    /**
     * @return array
     */
    private function initSystemKey()
    {
        $init = [];
        $config = array_flip($this->config);
        foreach ($config as $key => $value) {
            $init[$key] = '';
        }
        return $init;
    }

    /**
     * @param $key
     * @return string
     */
    public function  getKeyValue($key)
    {
        $data = $this->findByField('key', $key);

        if (isset($data[0])){
            return $data[0]->value;
        }

        return '';
    }
}
