<?php

namespace App\Services;

use App\Repositories\PageRepositoryEloquent;

class PageService
{
    protected $page;

    public function __construct(pageRepositoryEloquent $page)
    {
        $this->page = $page;
    }

    /**
     * @param $alias
     * @return bool|mixed
     */
    public function getAliasInfo($alias)
    {
        if (is_numeric($alias) && $alias > 0) {
            return $this->page->find($alias);
        }

        if ($alias != "") {
            return  $this->page->getAliasInfo($alias);
        }

        return false;
    }

}