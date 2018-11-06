<?php

namespace App\Presenters;

use App\Models\System;

/**
 * Class SystemPresenter
 *
 * @package namespace App\Presenters;
 */
class SystemPresenter
{
    protected $list;

    public function __construct()
    {
        $this->list = System::optionList();

    }

    /**
     * 根据key获取value
     *
     * @param $key
     * @return mixed
     */
    public function getKeyValue($key)
    {
        return isset($this->list[$key]) ? $this->list[$key] : '';
    }

    /**
     * 检查返回相应的value
     *
     * @param $key
     * @param $defaultValue
     * @return mixed
     */
    public function checkReturnValue($key, $defaultValue)
    {
        if ($defaultValue != "") {
            return $defaultValue;
        }

        return $this->getKeyValue($key);
    }
}
