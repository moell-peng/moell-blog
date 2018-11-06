<?php

namespace App\Presenters;

/**
 * Class PagePresenter
 *
 * @package namespace App\Presenters;
 */
class PagePresenter
{
    /**
     * 获取页面链接地址
     *
     * @param $id
     * @param $alias
     * @return string
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
