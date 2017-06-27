<?php

namespace App\Presenters;

use App\Transformers\SystemTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\SystemRepositoryEloquent;

/**
 * Class SystemPresenter
 *
 * @package namespace App\Presenters;
 */
class SystemPresenter extends FractalPresenter
{
    protected $system;

    protected $list;

    public function __construct(SystemRepositoryEloquent $system)
    {
        $this->system = $system;
        $this->list = $this->system->optionList();
        parent::__construct();
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SystemTransformer();
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
