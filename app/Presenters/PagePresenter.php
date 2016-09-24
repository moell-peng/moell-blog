<?php

namespace App\Presenters;

use App\Transformers\PageTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PagePresenter
 *
 * @package namespace App\Presenters;
 */
class PagePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PageTransformer();
    }

    /**
     * 获取页面链接地址
     *
     * @param $id
     * @param string $alias
     */
    public function getLink($id, $alias)
    {
        if ($alias == 'about') {
            return route('about');
        }

        $alias = $alias != "" ? $alias : $id;
        return route('page.show', ['alias' => $alias]);
    }
}
