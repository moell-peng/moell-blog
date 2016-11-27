<?php

namespace App\Presenters;

use App\Transformers\NavigationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;
use App\Repositories\NavigationRepositoryEloquent;

/**
 * Class NavigationPresenter
 *
 * @package namespace App\Presenters;
 */
class NavigationPresenter extends FractalPresenter
{
    protected $navigation;

    public function __construct(NavigationRepositoryEloquent $navigation)
    {
        $this->navigation = $navigation;
        parent::__construct();
    }

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NavigationTransformer();
    }

    /**
     * 获取简单导航
     *
     * @return mixed
     */
    public function simpleNavList()
    {
        $navigations = $this->navigation->orderBy('sequence', 'desc')->findWhere(['state' => 0], ['name', 'url']);
        return $navigations;
    }
}
