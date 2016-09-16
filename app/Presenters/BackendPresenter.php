<?php

namespace App\Presenters;

use Route;

class BackendPresenter
{
    private $route;

    public function menu()
    {
        $this->route = Route::currentRouteName();
        $menu = config('blog.menu');

        $menuString = '';
        foreach ($menu as $mList) {

            $count = count($mList);
            if ($count > 1) {
                $menuString .= $this->childrenShow($mList);
            } else {
                $menuString .= $this->parentShow($mList);
            }
        }

        return $menuString;
    }

    /**
     * @param $menu
     * @return string
     */
    private function childrenShow($menu)
    {
        $string = '<li class="treeview %s">';
        $string .= ' <a href="#">
                        <i class="'.$menu['tree_title']['icon'].'"></i>
                        <span>'.$menu['tree_title']['name'].'</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>';

        unset($menu['tree_title']);
        $string .='<ul class="treeview-menu"> %s </ul>';
        $liString = '';
        $active = '';
        foreach ($menu as $route => $m) {
            $activeString = $this->active($route);
            if ($activeString != "") {
                $active = $activeString;
            }
            $liString .= "<li class='".$activeString."'><a href='".route($route)."'>".$m['name']."</a></li>";
        }

        $string .= '</li>';
        $string = sprintf($string, $active, $liString);

        return $string;
    }

    /**
     * @param $menu
     * @return string
     */
    private function parentShow($menu)
    {
        $string = '';
        foreach ($menu as $route => $m) {
            $string.= "<li class='treeview ".$this->active($route)."'>
                <a href='".route($route)."'>
                    <i class='".$m['icon']."'></i>
                    <span>".$m['name']."</span>
                </a>
            </li>";
        }

        return $string;
    }

    /**
     * @param $route
     * @return string
     */
    private function active($route)
    {
        return $this->route == $route ? ' active' : '';
    }
}