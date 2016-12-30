<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\PageRepositoryEloquent;
use App\Services\PageService;

class PageController extends Controller
{
    protected $page;

    protected $pageService;

    public function __construct(PageRepositoryEloquent $page, PageService $pageService)
    {
        $this->page = $page;
        $this->pageService = $pageService;
    }

    /**
     * @param $alias
     */
    public function index($alias)
    {
        $page = $this->pageService->getAliasInfo($alias);
        if (!$page) {
            abort('404');
        }

        return view('default.show_page', compact('page'));
    }

    public function about()
    {
        $page = $this->page->getAliasInfo('about');
        if (!$page) {
            abort(404);
        }

        return view('default.show_page', compact('page'));
    }
}
